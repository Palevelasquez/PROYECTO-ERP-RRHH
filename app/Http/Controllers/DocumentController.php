<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleSheetsService;

class DocumentController extends Controller
{

    protected $googleSheets;

    public function __construct(GoogleSheetsService $googleSheets)
    {
        $this->googleSheets = $googleSheets;
    }

    public function exportToSheets()
    {
        $spreadsheetId = '1P5TBL6oIsr9hdz1vUHqVG4lD1QdNuVdbzf-D7inv3aE';
        $range = 'Sheet1!A1:D5'; // Rango donde quieres exportar los datos
        $values = [
            ['Nombre', 'Apellido Paterno', 'Apellido Materno', 'Correo'],
            ['John', 'Doe', 'Smith', 'john.doe@example.com'],
            // Agrega más filas según necesites
        ];

        try {
            $this->googleSheets->updateValues($spreadsheetId, $range, $values);
            return back()->with('success', 'Datos exportados a Google Sheets exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al exportar datos a Google Sheets: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $empleados = Empleado::all();
        return view('documents.index', compact('empleados'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'type' => 'required|in:contract,signature',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('file')->store('pdfs', 'local_pdfs');

        Document::create([
            'empleado_id' => $request->empleado_id,
            'type' => $request->type,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Documento importado exitosamente.');
    }

    public function export(Empleado $empleado)
    {
        $documents = $empleado->documents;

        $zip = new \ZipArchive();
        $zipFileName = 'documents_' . $empleado->id . '.zip';

        if ($zip->open(storage_path('app/public/' . $zipFileName), \ZipArchive::CREATE) === TRUE) {
            foreach ($documents as $document) {
                $zip->addFile(storage_path('app/public/' . $document->file_path), $document->file_path);
            }
            $zip->close();
        }

        return response()->download(storage_path('app/public/' . $zipFileName));
    }

    public function download(Request $request)
    {
        $request->validate([
            'empleado_id_download' => 'required|exists:empleados,id',
            'type_download' => 'required|in:all,contract,signature',
        ]);

        $empleado = Empleado::findOrFail($request->empleado_id_download);
        $documents = $empleado->documents()->where('type', $request->type_download)->get();

        $zip = new \ZipArchive();
        $zipFileName = 'documents_' . $empleado->id . '.zip';

        if ($zip->open(storage_path('app/public/' . $zipFileName), \ZipArchive::CREATE) === TRUE) {
            foreach ($documents as $document) {
                $zip->addFile(storage_path('app/public/' . $document->file_path), $document->file_path);
            }
            $zip->close();
        }

        return response()->download(storage_path('app/public/' . $zipFileName));
    }
}

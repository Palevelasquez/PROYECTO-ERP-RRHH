<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleSheetsService;
use ZipArchive;


class DocumentController extends Controller
{

    protected $googleSheets;

    public function __construct(GoogleSheetsService $googleSheets)
    {
        $this->googleSheets = $googleSheets;
    }

    public function exportToSheets(Empleado $empleado)
    {
        $spreadsheetId = '1P5TBL6oIsr9hdz1vUHqVG4lD1QdNuVdbzf-D7inv3aE';
        $range = 'Sheet1!A1:E'; // Cambiado para buscar en la columna E
        $values = [
            [$empleado->Nombre, $empleado->Correo, $empleado->cargo]
        ];

        try {
            // Obtener los valores actuales en la hoja para calcular la siguiente fila disponible
            $currentValues = $this->googleSheets->getValues($spreadsheetId, $range);
            $nextRow = count($currentValues) + 1;

            // Definir el rango para la siguiente fila disponible
            $newRange = 'Sheet1!A' . $nextRow . ':C' . $nextRow;

            // Actualizar los valores en la siguiente fila disponible
            $this->googleSheets->updateValues($spreadsheetId, $newRange, $values);

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
            'file' => 'required|mimes:pdf,jpeg,png,jpg,gif|max:2048', // Permitir imágenes y PDFs
        ]);
    
        // Almacenar el archivo en la carpeta adecuada
        $path = $request->file('file')->store('pdfs', 'local_pdfs');
    
        Document::create([
            'empleado_id' => $request->empleado_id,
            'type' => $request->type,
            'file_path' => $path,
        ]);
    
        return back()->with('success', 'Documento importado exitosamente.');
    }
    public function download(Request $request)
    {
        $request->validate([
            'empleado_id_download' => 'required|exists:empleados,id',
            'type_download' => 'required|in:all,contract,signature',
        ]);

        $empleado = Empleado::findOrFail($request->empleado_id_download);

        $query = $empleado->documents();

        if ($request->type_download !== 'all') {
            $query->where('type', $request->type_download);
        }

        $documents = $query->get();

        $zip = new ZipArchive();
        $zipFileName = 'documents_' . $empleado->id . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($documents as $document) {
                $filePath = storage_path('app/public/' . $document->file_path);

                // Verificar si el archivo existe antes de agregarlo al ZIP
                if (file_exists($filePath)) {
                    $zip->addFile($filePath, basename($filePath));
                } else {
                    return back()->with('error', 'El archivo ' . basename($filePath) . ' no se encuentra.');
                }
            }
            $zip->close();
        } else {
            return back()->with('error', 'No se pudo crear el archivo ZIP.');
        }

        return response()->download($zipFilePath);
    }

    public function showDownloadForm()
    {
        $empleados = Empleado::all();
        return view('documents.download', compact('empleados'));
    }
}   
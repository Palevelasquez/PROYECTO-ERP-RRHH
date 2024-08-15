<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleSheetsService;
use ZipArchive;
use Illuminate\Support\Facades\Log;
use ZipStream\ZipStream;


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
    // Obtén la lista de IDs de los documentos a descargar
    $documentIds = $request->input('document_ids');

    // Asegúrate de que la lista de documentos no está vacía
    if (empty($documentIds)) {
        return back()->with('error', 'No se seleccionaron documentos.');
    }

    // Ruta donde se almacenan los documentos
    $basePath = storage_path('app/public/pdfs');

    foreach ($documentIds as $documentId) {
        // Encuentra el documento en la base de datos
        $document = Document::find($documentId);

        // Verifica si el documento existe
        if ($document) {
            // Construye la ruta completa del archivo
            $filePath = $basePath . '/' . $document->file_path;

            // Verifica si el archivo existe
            if (file_exists($filePath)) {
                // Devuelve el archivo como descarga
                return response()->download($filePath);
            } else {
                // Registra un error si el archivo no se encuentra
                Log::error("El archivo no existe: {$filePath}");
            }
        } else {
            return back()->with('error', 'Documento no encontrado.');
        }
    }

    return back()->with('error', 'Ocurrió un problema al intentar descargar el documento.');
}

    public function showDownloadForm()
    {
        $empleados = Empleado::all();
        return view('documents.download', compact('empleados'));
    }

    public function getDocumentsByEmployee(Request $request, $empleado_id)
    {
        $documents = Document::where('empleado_id', $empleado_id)->get();
        return response()->json($documents);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $employees = Empleado::where('Nombre', 'LIKE', "%$query%")
            ->orWhere('ApellidoPaterno', 'LIKE', "%$query%")
            ->get();
    
        return response()->json($employees);
    }
}   
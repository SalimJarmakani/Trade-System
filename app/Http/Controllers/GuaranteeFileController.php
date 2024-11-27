<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuaranteeFile;
use App\Repositories\GuaranteeRepository;
use Exception;

class GuaranteeFileController extends Controller
{
    protected $guaranteeRepository;

    public function __construct(GuaranteeRepository $guaranteeRepository)
    {
        $this->guaranteeRepository = $guaranteeRepository;
    }
    public function store(Request $request)
    {

        try {
            // Validate the uploaded file
            $validated = $request->validate([
                'file' => 'required|file|mimes:csv,txt,xml,json|max:10240',
            ]);

            // Get the uploaded file
            $file = $request->file('file');
            $fileType = $file->getClientOriginalExtension();
            $fileContent = file_get_contents($file);

            // Use repository to handle processing and saving
            $this->guaranteeRepository->processAndStoreFile($fileType, $fileContent);

            // Return a response after saving the file
            return redirect()->route('guarantee.upload')->with('success', 'File uploaded and processed successfully!');
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function upload()
    {
        return view("guarantee.upload");
    }

    public function files()
    {

        $guarantees = $this->guaranteeRepository->GetAllGuaranteeFiles();

        return view("guarantee.files", compact('guarantees'));
    }

    public function downloadFile($id)
    {

        $file = $this->guaranteeRepository->GetGuaranteeFileById($id);

        // Generate filename with ID
        $fileName = "guarantee_{$id}_{$file->corporate_reference_number}." . $file->file_type;
        return response($file->file_content)
            ->header('Content-Type', $this->getMimeType($file->file_type))
            ->header('Content-Disposition', "attachment; filename=\"{$fileName}\"");
    }

    private function getMimeType($fileType)
    {
        return match ($fileType) {
            'csv' => 'text/csv',
            'xml' => 'application/xml',
            'json' => 'application/json',
            default => 'application/octet-stream',
        };
    }
}

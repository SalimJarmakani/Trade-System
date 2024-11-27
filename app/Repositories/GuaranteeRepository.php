<?php

namespace App\Repositories;

use App\Models\Guarantee;
use App\Models\GuaranteeFile;

class GuaranteeRepository
{

    public function getById($id)
    {

        // Find the guarantee by its corporate_reference_number
        return Guarantee::where('corporate_reference_number', $id)->firstOrFail();
    }

    public function getAll()
    {

        return Guarantee::all();
    }

    public function create($data)
    {

        return Guarantee::create($data);
    }

    public function delete($id)
    {
        $guarantee = Guarantee::where("corporate_reference_number", $id);
        $guarantee->delete();

        return true;
    }

    public function update(array $data, string $corporateReferenceNumber)
    {
        // Find the guarantee by its corporate_reference_number
        $guarantee = Guarantee::where('corporate_reference_number', $corporateReferenceNumber)->firstOrFail();

        // Update the guarantee with the provided data
        return $guarantee->update($data);
    }

    public function processAndStoreFile(string $fileType, string $fileContent)
    {
        $data = [];

        // Parse the file based on its type
        if ($fileType === 'csv') {
            $rows = array_map('str_getcsv', explode("\n", $fileContent));
            $header = array_map('trim', $rows[0]);
            $values = array_map('trim', $rows[1]); // Assuming one record per file
            $data = array_combine($header, $values);
        } elseif ($fileType === 'xml') {
            $xml = simplexml_load_string($fileContent);
            $data = json_decode(json_encode($xml), true); // Convert to array
        } elseif ($fileType === 'json') {
            $data = json_decode($fileContent, true);
        }

        // Ensure all required fields exist
        $requiredFields = [
            'corporate_reference_number',
            'guarantee_type',
            'nominal_amount',
            'nominal_amount_currency',
            'expiry_date',
            'applicant_name',
            'applicant_address',
            'beneficiary_name',
            'beneficiary_address',
        ];

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $data)) {
                throw new \Exception("Missing required field: {$field}");
            }
        }


        // Create Guarantee record
        $guarantee = Guarantee::create([
            'corporate_reference_number' => $data['corporate_reference_number'],
            'guarantee_type' => $data['guarantee_type'],
            'nominal_amount' => $data['nominal_amount'],
            'nominal_amount_currency' => $data['nominal_amount_currency'],
            'expiry_date' => $data['expiry_date'],
            'applicant_name' => $data['applicant_name'],
            'applicant_address' => $data['applicant_address'],
            'beneficiary_name' => $data['beneficiary_name'],
            'beneficiary_address' => $data['beneficiary_address'],
        ]);
        GuaranteeFile::create([
            'corporate_reference_number' => $guarantee->corporate_reference_number, // Use corporate_reference_number instead of id
            'file_type' => $fileType,
            'file_content' => $fileContent,
        ]);

        return true;
    }

    public function GetAllGuaranteeFiles()
    {

        $guarantees = GuaranteeFile::with("guarantee")->get();

        return $guarantees;
    }

    public function GetGuaranteeFileById($id)
    {

        $guaranteeFile = GuaranteeFile::findOrFail($id);

        return $guaranteeFile;
    }
}

<?php

namespace App\Services;

use Google\Client as Google_Client;
use Google\Service\Sheets as Google_Service_Sheets;
use Google\Service\Sheets\ValueRange as Google_Service_Sheets_ValueRange;

class GoogleSheetsService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setApplicationName('Laravel Google Sheets API');
        $this->client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(storage_path('app/google-sheets-credentials.json'));
        $this->client->setAccessType('offline');

        $this->service = new Google_Service_Sheets($this->client);
    }

    public function getSpreadsheet($spreadsheetId)
    {
        return $this->service->spreadsheets->get($spreadsheetId);
    }

    public function getValues($spreadsheetId, $range)
    {
        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
        return $response->getValues();
    }

    public function updateValues($spreadsheetId, $range, $values)
    {
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        return $this->service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    }
}

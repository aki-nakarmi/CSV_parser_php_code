<?php
namespace Utilities;

class ResultFormatter {
    /**
     * Format the csv record and return the result array.
     * @param string $filename
     * @param array $header
     * @param array $records
     * @return array
     */
    public function formatResult( string $filename, array $header,array $records): array
    {
        return [
            "filename" => $filename,
            "failure_code" => $header[1] ?? '',
            "failure_message" => $header[2] ?? '',
            "records" => $records
        ];
    }
}
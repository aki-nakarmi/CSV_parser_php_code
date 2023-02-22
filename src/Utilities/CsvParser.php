<?php
namespace Utilities;

class CsvParser {
     protected $colSize=16;

    /**
     * Parse a CSV file and return the results as an array.
     * @param string $filename
     * @return array
     * @throws \Exception
     */
    public function parseFile(string $filename): array {
        $file = fopen($filename, "r");
        if ($file === false) {
            throw new \Exception("Unable to open file: $filename");
        }
        $header = fgetcsv($file);

        $records = [];
        while(!feof($file)) {
            $record = fgetcsv($file);
            if(count($record) == $this->colSize) {
                $records[] =  $record;
            }
        }
        fclose($file);
        return [
            "header"=>$header,
            "records"=>$records,
        ];
    }
}

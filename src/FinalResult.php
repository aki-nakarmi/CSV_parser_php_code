<?php

class FinalResult
{
    private $parser;
    private $validator;
    private $formatter;

    public function __construct() {
        $this->parser = new \Utilities\CsvParser();
        $this->validator = new \Utilities\RecordValidator();
        $this->formatter = new \Utilities\ResultFormatter();
    }

    /**
     *
     * @param string $filename
     * @return array
     * @throws Exception
     */
    public function results(string $filename): array
    {
        try {
            $content = $this->parser->parseFile($filename);
            $header=$content["header"];
            $validRecords = [];
            foreach ($content["records"] as $record) {
                $validRecord = $this->validator->validateRecord($record,$header);
                if ($validRecord) {
                    $validRecords[] = $validRecord;
                }
            }
            return $this->formatter->formatResult(basename($filename), $header, $validRecords);
        } catch (Exception $e) {
            throw new Exception("Error processing file: $filename - " . $e->getMessage());
        }
    }
}

?>

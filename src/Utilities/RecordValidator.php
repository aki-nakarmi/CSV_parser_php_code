<?php
namespace Utilities;

class RecordValidator {
    /**
     * Validate a CSV record and return the parsed record as an array.
     * @param array $record
     * @param array $header
     * @return array
     */
    public function validateRecord(array $record,array $header): array
    {
        $currency = $header[0] ?? '';
        $amount = (float)$record[8] ?? 0;
        $subunits = (int) ($amount * 100);
        $accountNumber = (isset($record[6])&&!empty($record[6]))?(int)$record[6]: "Bank account number missing";
        $branchCode = (isset($record[2])&&!empty($record[2])) ?$record[2]: "Bank branch code missing";
        $endToEndId = ($record[10]&&$record[11])?sprintf("%s%s",$record[10],$record[11]):  "End to end id missing";

        return [
            "amount" => [
                "currency" => $currency,
                "subunits" => $subunits
            ],
            "bank_account_name" => str_replace(" ", "_", strtolower($record[7]??"")),
            "bank_account_number" => $accountNumber,
            "bank_branch_code" => $branchCode,
            "bank_code" => $record[0] ?? '',
            "end_to_end_id" => $endToEndId,
        ];
    }
}

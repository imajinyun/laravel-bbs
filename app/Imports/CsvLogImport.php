<?php

namespace App\Imports;

use App\Models\Log;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvLogImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $row = array_filter(array_values($row));
        $arr = Arr::get($row, 0, []);
        $log = is_array($arr) ? $arr : json_decode($arr, true);

        $message = Arr::get($log, 'msg', '');
        $content = Arr::get($log, 'content', '');
        if (!$message && !$content) {
            return;
        }

        return new Log([
            'trace_id' => Arr::get($log, 'trace_id', ''),
            'uri' => Arr::get($log, 'uri', ''),
            'level' => Arr::get($log, 'level', 'notice'),
            'message' =>
            'content' => json_encode(Arr::get($log, 'extra_data', [])),
            'reported_at' => Arr::get($log, 'time', now()->toDateTimeString()),
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 5;
    }

    public function chunkSize(): int
    {
        return 5;
    }
}

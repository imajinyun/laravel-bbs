<?php

namespace App\Console\Commands;

use App\Imports\CsvLogImport;
use Excel;
use Illuminate\Console\Command;

class CsvLogImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bbs:csv-log-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import log from csv file to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->title('Starting CSV file import to database...');
        Excel::import(new CsvLogImport(), storage_path('log.csv'), null, \Maatwebsite\Excel\Excel::CSV);
        $this->success('Import log to database successfully!');
    }
}

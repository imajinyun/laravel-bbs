<?php

namespace App\Console\Commands;

use App\Imports\LogImport;
use App\Jobs\CsvImportLogJob;
use Excel;
use Illuminate\Console\Command;

class CsvImportLogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bbs:csv-import-log';

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
        Excel::import(new LogImport(), storage_path('log.csv'), null, \Maatwebsite\Excel\Excel::CSV);
        $this->success('Import log to database successfully!');
    }
}

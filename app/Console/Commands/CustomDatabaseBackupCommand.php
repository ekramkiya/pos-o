<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;



class CustomDatabaseBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
  

    public function handle()
    {
        // Backup the database schema
        $this->call('backup:run', [
            '--only-db' => true,
            '--disable-notifications' => true,
        ]);
    
        // Backup specific rows or records
        $tableName = 'orders'; // Replace with the name of your table
        $backupPath = storage_path('app/backup'); // Specify the backup path
    
        $data = DB::table($tableName)->all()->get();
        // Replace 'column' and 'value' with the appropriate conditions to select the desired rows
    
        $backupData = $data->toArray();
        $backupFile = $backupPath . '/' . date('Y-m-d-H-i-s') . '.json';
        file_put_contents($backupFile, json_encode($backupData));
    
        $this->info('Database backup created successfully.');
    }
}

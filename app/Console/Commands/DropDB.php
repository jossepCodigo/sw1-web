<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use PDO;

class DropDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('');
        $this->comment('=====================================');
        // Fetch the defined database name
        $db_type = Config::get('database.default');
        $connection = Config::get('database.connections.' . $db_type);
        $driver = $connection['driver'];
        $host = $connection['host'];
        $port = $connection['port'];
        $username = $connection['username'];
        $password = $connection['password'];
        $database = $connection['database'];
        $charset = $connection['charset'];
        $collation = $connection['collation'];

        $this->info('Current DataBase: ' . $database);
        $db = $database;
        $this->comment('-------------------------------------');
        // Try to create it
        try {
            // Create connection
            $pdo = new PDO("{$driver}:host={$host};port={$port};dbname={$db}", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Create database
            $sqlcreate = "CREATE DATABASE {$db}";
            $response = $pdo->exec($sqlcreate);
            $pdo = null;

            if ($response == 1) {
                $this->info("Sucessfully created database {$db}!");
            } else {
                $this->error("Error creating database: " . implode("; ", $pdo->errorInfo()));
                return 1;
            }
            return 0;
        } catch (PDOException $e) {
            $this->error('There was a problem creating database "' . $db . '"');
            $this->error($e->getMessage());
            return 1;
        }
    }
}

<?php

namespace App\Database;

use PDO;
use PDOException;
use \Exception;

class RunMigration
{
    protected $schema;

    public function __construct()
    {
    }

    public function runMigration(): void
    {
        $pdo = DB::getInstance();
        
        $files = glob(__DIR__ . '/migrations/*.php');// Получаем список всех php-файлов в папке migrations
        natcasesort($files);
        foreach ($files as $str) {
            $fileName = str_replace('.php', '', basename($str));
            
            $parts = explode("_", $fileName);
            $className = end($parts);
            require_once  'migrations/'.$fileName.'.php';

            $instance = new $className($pdo);
            $tableName = $instance->getTableName();
            $exists = $this->tableExists($pdo, $tableName);
            
            if (!$exists) {
                $instance->up($pdo);
            }
        }
        $pdo = null;
    }

    function tableExists(PDO $pdo, $tableName) {

        try {
            $result = $pdo->query("SELECT 1 FROM {$tableName} LIMIT 1");
        } catch (Exception $e) {
            return FALSE;
        }
    
        return $result !== FALSE;
    }

    function DBExists(PDO $pdo, string $DBName) {

        $stmt = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = $DBName");
        return (bool) $stmt->fetchColumn();
    }


}

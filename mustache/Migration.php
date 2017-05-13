<?php

namespace Mustache;

use PDO;

class Migration
{
    /**
     * Run Migration
     */
    public function run()
    {
        $table = 'migration';
        $tableExists = Database::getInstance()->query("SHOW TABLES LIKE '$table'")->rowCount();
        if ($tableExists === 0) {
            $this->createMigration();
        } else {
            $this->updateMigration();
        }
    }

    /**
     * Execute Revert of Migration
     * @param null $table
     */
    public function revert($table = null)
    {
        $con = Database::getInstance();
        $query = "select id, file, table_name, created_at from migration ";
        if (!empty($table)) {
            $query .= " where table_name = :table_name ";
        }
        $query .= " order by created_at desc ";
        $stmt = $con->prepare($query);
        if (!empty($table)) {
            $stmt->bindValue(':table_name', $table);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $line) {
            $queryDrop = file_get_contents(APPPATH . '/migration/revert/' . $line['file']);
            $con->query($queryDrop);
            $queryRemoveMigration = "delete from migration where table_name = :table_name";
            $stmt = $con->prepare($queryRemoveMigration);
            $stmt->bindValue(':table_name', $line['table_name']);
            $stmt->execute();
            Cli::printnl("Table " . $line['table_name'] . " droped successfully");
        }
        Cli::printnl("Revert successfully");
    }

    /**
     * Create a migration
     * @throws \Exception
     */
    private function createMigration()
    {
        if (!$this->genereteMigrationTable()) {
            throw new \Exception("Could not create table Migration");
        }
        $path = APPPATH . '/migration/apply';
        $arrMigrationsFiles = scandir($path);
        $con = Database::getInstance();
        foreach ($arrMigrationsFiles as $file) {
            if ($file != '.' && $file != '..') {
                $query = file_get_contents($path . '/' . $file);
                $con->query($query);
                $tablename = str_replace('.sql','', explode('_', $file)[2]);
                $queryMigrate = "INSERT INTO migration (file, table_name) VALUES (:file, :table_name)";
                $stmt = $con->prepare($queryMigrate);
                $stmt->bindValue(':file', $file);
                $stmt->bindValue(':table_name', $tablename);
                if (!$stmt->execute()) {
                    throw new \Exception("Error updating migrations table");
                } else {
                    Cli::printnl("Table $tablename created successfully");
                }
            }
        }
    }

    /**
     * Update a parcial Migration
     * @throws \Exception
     */
    private function updateMigration()
    {
        $path = APPPATH . '/migration/apply';
        $arrMigrationsFiles = scandir($path);
        $con = Database::getInstance();

        $query = "SELECT id, file, table_name, created_at FROM migration ";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($arrMigrationsFiles as $file) {
            $rowFree = true;
            if ($file != '.' && $file != '..') {

                foreach ($result as $line) {
                    if (in_array($file, $line)) {
                        $rowFree = false;
                    }
                }

                if ($rowFree) {
                    $query = file_get_contents($path . '/' . $file);
                    $con->query($query);
                    $tablename = str_replace('.sql','', explode('_', $file)[2]);
                    $queryMigrate = "INSERT INTO migration (file, table_name) VALUES (:file, :table_name)";
                    $stmt = $con->prepare($queryMigrate);
                    $stmt->bindValue(':file', $file);
                    $stmt->bindValue(':table_name', $tablename);
                    if (!$stmt->execute()) {
                        throw new \Exception("Error updating migrations table");
                    } else {
                        Cli::printnl("Table $tablename created successfully");
                    }
                }
            }
        }

    }

    /**
     * Create a migration table for internal framework controller
     * @return \PDOStatement
     */
    private function genereteMigrationTable()
    {
        $query = "CREATE TABLE migration (
                    id int unsigned not null auto_increment,
                    file varchar(150) not null,
                    table_name varchar(150) not null,
                    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
                    primary key(id)
                ) ENGINE=InnoDB";
        $con = Database::getInstance();
        return $con->query($query);
    }
}
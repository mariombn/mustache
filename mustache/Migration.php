<?php

namespace Mustache;

class Migration
{
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
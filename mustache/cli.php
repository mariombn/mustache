<?php

namespace Mustache;

class Cli
{
    private $command;
    private $parameters = array();

    public function main($args = false)
    {
        if (!$args) throw new \Exception('Invalid parameter in cli');

        foreach ($args as $k => $arg) {
            if ($k == 1) $this->command = $arg;
            if ($k >= 2) $this->parameters[] = $arg;
        }

        switch ($this->command) {
            case 'generete':
                $this->generete();
                break;
            case 'migrate':
                // TODO: Need to be thought of in the logic for the revert of the tables
                $this->migrate();
                break;
            default:
                $this->help();
        }

    }

    private function help()
    {
        self::printnl('');
        self::printnl('=== Cli - Your Command Line Attendant for Mustache! ===');

        self::printnl('Command List:');
        self::printnl('  generete                                       -> Generates a php Model or Controller class file');
        self::printnl('    generete model ModelName                     -> Generates a php Model class file');
        self::printnl('    generete controller ControllerNameController -> Generates a php Controller class file');
        self::printnl('    generete migration tablename                 -> Generates a sql script for create and drop table');

        self::printnl('');
        self::printnl('=======================================================');
    }

    private function generete()
    {
        $type = $this->parameters[0];
        $name = $this->parameters[1];

        switch ($type) {
            case 'controller':
                $file_path = APPPATH . '/mustache/material/controller_part';
                $file = file_get_contents($file_path);
                $file = str_replace('{NAME_CLASS}', $name, $file);
                file_put_contents(APPPATH . '/app/controller/' . $name . '.php', $file);
                break;
            case 'model':
                $file_path = APPPATH . '/mustache/material/model_part';
                $file = file_get_contents($file_path);
                $file = str_replace('{NAME_CLASS}', $name, $file);
                file_put_contents(APPPATH . '/app/model/' . $name . '.php', $file);
                break;
            case 'migration':
                $this->genereteMigration($name);
                break;
            default:
                throw new \Exception('It is not possible to generate the specified parameter.');
        }
    }

    private function migrate()
    {
        $migrate = new Migration();
        $migrate->run();
    }

    private function genereteMigration($name)
    {
        $file_path = APPPATH . '/mustache/material/apply.sql';
        $file = file_get_contents($file_path);
        $file = str_replace('{TABLE_NAME}', $name, $file);
        $path_name = APPPATH . '/migration/apply/';
        $file_name = date('Y-m-d_His') . '_' . $name . '.sql';
        file_put_contents($path_name . $file_name, $file);
        self::printnl('');
        self::printnl('File ' . $file_name . ' created in ' . $path_name);
        $file_path = APPPATH . '/mustache/material/revert.sql';
        $file = file_get_contents($file_path);
        $file = str_replace('{TABLE_NAME}', $name, $file);
        $path_name = APPPATH . '/migration/revert/';
        $file_name = date('Y-m-d_His') . '_' . $name . '.sql';
        file_put_contents($path_name . $file_name, $file);
        self::printnl('File ' . $file_name . ' created in ' . $path_name);
    }
    
    public static function printnl($buffer)
    {
        echo "$buffer\n";
    }
}
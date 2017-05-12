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
            case 'console':
                $this->console();
                break;
            case 'generete':
                $this->generete();
                break;
            case 'migrate':
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
        self::printnl('  __       __                        __                          __  ');
        self::printnl('  |  \     /  \                      |  \                        |  \  ');
        self::printnl('  | $$\   /  $$ __    __   _______  _| $$_     ______    _______ | $$____    ______  ');
        self::printnl('  | $$$\ /  $$$|  \  |  \ /       \|   $$ \   |      \  /       \| $$    \  /      \  ');
        self::printnl('  | $$$$\  $$$$| $$  | $$|  $$$$$$$ \$$$$$$    \$$$$$$\|  $$$$$$$| $$$$$$$\|  $$$$$$\  ');
        self::printnl('  | $$\$$ $$ $$| $$  | $$ \$$    \   | $$ __  /      $$| $$      | $$  | $$| $$    $$  ');
        self::printnl('  | $$ \$$$| $$| $$__/ $$ _\$$$$$$\  | $$|  \|  $$$$$$$| $$_____ | $$  | $$| $$$$$$$$  ');
        self::printnl('  | $$  \$ | $$ \$$    $$|       $$   \$$  $$ \$$    $$ \$$     \| $$  | $$ \$$     \  ');
        self::printnl('   \$$      \$$  \$$$$$$  \$$$$$$$     \$$$$   \$$$$$$$  \$$$$$$$ \$$   \$$  \$$$$$$$  ');
        self::printnl('');
        self::printnl('Command List:');
        self::printnl('  generete                                       -> Generates a php Model or Controller class file');
        self::printnl('    generete model ModelName                     -> Generates a php Model class file');
        self::printnl('    generete controller ControllerNameController -> Generates a php Controller class file');
        self::printnl('    generete migration tablename                 -> Generates a sql script for create and drop table');
        self::printnl('  migrate                                        -> Rotate the scripts inside the directory /migration/apply/');
        self::printnl('    migrate revert <table_name>                  -> Revert migration on the scripts inside the diretory /migration/revert/');
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

        if (count($this->parameters) == 0) {
            $migrate->run();
        } else {
            switch ($this->parameters[0]) {
                case 'apply':
                    $migrate->run();
                    break;
                case 'revert':
                    if (empty($this->parameters[1])) {
                        $migrate->revert();
                    } else {
                        $migrate->revert($this->parameters[1]);
                    }
                    break;
            }
        }
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

    public function console()
    {
        if (count($this->parameters) == 0) {
            self::printnl('No parameters entered for the command "console"');
            exit;
        }
        $args = array();
        foreach ($this->parameters as $k =>$parameter) {
            if ($k == 0) {
                $command = $parameter;
            } else {
                $args[] = $parameter;
            }
        }

        $console = new \App\Controller\ConsoleController();
        if (method_exists($console, $command)) {
            if (count($args) == 0) {
                $console->$command();
            } else {
                $console->$command($args);
            }
        } else {
            self::printnl('Command not implemented');
        }
    }
    
    public static function printnl($buffer)
    {
        echo "$buffer\n";
    }
}
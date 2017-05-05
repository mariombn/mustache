<?php

namespace Mustache;

class Model
{
    public function teste()
    {
        Debug::dump(get_object_vars ($this));
        Debug::dump(get_class ($this));
    }

    public function save()
    {
        $atributes = get_object_vars ($this);
        if (count($atributes) > 0) {
            $tableName = $this->getTableName();
            if (!array_key_exists('id', $atributes)) {
                $this->insert($tableName, $atributes);
                // TODO: No Insert, é necessário obter o ID feito pelo auto_increment e coloca-lo no objeto antes de devolver
            } else {
                $this->update($tableName, $atributes);
            }
        }
        return $this;
    }

    /**
     * This method is responsible for making the dynamic INSERT in the database
     * @param $tableName
     * @param $atributes
     * @return bool
     */
    private function insert($tableName, $atributes)
    {
        $query = "insert into $tableName (";
        foreach ($atributes as $k => $v) {
            $query .= "$k,";
        }
        $query = substr($query, 0, -1);
        $query .= ") values (";
        foreach ($atributes as $k => $v) {
            $query .= ":$k,";
        }
        $query = substr($query, 0, -1);
        $query .= ");";
        $connect = Database::getInstance()->prepare($query);
        foreach ($atributes as $k => $v) {
            $connect->bindValue(':' . $k, $v);
        }

        return $connect->execute();
    }

    /**
     * This method is responsible for making the dynamic UPDATE in the database
     * @param $tableName
     * @param $atributes
     * @return bool
     */
    private function update($tableName, $atributes)
    {
        $query = "update $tableName set ";
        foreach ($atributes as $k => $v) {
            if ($k != 'id') {
                $query .= "$k = :$k,";
            }
        }
        $query = substr($query, 0, -1);
        $query .= " WHERE id = :id;";

        $connect = Database::getInstance()->prepare($query);
        foreach ($atributes as $k => $v) {
            $connect->bindValue(':' . $k, $v);
        }
        return $connect->execute();
    }

    private function getTableName()
    {
        $strClassName = get_class($this);
        $arrClassName = explode('\\', $strClassName);

        if (count($arrClassName) != 3) return false;
        if ($arrClassName[0] != 'App') return false;
        if ($arrClassName[1] != 'Model') return false;
        return strtolower ($arrClassName[2])     . 's';
    }
}
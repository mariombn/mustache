<?php

namespace Mustache;

use PDO;

class Model
{
    /**
     * @var int null
     */
    public $id;

    /**
     * Model constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        if (!empty($id)) {
            $this->id = $id;
            $this->load();
        }
    }

    /**
     * Loads the entity from the ID attribute
     * @throws \Exception
     */
    public function load()
    {
        if (empty($this->id) || !is_int($this->id)) {
            throw new \Exception("Invalid ID attribute");
        }
        $id = $this->id;
        $tableName = $this->getTableName();
        $query = "SELECT * FROM $tableName WHERE id = :id";
        $con = Database::getInstance()->prepare($query);
        $con->bindParam(':id', $id);
        $con->execute();
        if ($con->rowCount()> 0) {
            $result = $con->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $k => $v) {
                $this->$k = $v;
            }
        }
    }

    /**
     * Loads the entity from a specific attribute and a value
     * @param $atribute
     * @param $value
     */
    public function loadBy($atribute, $value)
    {
        $tableName = $this->getTableName();
        $query = "SELECT * FROM $tableName WHERE $atribute = :value";
        $con = Database::getInstance()->prepare($query);
        $con->bindParam(':value', $value);
        $con->execute();
        if ($con->rowCount()> 0) {
            $result = $con->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $k => $v) {
                $this->$k = $v;
            }
        }
    }

    /**
     * Returns a collection of objects in the class based on a where clause
     * @param string $where
     * @return array|bool
     */
    public function where($where = '1=1')
    {
        return $this->listCollection($where);
    }

    /**
     * Returns a collection of objects in the class
     * @param null $where
     * @return array|bool
     */
    public function listCollection($where = null)
    {
        $tableName = $this->getTableName();
        $query = "SELECT * FROM $tableName ";

        if (!empty($where)) {
            $query .= " WHERE $where";
        }

        $con = Database::getInstance()->prepare($query);
        $con->execute();
        $result = $con->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) return false;
        $strClassName = get_class($this);
        $return = array();
        foreach ($result as $line) {
            $strClassName = get_class($this);
            $modal = new $strClassName();
            foreach ($line as $k => $v) {
                $modal->$k = $v;
            }
            $return[] = $modal;
        }
        return $return;
    }

    /**
     * Method responsible for saving the values of the entity attributes in the Database
     * @return $this
     */
    public function save()
    {
        $atributes = get_object_vars ($this);

        if (count($atributes) > 0) {
            $tableName = $this->getTableName();
            if (empty($this->id)) {
                $this->insert($tableName, $atributes);
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
     * @return void
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
        $con = Database::getInstance();
        $connect = $con->prepare($query);
        foreach ($atributes as $k => $v) {
            $connect->bindValue(':' . $k, $v);
        }

        if ($connect->execute()) {
            $this->id = $con->lastInsertId();
        }
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

    /**
     * Return a table name
     * @return bool|string
     */
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
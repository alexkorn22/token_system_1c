<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 13.11.2017
 * Time: 12:42
 */

namespace core\base;
use core\DB;

abstract class Model
{
    public static $tableName;
    public static $db; // DB class object.
    public $id;
    protected $attributes = array();

    public function __construct()
    {
        self::setDB();
    }

    public static function setDB()
    {
        if (!self::$db) {
            self::$db = DB::getInstance();
        }
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->attributes)) {
            $this->attributes[$name] = $value;
        }
    }

    public function __get($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
    }

    public function load($data)
    {

        foreach ($this->attributes as $key => $value) { // title = ... , sort = ...
            if (isset($data[$key])) {
                $this->attributes[$key] = $data[$key];
            }
        }

        // debug($this->attributes);
    }


    public static function findAll($options = [], $limit = false){
        self::setDB();
        $sql = "SELECT * FROM " . static::$tableName;

        if (count($options) > 0) {
            $key_value = [];
            foreach ($options as $key => $value) {
                $key_value[] = "{$key} = ? ";
            }

            $sql .= " WHERE ";
            $sql .= join('AND ', $key_value);

        }

        if ($limit) {
            $sql .= " LIMIT 1";
        }


        $stmt = self::$db->pdo->prepare($sql);
        $result = $stmt->execute(array_values($options));

        $records = array();
        if ($result) {
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $object = new static();
                if (isset($row['id'])) {
                    $object->id = (int)$row['id'];
                }
                $object->load($row);
                $records[] = $object;
            }
        }

        return $records; // array of objects !
    }

    public static function findOneById($id){ // returns one object ! not array
        self::setDB();
        $sql = "SELECT * FROM " . static::$tableName;
        $sql .= " WHERE id = " . $id . " LIMIT 1";
        $result = self::$db->pdo->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $object = new static();
                if (isset($row['id'])) {
                    $object->id = (int)$row['id'];
                }
                $object->load($row);
                $record_object = $object;
            }
        }
        return $record_object;
    }


    public function insert()
    {
        $marks = [];
        $attr_count = sizeof(array_keys($this->attributes));
        for ($i = 0; $i < $attr_count; $i++) {
            $marks[] = '?';
        }

        $sql = "INSERT INTO " . static::$tableName;
        $sql .= " (";
        $sql .= join(',', array_keys($this->attributes));
        $sql .= ") ";
        $sql .= "VALUES (";
        $sql .= join(',', $marks);
        $sql .= ");";

        $stmt = self::$db->pdo->prepare($sql);
        $stmt->execute(array_values($this->attributes));

        $last_id = self::$db->pdo->lastInsertId();
        if ($last_id) {
            $this->id = (int)$last_id;
        }
        return $this->id;
    }

    public function update()
    {
        $key_value = [];
        foreach ($this->attributes as $key => $value) {
            $key_value[] = "{$key} = ? ";
        }
        $sql = "UPDATE " . static::$tableName . " SET ";
        $sql .= join(',', $key_value);
        $sql .= "WHERE id = ?";
        $stmt = self::$db->pdo->prepare($sql);
        $values = array_values($this->attributes);
        $values[] = $this->id;
        $stmt->execute($values);

        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }

    }

    public function save()
    {
        if (isset($this->id)) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    public static function deleteById($id){
        self::setDB();
        $sql  = "DELETE FROM ".static::$tableName;
        $sql .= " WHERE id= ? ";
        $stmt = self::$db->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function deleteByObjectId(){
        self::setDB();
        $id = $this->id;
        $sql  = "DELETE FROM ".static::$tableName;
        $sql .= " WHERE id= ? ";
        $stmt = self::$db->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

}
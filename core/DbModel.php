<?php
require_once __DIR__ . '/Model.php';

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn ($attr) => "$attr= :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function getAll($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn ($attr) => "$attr= :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE NOT $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public function login($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $sql1 = end($attributes);
        $sql2 = end($params);

        $statement = self::prepare("UPDATE $tableName SET $sql1=$sql2 WHERE $tableName . $attributes[0] = $params[0]");

        $statement->bindValue("$sql2", $where["status"]);
        $statement->bindValue("$params[0]", $where["username"]);

        $statement->execute();
    }



    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }
}

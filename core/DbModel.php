<?php
require_once __DIR__ . '/Model.php';
require_once __DIR__ . '/exception/ForbiddenException.php';

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


    public function cari($keyword)
    {
        $tableName = Users::tableName();
        $sql = ":" . "username";

        $statement = self::prepare("SELECT * FROM $tableName WHERE username LIKE $sql");
        $statement->bindValue("$sql", $keyword);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUser($data)
    {
        if (empty($data)) throw new ForbiddenException();
        $tableName = Users::tableName();
        $attributes = array_keys($data);
        $params = implode(" = ", array_map(fn ($attr) => "$attr= :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $params");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $data['unique_id']);
        }

        $statement->execute();
        if (!$statement->execute()) {
            return false;
        } else {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function chat($data)
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName
                            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                            WHERE (outgoing_msg_id = :outgoing_msg_id AND incoming_msg_id = :incoming_msg_id)
                            OR (outgoing_msg_id = :incoming_msg_id AND incoming_msg_id = :outgoing_msg_id) ORDER BY msg_id");

        $statement->bindValue(":outgoing_msg_id", $data["outgoing_msg_id"]);
        $statement->bindValue(":incoming_msg_id", $data["incoming_msg_id"]);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateChat($data)
    {
        $tableName = ChatModel::tableName();
        $attributes = array_keys($data);

        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");

        foreach ($data as $key => $item) {
            $statement->bindValue(":$key", $item);
        }


        $statement->execute();
    }



    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }
}

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

        if ($statement->bindValue(":$attribute", $this->{$attribute}) === true) {
            $this->saveUser([
                "unique_id" => $this->unique_id
            ]);
        }

        $statement->execute();

        return true;
    }

    public function saveUser($data)
    {

        $tableName = 'profile';
        $unique_id = array_keys($data);
        $attributes = array_keys([
            'name' => ' ',
            'city' => ' ',
            'profesi' => ' ',
            'phone' => ' ',
            'unique_id' => $unique_id,
        ]);

        $params = array_map(fn ($attr) => ":$attr", $attributes);

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ")");
        $statement->bindValue(":name", " ");
        $statement->bindValue(":city", " ");
        $statement->bindValue(":profesi", " ");
        $statement->bindValue(":phone", " ");
        $statement->bindValue(":unique_id", $data["unique_id"]);

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

    public function getProfile($where)
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
        $attributes = array_keys(['username' => $where['username']]);
        $value =  array_keys([
            'status' => $where["status"],
            'last_at' => $where["last_at"]
        ]);
        $params = implode(",", array_map(fn ($attr) => "$attr = :$attr", $value));
        $sql = implode(",", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("UPDATE $tableName SET $params WHERE $tableName . $sql");

        $statement->bindValue(":status", $where["status"]);
        $statement->bindValue(":username", $where["username"]);
        $statement->bindValue(":last_at", $where["last_at"]);

        $statement->execute();
    }


    public function cari($keyword)
    {
        $tableName = Users::tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE username LIKE :username");
        $statement->bindValue(":username", $keyword);

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


    public function updateProfile()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = implode(", ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $sql = "unique_id" . " = " . ":unique_id";

        $statement = self::prepare("UPDATE $tableName SET $params WHERE $tableName . $sql");
        $statement->bindValue(":photo", $this->photo['name']);
        $statement->bindValue(":name", $this->name);
        $statement->bindValue(":city", $this->city);
        $statement->bindValue(":profesi", $this->profesi);
        $statement->bindValue(":phone", $this->phone);
        $statement->bindValue(":unique_id", $this->unique_id);

        $tmp_file = $_FILES['photo']['tmp_name'];

        $statement->execute();
        if ($statement->execute()) {
            move_uploaded_file($tmp_file, 'img/' . $this->photo['name']);
        }

        return true;
    }

    public function updateUser()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = implode(", ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $sql = "unique_id" . " = " . ":unique_id";

        $statement = self::prepare("UPDATE $tableName SET $params WHERE $tableName . $sql");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->bindValue(":unique_id", $this->unique_id);

        $statement->execute();
        return true;
    }



    public static function prepare($sql)
    {
        return App::$app->db->pdo->prepare($sql);
    }
}

<?php

class m002_add_password_to_column_table_users
{
    public function up()
    {
        $db = App::$app->db;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = App::$app->db;
        $SQL = "ALTER TABLE users DROP COLUMN password;";
        $db->pdo->exec($SQL);
    }
}

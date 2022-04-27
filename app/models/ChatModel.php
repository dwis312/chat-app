<?php


class ChatModel extends DbModel
{
    public string $incoming_msg_id = '';
    public string $outgoing_msg_id = '';
    public string $msg  = '';

    public function tableName(): string
    {
        return "messages";
    }

    public function primaryKey(): string
    {
        return "msg_id";
    }

    public function attributes(): array
    {
        return [
            "incoming_msg_id",
            "outgoing_msg_id",
            "msg",
        ];
    }

    public function rules(): array
    {
        return [
            "msg" => [self::RULE_MAX, 'max' => '150'],
        ];
    }

    public function getChat()
    {
        return parent::chat([
            "incoming_msg_id" => $_GET["unique_id"],
            "outgoing_msg_id" => App::$app->user->unique_id,
        ]);
    }

    public function insertChat()
    {
        $this->incoming_msg_id = $_GET["unique_id"];
        $this->outgoing_msg_id = App::$app->user->unique_id;
        return parent::updateChat();
    }
}

<?php

require_once dirname(dirname(__DIR__)) . '/core/Model.php';


class Forgot extends Model
{
    public string $email = '';
    public string $password = '';
    public string $cpassword = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'email',
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
        ];
    }

    public function cekEmail()
    {
        $user = Users::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email');
            return false;
        }
        return true;
    }

    public function reset()
    {
    }
}

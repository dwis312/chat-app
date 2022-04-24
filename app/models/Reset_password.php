<?php

require_once dirname(dirname(__DIR__)) . '/core/Model.php';


class Reset_password extends Model
{
    public string $password = '';
    public string $cpassword = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'password',
        ];
    }

    public function primaryKey(): string
    {
        return 'users_id';
    }

    public function rules(): array
    {
        return [
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '8'], [self::RULE_MAX, 'max' => '24']],
            'cpassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function labels(): array
    {
        return [
            'password' => 'New Password',
            'cpassword' => 'Confirm Password',
        ];
    }

    public function reset()
    {
    }
}

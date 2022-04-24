<?php

require_once dirname(dirname(__DIR__)) . '/core/Model.php';

class LoginModel extends Model
{
    const STATUS_INACTIVE = 'Offline';
    const STATUS_ACTIVE = 'Active now';

    public string $username = '';
    public string $password = '';
    public string $status = self::STATUS_INACTIVE;

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'username',
            'status',
            'password',
        ];
    }

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function login()
    {
        $user = Users::findOne(['username' => $this->username]);
        if (!$user) {
            $this->addError('username', 'User does not exist with this username');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }

        if ($user) {
            $this->status = self::STATUS_ACTIVE;
            Users::login([
                'username' => $this->username,
                'status' => $this->status,
            ]);
        }

        return App::$app->login($user);
    }
}

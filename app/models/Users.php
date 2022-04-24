<?php
require_once dirname(dirname(__DIR__)) . "/core/DbModel.php";
require_once dirname(dirname(__DIR__)) . "/core/UserModel.php";

class Users extends UserModel
{
    const STATUS_INACTIVE = 'Offline';
    const STATUS_ACTIVE = 'Active now';

    public string $username = '';
    public string $email = '';
    public string $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $unique_id = '';
    public string $cpassword = '';

    public function tablename(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'users_id';
    }

    public function getDisplayName(): string
    {
        return $this->username;
    }

    public function register()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->unique_id = rand(time(), 10000000);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function logout()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->username = App::$app->user->username;
        parent::login([
            'username' => $this->username,
            'status' => $this->status,
        ]);

        return true;
    }

    public function attributes(): array
    {
        return [
            'username',
            'email',
            'status',
            'unique_id',
            'password',
        ];
    }

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '8'], [self::RULE_MAX, 'max' => '24']],
            'cpassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'cpassword' => 'Confirm Password',
        ];
    }
}

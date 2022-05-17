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
    public string $oldPassword = '';
    public string $last_at = '';

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

    public function settingUser()
    {
        if (!empty($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        } else {
            $this->password = App::$app->user->password;
        }

        $this->unique_id = App::$app->user->unique_id;

        return parent::updateUser();
    }

    public function logout()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->username = App::$app->user->username;
        parent::login([
            'username' => $this->username,
            'status' => $this->status,
            'last_at' => date("Y-m-d h:i:sa"),
        ]);

        return true;
    }

    public function attributes(): array
    {
        if (App::$app->controller->action === "setting") {
            return $this->attributesUpdate();
        } else {
            return $this->attributesCreate();
        }
    }

    public function attributesUpdate()
    {
        return [
            'username',
            'email',
            'password',
        ];
    }

    public function attributesCreate()
    {
        return [
            'username',
            'email',
            'status',
            'unique_id',
            'password',
            'last_at',
        ];
    }

    public function rules(): array
    {
        if (App::$app->controller->action === "setting") {
            return $this->rulesUpdate();
        } else {
            return $this->rulesCreate();
        }
    }

    public function rulesUpdate()
    {
        $oldValue = App::$app->user;
        $newValue = $this;

        $rules = [];

        if ($oldValue->username !== $newValue->username) {
            $rules['username'] = [
                self::RULE_REQUIRED,
                [self::RULE_UNIQUE, 'class' => self::class],
                [self::RULE_MIN, 'min' => '2'],
                [self::RULE_MAX, 'max' => '50']
            ];
        }
        if ($oldValue->email !== $newValue->email) {
            $rules['email'] = [
                self::RULE_REQUIRED,
                [self::RULE_UNIQUE, 'class' => self::class]
            ];
        }

        if (!empty($newValue->password)) {
            $rules['password'] = [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'oldPassword'],
                [self::RULE_MIN, 'min' => '8'],
                [self::RULE_MAX, 'max' => '24']
            ];

            $rules['cpassword'] = [
                self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']
            ];
        }

        return $rules;
    }

    public function rulesCreate()
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

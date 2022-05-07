<?php

require_once __DIR__ . "/../Model.php";

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_PASSWORD_SHOW = '<span class="password-show">show</span>';
    public const TYPE_CPASSWORD_SHOW = '<span class="cpassword-show">show</span>';


    public string $type;
    public string $value;
    public string $value_password_show;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->value_password_show = ' ';
        parent::__construct($model, $attribute);
        $this->value = $this->model->{$this->attribute};
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        $this->value_password_show = self::TYPE_PASSWORD_SHOW;
        return $this;
    }

    public function cpasswordField()
    {
        $this->type = self::TYPE_PASSWORD;
        $this->value_password_show = self::TYPE_CPASSWORD_SHOW;
        return $this;
    }

    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf(
            '<input class="form-input %s" type="%s" name="%s" id="%s" placeholder=" " value="%s">',
            $this->model->hasError($this->attribute) ? 'is-invalid' : '', // input class  
            $this->type, // input type
            $this->attribute, // input name
            $this->attribute, // input id
            $this->value // input value
        );
    }

    public function renderNotif(): string
    {
        return sprintf(
            $this->value_password_show,
        );
    }
}

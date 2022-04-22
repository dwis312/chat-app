<?php

require_once __DIR__ . "/../Model.php";

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';


    public string $type;
    public string $value;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
        $this->value = $this->model->{$this->attribute};
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        $this->value = '';
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
}

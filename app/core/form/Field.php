<?php

require_once __DIR__ . "/../Model.php";

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';

    public Model $model;
    public string $attribute;
    public string $type;
    public string $value;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->value = $this->model->{$this->attribute};
    }

    public function __toString()
    {
        return sprintf(
            '
        <div class="field">
            <input class="form-input %s" type="%s" name="%s" id="%s" placeholder=" " value="%s">
            <label class="form-label" for="%s">%s</label>
            <div class="invalid-feedback %s">
                <span class="error-icon">!!!</span>
                <small class="error-message">%s</small>
            </div>
        </div>
        ',
            $this->model->hasError($this->attribute) ? 'is-invalid' : '', // input class  
            $this->type, // input type
            $this->attribute, // input name
            $this->attribute, // input id
            $this->value, // input value  
            $this->attribute, // label for
            $this->model->label()[$this->attribute], // label innerhtml
            $this->model->hasError($this->attribute) ? 'show' : '', // invalid-feedback 
            $this->model->getError($this->attribute) // invalid-feedback small
        );
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
}

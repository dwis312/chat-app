<?php

require_once __DIR__ . "/../Model.php";


abstract class BaseField
{
    public Model $model;
    public string $attribute;

    abstract public function renderInput(): string;
    abstract public function renderNotif(): string;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->value = $this->model->{$this->attribute};
    }

    public function __toString()
    {
        return sprintf(
            '
        <div class="field">
            %s
            <label class="form-label" for="%s">%s</label>
            %s
            <div class="invalid-feedback %s">
                <span class="error-icon">!!!</span>
                <small class="error-message">%s</small>
            </div>
        </div>
        ',
            $this->renderInput(),
            $this->attribute, // label for
            $this->model->getLabel($this->attribute), // label innerhtml
            $this->renderNotif(),
            $this->model->hasError($this->attribute) ? 'show' : '', // invalid-feedback 
            $this->model->getError($this->attribute) // invalid-feedback small
        );
    }
}

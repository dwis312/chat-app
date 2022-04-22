<?php


class TextareaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<textarea class="form-input %s" name="%s" placeholder=" " value="%s">%s</textarea>',
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->attribute,
            $this->value,
            $this->model->{$this->attribute},

        );
    }
}

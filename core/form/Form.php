<?php

require_once __DIR__ . "/../Model.php";

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form class="form-control" action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}

<?php

class View
{

    public function renderView($view, $params = [])
    {
        $layout = $this->renderLayout();
        $content = $this->renderContent($view, $params);
        return str_replace('{{content}}', $content, $layout);
    }

    protected function renderLayout()
    {
        $layout = App::$app->layout;
        if (App::$app->controller) {
            $layout = App::$app->controller->layout;
        }

        ob_start();
        include_once App::$ROOT_DIR . "/app/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderContent($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once App::$ROOT_DIR . "/app/views/$view.php";
        return ob_get_clean();
    }
}

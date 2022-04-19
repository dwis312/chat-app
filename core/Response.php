<?php

class Response
{
    public function getStatusCode($code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header("Location: $url");
    }
}

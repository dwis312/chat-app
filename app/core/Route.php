<?php 

require_once __DIR__ . "/Request.php";

class Route {

    public Request $request;
    public static array $routes = [];
    
    public function __construct($request)
    {
        $this->request = $request;
    }
    public static function get($path, $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = self::$routes[$method][$path] ?? false;

        if($callback === false) {
            echo "404 Not Found";
            exit;
        }

        if(is_string($callback)) {
            require_once __DIR__ ."/../views/$callback.php";
        }

        call_user_func($callback);
        
    }
}
<?php
class Router{

    protected $request;

    protected $routes;

    public function __construct(){
        $trimmed = rtrim( $_SERVER['REQUEST_URI'] , '/' );
        $this->request = strtok($trimmed,'?');
    }

    public function addRoute($route, $callback){
        if(!is_callable($callback)) throw new Exception("Callback must be callable");
        if(isset($routes[$route])) throw new Exception("Route already defined");

        $this->routes[rtrim( $route , '/' )] = $callback;
    }

    public function dispatch(){
        foreach($this->routes as $route => $callback){
            $vars = $this->routeCheck($route);
            if($vars != false){
                //echo $route;
                if(is_array($vars)){
                    call_user_func_array($callback, $vars);
                }else{
                    call_user_func($callback);
                }
                return;
            }
        }
        $controller = new PostController("Route not found :(");
        $controller->index();

    }

    public function routeCheck($route){
        $requestSegments = explode('/', $this->request);
        $routeSegments = explode('/', $route);
        $count = count($routeSegments);

        if($this->request == $route){
            return true;
        }elseif(count($requestSegments) == $count){

            $vars = [];

            for($i = 0; $i < $count; $i++){

                $segment = $routeSegments[$i];
                $reqSegment = $requestSegments[$i];

                if(preg_match('/^:.+$/', $segment) == 1){

                    $var = substr($segment, 1);
                    $vars[$var] = $reqSegment;

                }elseif($segment != $reqSegment){

                    return false;

                }
            }

            return $vars;

        }
    }

}

?>

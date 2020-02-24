<?php

class Dispatcher
{
    private $request;

    public function dispatch()
    {
        $this->request = new Request();

        Router::parse($this->request->url, $this->request);

        try
        {
            $controller = $this->load();

            if (!$controller)
            {
                http_response_code(404);
                echo 'Controller not found !!!';
                exit(0);
            }

            if (!method_exists( $controller, $this->request->action ))
            {
                http_response_code(404);
                echo 'Action not found !!!';
            }
            else
            {
                call_user_func_array( [ $controller, $this->request->action ], $this->request->params );
            }
        }
        catch (ArgumentCountError $ex)
        {
            http_response_code(404);
            echo 'Argument(s) required not found !!!';
        }
        catch (TypeError $ex)
        {
            http_response_code(400);
            echo 'Invalid argument(s) !!!';
        }
        catch (Exception $ex)
        {
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    public function load()
    {
        $name = $this->request->controller. "controller";
        $file = ROOT. 'controllers/' .$name. '.php';
        
        if (!is_file($file))
            return null;
        
        require($file);
        $controller = new $name();
        
        return $controller;
    }
}
?>
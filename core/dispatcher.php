<?php

class Dispatcher
{
    private $request;

    /**
     * 
     * Démarrage du répartiteur de requête
     * 
     */
    public function dispatch()
    {
        $this->request = new Request();

        Router::parse($this->request->url, $this->request);

        try
        {
            $controller = null;
            $name = $this->request->controller. "controller";
            $file = CONTROLLERS. '/'. $name .'.php';
            
            if (is_file($file))
            {
                require($file);
                $controller = new $name();
            }

            if (!$controller)
            {
                http_response_code(404);

                if ( DEBUG_MODE )
                    echo 'Controller '.$this->request->controller.' not found !!!';
                
                exit();
            }

            if (!method_exists( $controller, $this->request->action ))
            {
                http_response_code(404);

                if ( DEBUG_MODE )
                    echo 'Action '.$this->request->action.' not found !!!';
                
                exit();
            }
            else
            {
                call_user_func_array( [ $controller, 'parent::__construct' ], array() );
                call_user_func_array( [ $controller, $this->request->action ], $this->request->params );
            }
        }
        catch (ArgumentCountError $ex)
        {
            http_response_code(404);

            if ( DEBUG_MODE )
            {
                echo 'Argument(s) required not found !!!';
                echo $ex->getMessage();
            }
        }
        catch (TypeError $ex)
        {
            http_response_code(400);

            if ( DEBUG_MODE )
            {
                echo 'Invalid argument(s) !!!';
                echo $ex->getMessage();
            }
        }
        catch (Exception $ex)
        {
            http_response_code(500);
            
            if ( DEBUG_MODE )
            {
                echo 'Server error !!!';
                echo $ex->getMessage();
            }
        }
    }
}
?>
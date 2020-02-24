<?php

class Router
{
    static public function parse(string $url, $request)
    {
        $request->controller    = Router::get( $url, 1, 'home' );
        $request->action        = Router::get( $url, 2, 'index' );
        $request->params        = Router::param( $url, 3, array());
    }

    static public function get( string $url, int $index, $default )
    {
        $url = trim($url);
        $explode_url = explode('/', $url);

        if ( isset( $explode_url[ $index ] ) 
            && !empty( $explode_url[ $index ] ) )
            return strtolower( $explode_url[ $index ] );

        return $default;
    }

    static public function param( string $url, int $index, $default)
    {
        $url = trim($url);
        $explode_url = explode('/', $url );

        if ( isset( $explode_url[ $index ] ) 
            && !empty( $explode_url[ $index ] ) )
            return array_slice( $explode_url, $index );

        return $default;
    }

    static public function redirect( string $url )
    {
        header( 'Location: '. $url );
        exit( 0 );
    }

    static public function redirectWithParams( string $url, array $params )
    {
        foreach( $params as $param ) {
            $url .= '/'.$param;
        }

        header( 'Location: '. $url );
        exit( 0 );
    }

    static public function redirectLocal( string $controller, string $action )
    {
        header( 'Location: ./'. $controller .'/'. $action );
        exit( 0 );
    }

    static public function redirectLocalWithParams( string $controller, string $action, array $params )
    {
        $url = './'.$controller.'/'.$action;

        foreach( $params as $param ) {
            $url .= '/'.$param;
        }
        header( 'Location: '. $url );
        exit( 0 );
    }
}
?>
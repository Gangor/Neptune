<?php

class Router
{
    /**
     * 
     * Convertis la requête en object
     * 
     * @param   string $url         Requête URI
     * @param   object $request     Représentation de la requête
     * 
     */
    static public function parse(string $url, $request)
    {
        $request->controller    = Router::get( $url, 1, CONTROLLER_DEF );
        $request->action        = Router::get( $url, 2, ACTION_DEF );
        $request->id            = Router::get( $url, 3, null );
        $params                 = Router::param();

        if ( $request->id )
            array_push( $request->params, $request->id );
        
        if ( $params )
            $request->params = array_merge( $request->params, $params );
    }

    /**
     * 
     * Récupére une partie d'url
     * 
     * @param   string $url     Requête URI
     * @param   int $index      Décalage 
     * @return  string
     * 
     */
    static public function get( string $url, int $index, $default )
    {
        $url = Router::before($url, '?');
        $explode_url = explode( '/', $url );

        if ( isset( $explode_url[ $index ] ) && 
            !empty( $explode_url[ $index ] ) )
            return strtolower( $explode_url[ $index ] );

        return $default;
    }

    /**
     * 
     * Extrait la partie avant le déterminant d'un chaine de caractère
     * 
     * @param   string $str    Chaine de caractère
     * @param   string $c      Caractère de déterminant 
     * @return  string
     * 
     */
    static function before( string $str, string $c)
    {
        if ( strpos( $str, $c ) )
            return substr($str, 0, strpos( $str, $c ) );
        else
            return $str;
    }

    /**
     * 
     * Récupére les paramètres de la requête
     * 
     * @return  array
     * 
     */
    static public function param( )
    {
        $i = 0;
        $array = array();

        foreach ( array_slice( $_GET, 1 ) as $get => $key )
        {
            $array[ $i ] = $key;
            $i++;
        }
        return $array;
    }

    /**
     * 
     * Redirection vers une URL
     * 
     * @param   string $url     URL de redirection
     * 
     */
    static public function redirect( string $url )
    {
        header( 'Location: /'. $url );
        exit( 0 );
    }

    /**
     * 
     * Redirection vers une URL avec des paramètres
     * 
     * @param   string $url     URL de redirection
     * @param   array $params   Paramètres
     * 
     */
    static public function redirectWithParams( string $url, array $params )
    {
        $i = 0;

        foreach( $params as $param => $key ) {
            
            if ($i > 0)
                $url .= '&';

            $url .= $param.'='.$key;
            $i++;
        }

        header( 'Location: /'. $url );
        exit( 0 );
    }

    /**
     * 
     * Redirection vers un controlleur et une action prédéfinis
     * 
     * @param   string $url     URL de redirection
     * 
     */
    static public function redirectLocal( string $controller, string $action )
    {
        header( 'Location: /'. $controller .'/'. $action );
        exit( 0 );
    }

    /**
     * 
     * Redirection vers un controlleur et une action prédéfinis avec des paramètre
     * 
     * @param   string $url     URL de redirection
     * @param   array $params   Paramètres
     * 
     */
    static public function redirectLocalWithParams( string $controller, string $action, array $params )
    {
        $i = 0;
        $url = './'.$controller.'/'.$action.'?';

        foreach( $params as $param => $key ) {
            
            if ($i > 0)
                $url .= '&';

            $url .= $param.'='.$key;
            $i++;
        }

        header( 'Location: /'. $url );
        exit( 0 );
    }
}
?>
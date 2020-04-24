<?php

namespace lib;

class Database extends mysqli{
 
    private $link = null;

    
    

        public function __construct()
    {
 
        try {
            $this->link = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
            $this->link->set_charset( "utf8" );
        } catch ( Exception $e ) {
            die( 'Es kann keine Verbindung zur Datenbank hergestellt werden.' );
        }
    }
    public function __destruct()
    {
        if( $this->link)
        {
            $this->disconnect();
        }
    }

    

    public function disconnect()
    {
        $this->link->close();
    }
}
    


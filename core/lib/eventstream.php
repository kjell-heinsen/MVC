<?php
namespace core\lib;

  require_once 'event.php';
  
  class EventStream {
    private $events = array();
    
    public static function create() {
      return new self();
    }
    
    private function __construct() {}


      public function send() {
          $m = $this->generate();

          if ( $m === null ) {
              return false;
          }

          if ( headers_sent() ) {
              return false;
          }

          header( 'Content-Type: text/event-stream' );
          header( 'Content-Length: ' . strlen( $m ) );
          echo $m;
          return true;
      }

    public function generate() {
      $message = '';
      

      if ( empty( $this->events ) ) {
        return;
      }

      $nameless = array_filter( $this->events, function ($e ) {
        return ( $e->name === null );
      });
      # collect events with a name
      $named = array_filter( $this->events, function ( $e ) {
        return ( $e->name !== null );
      });

      $events = array_merge( $nameless, $named );
      

      foreach ( $events as $e ) {
        $tmp      = $e->generate();

        $message .= ( $tmp === null ? '' : $tmp . "\n" );
      }
      
      return $message;
    }
    
    public function __toString() {
      $ret = $this->generate();
      return ( $ret === null ? '' : $ret );
    }
    

  }


<?php
namespace core\lib;

  class Event {

    private $name  = null;
    private $id    = null;
    private $data  = '';
    private $retry = null;
    
    public static function create( $name = null ) {
      return new self( $name );
    }
    
    private function __construct(  $name ) {
      $this->name = $name;
    }

      public function generate() {
          $m = '';


          if ( empty( $this->data ) ) {
              return;
          }

          if ( $this->name !== null ) {
              $m .= 'event: ' . $this->name . "\n";
          }

          if ( $this->id !== null ) {
              $m .= 'id: ' . $this->id . "\n";
          }

          if ( $this->retry !== null ) {
              $m .= 'retry: ' . $this->retry . "\n";
          }


          $lines    = explode( "\n", $this->data );
          $m .= 'data: ' . implode( "\n" . 'data: ', $lines ) . "\n";
          return $m;
      }
    
    public function __get( $name ) {
      switch ( $name ) {
        case 'name'  : return $this->name;
        case 'id'    : return $this->id;
        case 'data'  : return $this->data;
        case 'retry' : return $this->retry;
      }
    }
    
    public function __set($name, $v ) {
      switch ( $name ) {
        case 'id':
          if ( is_numeric( $v ) ) {
            $this->id = (int) $v;
          } else {
            $this->id = null;
          }
        break;
        
        case 'data':

          if ( is_scalar( $v ) ) {
            $this->data = (string) $v;

          } elseif ( is_array( $v ) ) {
            $this->data = json_encode( $v );

          } elseif ( is_object( $v ) && method_exists( $v, '__toString' ) ) {
            $this->data = $v->__toString();

            if ( !is_string( $this->data ) ) {
              $this->data = '';
            }

          } else {
            $this->data = '';
          }
        break;
        
        case 'retry':

          if ( is_numeric( $v ) && $v > 0 ) {
            $this->retry = (int) $v;

          } else {
            $this->retry = null;
          }
        break;
      }
    }



    public function __toString() {
      $ret = $this->generate();
      return ( $ret === null ? '' : $ret );
    }
  }


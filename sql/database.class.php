<?php
    
class dataBase {

    var $strServer; //serwer bazy danych
    
    var $strUser; //login
    
    var $strPassword; //haslo
    
    var $strBaseName; //nazwa bazy
    
    var $resConnect; //wskaznik bazy
    
    var $strQuery; //ostatnie zapytanie
    
    var $strError; //ostatni wygenerowany blad
    
    var $resData; //wynik ostatniego zapytania
    
    function dataBase () {
        $this -> strServer = '';
        $this -> strUser = '';
        $this -> strPassword = '';
        $this -> strBaseName = '';
            
        $this -> resConnect = false;
        $this -> strQuery = '';
        $this -> strError = '';
        $this -> resData = false;
    }
    
    
    function connect() {
       if ( $this -> resConnect ) {
          disconnect();
       }
       $this -> resConnect = @mysql_connect ( $this -> strServer, $this -> strUser, $this -> strPassword );
       if ( $this -> resConnect ) {            
          if ( @mysql_select_db ( $this -> strBaseName, $this -> resConnect ) ) {
             return true;
          }
          else {                
             $this -> strError = @mysql_errno ( $this -> resConnect ) . ': ' . @mysql_error ( $this -> resConnect );
             $this -> resConnect = false;
             return false;
          }
                
       }
       else {            
          $this -> strError = @mysql_errno ( $this -> resConnect) . ': ' . @mysql_error ( $this -> resConnect );
          $this -> resConnect = false;
          return false;
       }
       return true;
    }
    
    
    function disconnect() {
       if ( @mysql_close ( $this -> resConnect ) ) {
          return true;
       }
       else
       {
         return false;
       }
    }
    
    function query ( $query ) {
        $this -> strError = '';
        $this -> strQuery = $query;        
        $this -> resData = @mysql_query ( $this -> strQuery, $this -> resConnect );
        if( !$this -> resData ) {
           $this -> strError = @mysql_errno ( $this -> resConnect ) . ': ' . @mysql_error ( $this -> resConnect );
           return false;
        }
        return true;
    }

}

?>
<?php

class zamowienie
{

    var $objDataBase;
   
    function __construct($objDataBase)
    {
        $this->objDataBase = $objDataBase;
        $this->strTable = 'fantazje_zamowienia';
    }
   
    function potwierdzWyslanie($intId)
    {
	    $strUpdateSet = 'wyslane = 1';
	    $strUpdateWhere = 'id = ' . $intId;
	    if ($this->objDataBase->query('UPDATE '.$this->strTable.' SET wyslane = 1 WHERE '.$strUpdateWhere)) {
            return true;
        } else {
            return false;
        }           
    }
   
    function potwierdzPlatnosc($intId)
    {
	    $strUpdateSet = 'zaplacone = 1';
	    $strUpdateWhere = 'id = ' . $intId;
	    if ( $this -> objDataBase -> query ( 'UPDATE ' . $this -> strTable . ' SET ' . $strUpdateSet . ' WHERE ' . $strUpdateWhere ) ) {
           return true;
        } else {
            return false;
        }           
    }   

   function getRegs ( $intId ) {
      $this -> objDataBase -> query ( 'SELECT ' . $this -> strTable . '.* FROM ' . $this -> strTable . ' WHERE ' . $this -> strTable . '.id=' . $intId );
      $resRegs = mysql_fetch_assoc ( $this -> objDataBase -> resData );
      return $resRegs;
   }

   function getRegsList ( $intReg = 0 )
   {
       if ( $intReg == 1 ) {
	       $this -> objDataBase -> query ( "SELECT " . $this -> strTable . ".* FROM " . $this -> strTable . " WHERE zaplacone = 0 ORDER BY date DESC" );
       } elseif (2 == $intReg) {
           $this->objDataBase->query(
               "SELECT ".$this->strTable.".* FROM ".$this->strTable. " WHERE wyslane = 0 ORDER BY date DESC" );
       } else {
           $this -> objDataBase -> query ( "SELECT " . $this -> strTable . ".* FROM " . $this -> strTable . " ORDER BY date DESC" );
       }
      
       $resRegsList = $this->objDataBase->resData;
      
       if ($resRegsList) {
            while ($arrRow = mysql_fetch_assoc($resRegsList)) {
                $arrRegsList['regsList'][] = $arrRow;
            }
         
            return $arrRegsList;
        } else {
        
            return false;
        }
   }

   function addRegs ( $arrData ) {
       $strInsertField = 'id, ';
       $strInsertValue = 'null, ';
       foreach ( $arrData as $mixKey => $mixValue ) {
          $strInsertField .= $mixKey . ', ';
          $strInsertValue .= '"' . $mixValue . '", ';
       }
       $strInsertField = substr( $strInsertField, 0, -2);
       $strInsertValue = substr( $strInsertValue, 0, -2);
//	   echo 'INSERT INTO ' . $this -> strTable . ' (' . $strInsertField . ') VALUES (' . $strInsertValue . ')';
//	   die();
       $this->objDataBase->query('SET NAMES utf8;');
       if ( $this -> objDataBase -> query ( 'INSERT INTO ' . $this -> strTable . ' (' . $strInsertField . ') VALUES (' . $strInsertValue . ')' ) ) {
          $intInsertId = mysql_insert_id( $this -> objDataBase -> resConnect );
          return $intInsertId;
       }
       else {
          return mysql_error($this->objDataBase->resConnect);
       }
   }

   function updateRegs ( $arrSet, $arrWhere ) {
      $strUpdateSet = '';
      foreach ( $arrSet as $mixKey => $mixValue ) {
         $strUpdateSet .= $mixKey . '="' . $mixValue . '", ';
      }
      $strUpdateSet = substr( $strUpdateSet, 0, -2);
      $strUpdateWhere = '';
      foreach ( $arrWhere as $mixKey => $mixValue ) {
         $strUpdateWhere .= $mixKey . '="' . $mixValue . '", ';
      }
      $strUpdateWhere = substr( $strUpdateWhere, 0, -2);
      $this->objDataBase->query('SET NAMES utf8;');
      if ( $this -> objDataBase -> query ( 'UPDATE ' . $this -> strTable . ' SET ' . $strUpdateSet . ' WHERE ' . $strUpdateWhere ) ) {
         return true;
      }
      else {
         return false;
      }        
    }

    function deleteRegs( $intId ) {    
       if ( $this -> objDataBase -> query ( 'DELETE FROM ' . $this -> strTable . ' WHERE id="' . $intId . '"' ) ) {
          return true;
       }
       else {
          return false;
       }
    }
}

?>
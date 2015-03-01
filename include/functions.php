<?php



function getUrlParams() {
   $arrParams = false;
   $strPath = $_SERVER['PATH_INFO'];
   $arrParams = explode( '/', substr( $strPath, 1) );
   return $arrParams;
}

function setVar ( $value, $name ) {
   $_SESSION[$name] = $value;
}

function unSetVar ( $name ) {
	if(isset($_SESSION[$name]))
	{
   		$value = $_SESSION[$name];
   		unset ( $_SESSION[$name] );
	}
	else
	{
		$value = null;
	}
   		
	return $value;
}

function url_change ( $tekst ) {
  while ( $pos = strpos ( $tekst, "[url]" ) ) {
    $pos2 = strpos ( $tekst, "[/url]", $pos );
    $link = substr ( $tekst, $pos+5, $pos2-$pos-5 );
    $tekst = substr_replace ( $tekst, "<a href='$link' target='_new'>$link</a>", $pos, $pos2-$pos+6 );
  }
  while ( $pos = strpos ( $tekst, "[url=" ) ) {
    $end_link = strpos ( $tekst, "]", $pos );
    $pos2 = strpos ( $tekst, "[/url]", $pos );
    $link = substr ( $tekst, $pos+5, $end_link-$pos-5 );
    $tresc = substr ( $tekst, $end_link+1, $pos2-$end_link-1 );
    $tekst = substr_replace ( $tekst, "<a href='$link' target='_new'>$tresc</a>", $pos, $pos2-$pos+6 );
  }
  while ( $pos = strpos ( $tekst, "[uri=" ) ) {
    $end_link = strpos ( $tekst, "]", $pos );
    $pos2 = strpos ( $tekst, "[/url]", $pos );
    $link = substr ( $tekst, $pos+5, $end_link-$pos-5 );
    $tresc = substr ( $tekst, $end_link+1, $pos2-$end_link-1 );
    $tekst = substr_replace ( $tekst, "<a href='$link'>$tresc</a>", $pos, $pos2-$pos+6 );
  }
  return $tekst;
}

function ul_safe ( $tekst ) {
	if ( substr ( $tekst, strlen($tekst)-5, 5 ) == '[/ul]' )
		return true;
	else
		return false;
}

function zamien( $tekst, $html = false ) {
  $tekst = str_replace ( "<", "&lt;", $tekst );
  $tekst = str_replace ( ">", "&gt;", $tekst );
  if ( $html ) {
     return $tekst;
  }
  $tekst = str_replace ( "[s]", "<div style='text-decoration: line-through';>", $tekst );
  $tekst = str_replace ( "[/s]", "</div>", $tekst );
  $tekst = str_replace ( "[b]", "<b>", $tekst );
  $tekst = str_replace ( "[/b]", "</b>", $tekst );
  $tekst = str_replace ( "[small]", "<span style='font-size: 10px'>", $tekst );
  $tekst = str_replace ( "[/small]", "</span>", $tekst );
  $tekst = str_replace ( "[sup]", "<sup>", $tekst );
  $tekst = str_replace ( "[/sup]", "</sup>", $tekst );
  $tekst = str_replace ( "[i]", "<i>", $tekst );
  $tekst = str_replace ( "[/i]", "</i>", $tekst );
  $tekst = str_replace ( "[u]", "<u>", $tekst );
  $tekst = str_replace ( "[/u]", "</u>", $tekst );
  $tekst = str_replace ( "[center]", "<div class='centered'>", $tekst );
  $tekst = str_replace ( "[/center]", "</div>", $tekst );
  $tekst = str_replace ( "[img]", "<img src='", $tekst );
  $tekst = str_replace ( "[/img]", "'>", $tekst );
  $tekst = str_replace ( "[ul]", "<ul style='margin: 0 0 0 0; margin-bottom: 0px; padding-bottom: 0px; list-style-position: inside;'>", $tekst );
  $tekst = str_replace ( "[li]", "<li>", $tekst );
  $tekst = str_replace ( "[/ul]", "</ul>", $tekst );
  $tekst = str_replace ( "[poem]", "<div class='poem'>", $tekst ); 
  $tekst = str_replace ( "[/poem]", "</div>", $tekst );
  $tekst = str_replace ( '"', "&quot;", $tekst );  
  $tekst = nl2br ( $tekst );
  $tekst = url_change ( $tekst );
  return $tekst;
}

?>
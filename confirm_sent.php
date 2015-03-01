<?php
    error_reporting(E_ERROR);
    require_once 'sql/site.config.php';
	require_once 'include/zamowienie.class.php';
	$objRegs = new zamowienie($_objDataBase);
	$objRegs->potwierdzWyslanie($_POST['id']);
	
	if (isset($_GET['ktore'])) {
	    header("Location: zamowienia_list.php?ktore=".$_GET['ktore']);
	} else {
	    header("Location: zamowienia_list.php");
	}
?>
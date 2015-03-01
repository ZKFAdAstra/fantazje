<?php
session_start();

include("include/Mail.php"); 

$params["host"] = "smtp.bachanalia.zgora.pl"; 
$params["port"] = "587"; 
$params["auth"] = true; 
$params["username"] = "bachanalia"; 
$params["password"] = "U<}l+)r$]*,jNj1";


include_once('include/functions.php');
require_once('sql/site.config.php');
require_once ( 'include/zamowienie.class.php' );

		$objRegs = new zamowienie($_objDataBase);
		
		$temat="Nowe zamówienie fantazji";
		$tresc = "Dane zgłoszenia:" . "\n\n";
		$tresc .= "  Imię i nazwisko: " . $_POST['zamowienie']['imie'] . ' ' . $_POST['zamowienie']['nazwisko'] . "\n";
		$tresc .= "  Adres: " . $_POST['zamowienie']['adres'].', '.$_POST['zamowienie']['kod'].' '.$_POST['zamowienie']['miasto']."\n";
		$tresc .= "  telefon: " . (isset($_POST['zamowienie']['telefon']) ? $_POST['zamowienie']['telefon'] : '-') . "\n";
		$tresc .= "  e-mail: " . $_POST['zamowienie']['email'] . "\n";
		$tresc .= "  Fantazje 2: " . $_POST['zamowienie']['fz2'] . "\n";
		$tresc .= "  Fantazje 3: " . $_POST['zamowienie']['fz3'] . "\n\n";
		
		$tresc .= "Uwagi: " . "\n";
		$tresc .= '  ' . $_POST['zamowienie']['uwagi'] . "\n\n";

		$headers['Content-type'] = "text/plain; charset=utf-8";
		$recipients = array("misiotek@go2.pl", "kelior@interia.pl", "zpap-igor@o2.pl"); 

		$headers["From"]    = "BachBot <bachanalia@bachanalia.zgora.pl>"; 
		
		$headers["Subject"] = $temat; 

		// Create the mail object using the Mail::factory method 
		$mail_object =& Mail::factory("smtp", $params); 
		$mail_object->send($recipients, $headers, $tresc); 
		
		setVar(2,'msg');
		
		$arrData = array(
		    'imie'          => $_POST['zamowienie']['imie'],
		    'nazwisko'      => $_POST['zamowienie']['nazwisko'],
		    'adres'         => $_POST['zamowienie']['adres'],
		    'kod'           => $_POST['zamowienie']['kod'],
		    'miasto'        => $_POST['zamowienie']['miasto'],
	        'tel'           => isset($_POST['zamowienie']['telefon']) ? $_POST['zamowienie']['telefon'] : '-',
		    'email'         => $_POST['zamowienie']['email'],
	        'tom2'          => $_POST['zamowienie']['fz2'],
	        'tom3'          => $_POST['zamowienie']['fz3'],
	        'kwota'         => ($_POST['zamowienie']['fz2'] + $_POST['zamowienie']['fz3']) * 12 + 10,
	        'uwagi'         => $_POST['zamowienie']['uwagi'],        
		);
		
		$objRegs->addRegs($arrData);
		
header("Location: index.php");

?>
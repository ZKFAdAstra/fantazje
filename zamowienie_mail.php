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

function countPostage($orderData) {
    $tomes = array(
        2 => $orderData['fz2'],
        4 => $orderData['fz4'],
        5 => $orderData['fz5'],
        6 => $orderData['fz6']
    );

    $sum = 0;

    foreach($tomes as $tome => $tomeQuantity) {
        $sum += $tomeQuantity;
    }

    if ($sum >= 3) {
        return 12;
    }

    if ($sum > 1) {
        return 8.5;
    }

    if ($tomes[2] == 1 || $tomes[3] == 1 || $tomes[6] == 1) {
        return 7.5;
    }

    return 8.5;
}

function error_message($data, $errorMsg) {
    return sprintf(
        "[%s]: Error adding data to database. Data: %sError msg: %s\n",
        date('d-m-Y H:i:s'),
        print_r($data, true),
        $errorMsg
    );
}
	if (!empty($_POST) && 'czwarta' != $_POST['zamowienie']['test']) {
		setVar(10, 'msg');
		setVar($_POST['zamowienie'], 'zamowienie');
		header('Location: zamowienia.php');
		exit;
	}
		$objRegs = new zamowienie($_objDataBase);
		
		$temat="Nowe zamówienie fantazji";
		$tresc = "Dane zgłoszenia:" . "\n\n";
		$tresc .= "  Imię i nazwisko: " . $_POST['zamowienie']['imie'] . ' ' . $_POST['zamowienie']['nazwisko'] . "\n";
		$tresc .= "  Adres: " . $_POST['zamowienie']['adres'].', '.$_POST['zamowienie']['kod'].' '.$_POST['zamowienie']['miasto']."\n";
		$tresc .= "  telefon: " . (isset($_POST['zamowienie']['telefon']) ? $_POST['zamowienie']['telefon'] : '-') . "\n";
		$tresc .= "  e-mail: " . $_POST['zamowienie']['email'] . "\n";
		$tresc .= "  Fantazje 2: " . $_POST['zamowienie']['fz2'] . "\n";
		$tresc .= "  Fantazje 3: " . $_POST['zamowienie']['fz3'] . "\n";
		$tresc .= "  Fantazje 4: " . $_POST['zamowienie']['fz4'] . "\n";
		$tresc .= "  Fantazje 5: " . $_POST['zamowienie']['fz5'] . "\n";
		$tresc .= "  Fantazje 6: " . $_POST['zamowienie']['fz6'] . "\n\n";

		
		$tresc .= "Uwagi: " . "\n";
		$tresc .= '  ' . $_POST['zamowienie']['uwagi'] . "\n\n";

		$headers['Content-type'] = "text/plain; charset=utf-8";
		$recipients = array("kelior@interia.pl", "antykwariat.irijan@gmail.com");

		$headers["From"]    = "BachBot <bachanalia@bachanalia.zgora.pl>"; 
		
		$headers["Subject"] = $temat;
		
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
			'tom4'			=> $_POST['zamowienie']['fz4'],
			'tom5'          => $_POST['zamowienie']['fz5'],
			'tom6'          => $_POST['zamowienie']['fz6'],
	        'kwota'         =>
                ($_POST['zamowienie']['fz2'] + $_POST['zamowienie']['fz3'] + $_POST['zamowienie']['fz4']) * 12
                + $_POST['zamowienie']['fz5'] * 15
                + $_POST['zamowienie']['fz6'] * 15
                + countPostage($_POST['zamowienie']),
	        'uwagi'         => $_POST['zamowienie']['uwagi'],        
		);

		$result = $objRegs->addRegs($arrData);

        if (!is_int($result)) {
            file_put_contents('errors.log', error_message($arrData, $result), FILE_APPEND);
            setVar(11, 'msg');
            header("Location: zamowienia.php");
            exit;
        }

        // Create the mail object using the Mail::factory method
        $mail_object =& Mail::factory("smtp", $params);
        $mail_object->send($recipients, $headers, $tresc);

        setVar(2,'msg');
		
    header("Location: index.php");

?>
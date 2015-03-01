<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo 'Zaloguj się!';
    exit;
}
error_reporting(E_ERROR);
	require_once ( 'sql/site.config.php' );
	require_once ( 'include/zamowienie.class.php' );
	//require_once ( 'include/functions.php' );
	$objZamowienia = new zamowienie($_objDataBase);
	$_objDataBase->query('SET NAMES utf8');
	
	$ktore = 0;
	$param = '';
	if (isset($_GET['ktore'])) {
	    $param = '?ktore='.$_GET['ktore'];
	    if ('nieoplacone' == $_GET['ktore']) {
	        $ktore = 1;
	    } elseif ('niewyslane' == $_GET['ktore']) {
	        $ktore = 2;
	    } 
	}
	
	$arrZamowienia = $objZamowienia->getRegsList($ktore);

?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Zamówienia Fantazje</title>
	<style>

		BODY {
			background: #FFF;
			color: #000;
			font-family: Verdana;
			font-size: 12px;
		}

		DIV {
			border: 1px solid #000;
			padding: 5px 5px 5px 5px;
		}

		DIV.main {
			border: none;
			margin-left: auto;
			margin-right: auto;
			padding: 0;
			width: 1008px;
		}
		
		a, a:visited {
		    color: #676767;
		    text-decoration: none;
		    font-weight: bold;
	    }
		    
	    a:hover {
	       color: #9A9A9A; 
	    }
		TEXTAREA {
			border: 1px solid #000;
			background: #FFF;
		}
		
		INPUT {
			border: 1px solid #000;
			background: #FFF;
		}
		
		.wpis {
		    float: left; 
		    width: 700px
		}
		
		.dane {
		    display: none; 
		    margin-bottom: 13px;
		}
		
		.przycisk {
		    float: left; 
		    width: 50px; 
		    margin-left: 10px; 
		    text-align: center; 
		    cursor: pointer;
		}
		
		.info {
		    float: left; 
		    width: 70px; 
		    margin-left: 10px; 
		    text-align: center
		}

		.sep {
		    clear: both; 
		    font-size: 0px; 
		    height: 3px; 
		    border: none;
		}
		
		.main {
		    }
		    
	    .ten {
		    text-decoration: underline;    
	    }
	</style>
	<script type="text/javascript" language="javascript">
		function openData(id) {
			if ( document.getElementById( 'data' + id ).style.display == 'block' )
				document.getElementById( 'data' + id ).style.display = 'none';
			else
				document.getElementById( 'data' + id ).style.display = 'block';
			return 0;
		}

		function openMail(id) {
			if ( document.getElementById( 'mail' + id ).style.display == 'block' )
				document.getElementById( 'mail' + id ).style.display = 'none';
			else
				document.getElementById( 'mail' + id ).style.display = 'block';
			return 0;
		}
	</script>
</head>

<body>
    <div class="main">
        <div class="wpis">
            <strong><em>Zamówienie</em></strong>
            <div style="float: right; margin-right: 5px; border: none; padding: 0px;">
                <a href="/fantazje/zamowienia_list.php" class="<?php echo 0 === $ktore ? 'ten' : ''?>">Wszystkie</a>
                <a href="?ktore=nieoplacone" class="<?php echo 1 === $ktore ? 'ten' : ''?>">Nieopłacone</a>
                <a href="?ktore=niewyslane" class="<?php echo 2 === $ktore ? 'ten' : ''?>">Niewysłane</a>
            </div>
        </div>
        <div class="przycisk" style="border: none;"></div>
        <div class="info">Zapłacone</div>
        <div class="info">Wysyłka</div>
        <div class="sep"></div>
    </div>
<?php
	$ileLudu = count($arrZamowienia['regsList']);
	foreach ($arrZamowienia['regsList'] as $aK => $aV) {
		if ($aV['zaplacone']) {
			$zaplacone = 'Tak';
		} else {
			$zaplacone = '<strong>Nie</strong>';
		}
		if ($aV['wyslane']) {
			$wyslane = 'Wysłane';
		} else {
			$wyslane = '<strong>Oczekuje</strong>';
		}
		$strData = '';

		$strData .= 'Imię i nazwisko: <strong>' . $aV['imie'] . ' ' . $aV['nazwisko'] . '</strong><br />';
		$strData .= sprintf(
	        'Adres: <strong>%s, %s %s</strong><br />',
		    $aV['adres'],
		    $aV['kod'],
		    $aV['miasto']    
        );
		$strData .= 'Telefon: <strong>' . $aV['tel'] . '</strong><br />';
		$strData .= 'E-mail: <strong>' . $aV['email'] . '</strong><br />';
		
		$strData .= sprintf(
            'Fantazje tom 2: %s egz.<br/>',
		    $aV['tom2']
        );
		
		$strData .= sprintf(
		        'Fantazje tom 3: %s egz.<br/>',
		        $aV['tom3']
		);
		
		$strData .= sprintf(
		        'Do zapłaty: %s zł<br/>',
		        $aV['kwota']
		);
		$strData .= sprintf(
		        'Zamówienie złożone: %s<br/>',
		        $aV['date']
		);
		
		$strData .= 'Uwagi: <strong>' . $aV['uwagi'] . '</strong>';
		$strData .= '';
		
		
		/* $strMail = '';
		$strMail .= 'Witam!' . "\n\n";
		$strMail .= 'Otrzymaliśmy Twoją bachanaliową rezerwację na nazwisko: ';
		$strMail .= $aV['first_name'] . ' ' . $aV['last_name'];
		$strMail .= '.' . "\n". 'Zgodnie z regulaminem' . "\n";
		$strMail .= 'konwentu rezerwacja uprawomocnia się,' . "\n";
		$strMail .= 'gdy nastąpi wpłata na konto. Oto jego dane:' . "\n\n";
		$strMail .= 'ZKF Ad Astra' . "\n";
		$strMail .= '34 1020 5402 0000 0202 0113 8809' . "\n";
		$strMail .= 'ul. Fabryczna 13b' . "\n";
		$strMail .= '65-001 Zielona Góra' . "\n\n";
		$strMail .= 'PKO II Odział w Zielonej Górze' . "\n";
		$strMail .= 'Dane Twojej rezerwacji:' . "\n\n";
		$acr_for_days = '';
		if ( $aV['acredit_type'] == 4 ) {
			$acr_for_days = ' (' . $acr_days . ') ';
		}
		$strMail .= 'Akredytacja: ' . $acr_type . $acr_for_days . ' - ' . $acr_pay . ' zł' . "\n";
		if ( $accomod_pay != 0 ) {
			$strMail .= 'Noclegi: ' . $accomod_type . ' (' . $accomod_nights . ') - ' . $accomod_pay . ' zł' . "\n";
		}
		$tshirts_pay = 0;
		if ( $aV['date_reg'] < 1212278400 ) {
			if ( $aV['tshirts_number'] != 0 ) {
				$tshirts_pay = $aV['tshirts_number'] * 25;
				$strMail .= 'Koszulki: ' . $aV['tshirts_number'] . ' x 25 zł = ' . $tshirts_pay . ' zł' . "\n";
			}
		} else {
			if ( $aV['tshirts_number'] != 0 ) {
				$tshirts_pay = $aV['tshirts_number'] * 25;
				$strMail .= 'Koszulki: ' . $aV['tshirts_number'] . ' x 25 zł = ' . $tshirts_pay . ' zł' . "\n";
			}
		}
		$all_pay = $acr_pay + $accomod_pay + $tshirts_pay;
		$strMail .= 'Ogółem do zapłaty: ' . $all_pay . ' zł' . "\n\n";
		$strMail .= 'Jeśli dane są niezgodne z tymi, które podano podczas rejestracji, prosimy o kontakt.' . "\n\n";
		$strMail .= 'Z pozdrowieniami, Ania Łakoma' . "\n\n";
		$strMail .= '-- ' . "\n";
		$strMail .= 'Bachanalia Fantastyczne 2013 - http://www.bachanalia.zgora.pl' . "\n";
		$strMail .= 'Fąfastyka - http://adastra.zgora.pl' . "\n";
		$strMail .= 'Anarion - http://adastra.zgora.pl/index.php/4'; */
		
		?>
    <div class="main">
        <div class="wpis">
            <strong><?php echo $ileLudu?></strong> - <?php echo $aV['id']; ?> - <?php echo $aV['imie']; ?> - <?php echo $aV['nazwisko']; ?>
        </div>
        <div class="przycisk" onClick="openData('<?php echo $aV['id']; ?>')">Dane</div>
        <?php //<div style="float: left; width: 50px; margin-left: 10px; text-align: center; cursor: pointer;" onClick="openMail(' . $aV['id_bf13_registration'] . ')">Mail</div ?>
        <div class="info"><?php echo $zaplacone; ?></div>
        <div class="info"><?php echo $wyslane; ?></div>
        <div class="sep"></div>
    </div>
	<div class="main">
	    <div class="dane" id="data<?php echo $aV['id']; ?>">
	        <?php echo $strData; ?>
	        <br />
            <?php if (!$aV['zaplacone']): ?>
                <div style="float: left; border: none;">
        	        <form name="wplata<?php echo $aV['id'] ?>" method="post" action="confirm_pay.php<?php echo $param;?>">
        	            <input type="hidden" name="id" value="<?php echo $aV['id']; ?>" />
        	            <input type="Submit" value="Potwierdź płatność" style="margin-top: 5px; cursor:pointer;"/>
                    </form>
                </div>
            <?php endif; ?>
            <?php if (!$aV['wyslane']): ?>
                <div style="float: left; border: none;">
        	        <form name="wplata<?php echo $aV['id'] ?>" method="post" action="confirm_sent.php<?php echo $param; ?>">
        	            <input type="hidden" name="id" value="<?php echo $aV['id']; ?>" />
        	            <input type="Submit" value="Potwierdź wysyłkę" style="margin-top: 5px; cursor:pointer;"/>
                    </form>
                </div>
            <?php endif; ?>
            <div style="border: none; clear: both"></div>
	    </div>
    </div>
	<?php //	echo '<div class="main"><div style="display: none; margin-bottom: 13px;" id="mail' . $aV['id_bf13_registration'] . '"><form name="mail' . $aV['id_bf13_registration'] . '" method="post" action="send_reg.php"><div style="margin: 0; padding: 0; border: 0; float: left;"><textarea style="width: 600px; height: 150px;" name="strMail">' . $strMail . '</textarea></div><div style="padding: 130px 0 0 0; float: left; margin-left: 10px; border: 0;"><input type="submit" value="Wyślij" /></div><input type="hidden" name="mail" value="' . $aV['email'] . '"><input type="hidden" name="id_regs" value="' . $aV['id_bf13_registration'] . '"></form><div style="border: 0px; clear: both; font-size: 0px; padding: 0; height: 0px;"></div></div></div>' . "\n"; */ ?>
<?php 
    $ileLudu--;		
	}
?>
</body>

</html>
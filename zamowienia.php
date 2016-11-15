<?php
    session_start();
	$gdzie = 'zamowienia';
	include_once('include/functions.php');
    $msg = unSetVar('msg');
	$zamowienie = unSetVar('zamowienie');
?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="StyleSheet" href="style.css?ver=1.3" type="text/css" />
	<link rel="StyleSheet" href="js/colorbox.css" type="text/css" />
	<title>Fantazje Zielonogórskie</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js" ></script>
	<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox-pl.js"></script>
	<script type="text/javascript">
        function checkAll( name ) {
    		if ( checkRequired() && checkEmail() ) {
    			document.getElementById( name ).submit();
    		}
    	}


    	function checkRequired() {
    		if ($('#fImie').value == '' ||
    	        $('#fNazwisko').value == '' ||
    		    $('#fAdres').value == '' ||
    		    $('#fKod').value == '' ||
    		    $('#fMiasto').value == '' ||
    		    ($('#fFZ2').val() == '' && $('#fFZ3').val() == '' && $('#fFZ4').val() == '' && $('#fFZ5').val() == '' && $('#fFZ6').val() == '')) {
    			alert('Nie wypełniono wszystkich pól wymaganych.');
    			return false;
    		} else {
    			return true;
    		}
    	}

        function  checkEmail() {
    		var re = /[_.a-z0-9-]+@[_.a-z0-9-]+\.[a-z]{2,5}/i
    		var str = document.getElementById('fEmail').value;
    		if (str.search(re) == -1) {
    			alert('Podany e-mail nie ma prawidłowego formatu.');
    			return false;
    		} else {
    			return true;
    		}
    	}

		function countPostage(tom2, tom3, tom6, sumaIlosci) {

			if (sumaIlosci >= 3) {
				return 12;
			}

			if (sumaIlosci > 1) {
				return 8.5;
			}

			if (tom2 == 1 || tom3 == 1 || tom6 == 1) {
				return 7.5;
			}

			return 8.5;
		}
	
        $(document).ready(function() {
     	
        	$('#cookie_accept').click(function(e) {
        		e.preventDefault();
        		$(this).parent().parent().slideUp('slow');
        		document.cookie = 'cookies_accepted=true;expires=Thu, 31 Dec 2099 12:34:23 GMT';
        	});

        	$('#fFZ2, #fFZ3, #fFZ4, #fFZ5, #fFZ6').change(function() {
        	    ile2 = Number($('#fFZ2').val());
        	    ile3 = Number($('#fFZ3').val());  
				ile4 = Number($('#fFZ4').val());
				ile5 = Number($('#fFZ5').val());
				ile6 = Number($('#fFZ6').val());

        	    suma_ilosci = ile2 + ile3 + ile4 + ile5 + ile6;

        	    wysylka = countPostage(ile2, ile3, ile6, suma_ilosci);
        	    
        	    $('#ile2').text(ile2);
        	    $('#ile3').text(ile3);
				$('#ile4').text(ile4);
				$('#ile5').text(ile5);
				$('#ile6').text(ile6);
        	    $('#wart2').text(12 * ile2);
        	    $('#wart3').text(12 * ile3);
				$('#wart4').text(12 * ile4);
				$('#wart5').text(15 * ile5);
				$('#wart6').text(15 * ile6);
        	    $('#wysylka').text(wysylka);

        	    suma = 12 * ile2 + 12 * ile3 + 12 * ile4 + 15 * ile5 + 15 * ile6 +  wysylka;

        	    $('#suma').text(suma);

        	});
        	
			$('#fFZ2').change();
        });
    </script>
    <style>
        label, input {
        	display: block;
        	float: left;
        	margin-right: 10px;
        	margin-bottom: 10px;
        }
        
        label {
        	width: 160px;
        	text-align: right;
        	margin-right: 10px;
        }
        
        
        .cf, .clear {
        	clear: both;
        }
        
        #wyslij, #wyczysc {
        	background-color: #2a83a0;
        	padding: 7px 13px 4px 13px;
        	font-size: 16px;
        	color: #eeeeee;
        	border: 0px;
        	border-radius: 3px;
        	margin-top: 20px;
        	cursor: pointer;
        	margin-right: 15px;
        }
        
        td {
            padding: 5px;
            border: 1px solid #dedede;
        }
    </style>
</head>
<body>
<?php if (empty($_COOKIE['cookies_accepted'])): ?>
    <div id="cookies">
        <div id="cookies_txt">
            Informujemy, że nasza strona aby poprawnie działać korzysta z mechanizmu "cookies".
            Nie wykorzystujemy plików "cookies" dla celów reklamowych.<br/>  
            Korzystając ze strony wyrażasz zgodę na używanie plików "cookies", zgodnie z aktualnymi ustawieniami przeglądarki.
            <a href="" id="cookie_accept">Zamknij</a>
        </div>
    </div>
<?php endif; ?>
	<div id="container">
		<div id="main">
			<div id="bantop">
				<div id="adalogo"><a href="http://adastra.zgora.pl/" target="_blank"><img src="img/adastra.png" title="ZKF Ad Astra" alt="ZKF Ad Astra" /></a></div>
				<?php //<div id="bachlogo"><a href="http://bachanalia.zgora.pl/" target="_blank"><img src="img/bacha_button.jpg" title="Bachanalia Fantastyczne 2012" alt="Bachanalia Fantastyczne 2012" /></a></div>?>
				<a href="http://fantazje.adastra.zgora.pl"><img src="img/bantop.png" alt="Fantazje Zielonogórskie" title="Fantazje Zielonogórskie" /></a>
			</div>
			<div id="fantatop"></div>
			<div id="konkurstop"></div>
			<div id="menu">
			    <?php include 'menu.php'; ?>
			</div>
			<div class="clear"></div>
			<?php if (10 == $msg): ?>
                <div id="message">
                    Wystąpił problem z zamówieniem. Prosimy dokładnie przeczytać opis przy ostatnim polu zamówienia 
					i spróbować jeszcze raz.
                </div>
            <?php endif; ?>
			<div id="column_left">
			    <div id="textcontainer">
					<p style="margin-top: 15px">
						Egzemplarze Fantazji Zielonogórskich mogą państwo nabyć składając zamówienie poprzez
						formularz zamówień dostępny poniżej. Cena jednej książki to <strong>15 złotych</strong> (tomy 5 i6)
						lub <strong>12 złotych</strong> (tomy 2, 3 i 4).
					</p>
					<p style="margin-top: 15px">
						W Zielonej Górze antologię można kupić w następujących miejscach:
					</p>
					<ul>
						<li style="margin-bottom: 15px">
							Zielone Wzgórza Księgarnia i Centrum Gier
							<br/>ul. Boh. Westerplatte 16
							<br/>Zielona Góra
							<br/><a href="http://www.zielone24.pl" target="_new">www.zielone24.pl</a>
						</li>
						<li style="margin-bottom: 15px">
							Antykwariat Saski
							<br/>ul. Jedności 48
							<br/>Zielona Góra
						</li>
						<li>
							Polsko-Niemieckie Centrum Promocji i Informacji Turystycznej
							<br/>ul. Stary Rynek 1 (Ratusz)
							<br/>Zielona Góra
							<br/><a href="http://www.cit.zielona-gora.pl" target="_new">www.cit.zielona-gora.pl</a>
						</li>
					</ul>
                <p>
    			    Poniższy formularz umożliwia zamówienie antologii opowiadań 
    			    "Fantazje Zielonogórskie", tomy 2, 4, 5 i 6. Prosimy o wypełnienie poniższych
    			    pól a następnie przesłanie wyświetlonej na dole strony kwoty na konto:
    			    <br/><br/>
    			    ZKF Ad Astra<br/>
                    ul. Fabryczna 13b<br/>
                    65-001 Zielona Góra<br/>
                    <br/><br/>
                    <strong>34 1020 5402 0000 0202 0113 8809</strong>
                    <br/><br/>
                    podając w tytule przelewu: imię i nazwisko oraz dopisek
                    "zamówienie fantazji".
                    <br/><br/>
					<span style="text-decoration: underline; font-weight: bold">
						UWAGA! Nieprawidłowe wypełnienie poniższego formularza lub wysłanie przelewu bez wypełnienia
						formularza może utrudnić wykonanie zamówienia. Dla pewności mogą państwo podać w tytule przelewu
						telefon kontaktowy.
					</span>
					<br/><br/>
                    Książki zostaną do Państwa wysłane w ciągu trzech dni od otrzymania
                    przelewu.
			    </p>
				<form action="zamowienie_mail.php" method="post" name="zamowienie" id="zamowienie" >
				    <div class="first">
			            <label for="fImie">Imię</label>
				        <input id="fImie" name="zamowienie[imie]" type="text" value="<?php echo isset($zamowienie['imie']) ? $zamowienie['imie'] : ''; ?>" />
					</div>
					<div class="next cf">
			            <label for="fNazwisko">Nazwisko</label>
				        <input id="fNazwisko" name="zamowienie[nazwisko]" type="text" value="<?php echo isset($zamowienie['nazwisko']) ? $zamowienie['nazwisko'] : ''; ?>" />
				    </div>
					<div class="next cf">
						<label for="fAdres">Ulica</label>
						<input id="fAdres" name="zamowienie[adres]" type="text" value="<?php echo isset($zamowienie['adres']) ? $zamowienie['adres'] : ''; ?>" />
					</div>
					<div class="next cf">
						<label for="fKod">Kod pocztowy</label>
						<input id="fKod" name="zamowienie[kod]" type="text" value="<?php echo isset($zamowienie['kod']) ? $zamowienie['kod'] : ''; ?>" />
					</div>
					<div class="next cf">
						<label for="fMiasto">Miejscowość</label>
						<input id="fMiasto" name="zamowienie[miasto]" type="text" value="<?php echo isset($zamowienie['miasto']) ? $zamowienie['miasto'] : ''; ?>" />
					</div>
					<div class="next cf">
					    <label for="fEmail">E-mail</label>
						<input id="fEmail" name="zamowienie[email]" type="text" value="<?php echo isset($zamowienie['email']) ? $zamowienie['email'] : ''; ?>" />
					</div>
					<div class="next cf">
					    <label for="fTelefon">Telefon kontaktowy</label>
				        <input id="fTelefon" name="zamowienie[telefon]" type="text" value="<?php echo isset($zamowienie['telefon']) ? $zamowienie['telefon'] : ''; ?>" />
				        (opcjonalnie)
					</div>
					<div class="next cf">
						<label for="fFZ6">Zamawiana liczba tomu 6</label>
						<select id="fFZ6" name="zamowienie[fz6]">
							<option value="0" <?php echo !isset($zamowienie['fz6']) ? 'selected="selected"' : ''; ?> >0</option>
							<option value="1" <?php echo isset($zamowienie['fz6']) && 1 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >1</option>
							<option value="2" <?php echo isset($zamowienie['fz6']) && 2 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >2</option>
							<option value="3" <?php echo isset($zamowienie['fz6']) && 3 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >3</option>
							<option value="4" <?php echo isset($zamowienie['fz6']) && 4 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >4</option>
							<option value="5" <?php echo isset($zamowienie['fz6']) && 5 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >5</option>
							<option value="6" <?php echo isset($zamowienie['fz6']) && 6 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >6</option>
							<option value="7" <?php echo isset($zamowienie['fz6']) && 7 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >7</option>
							<option value="8" <?php echo isset($zamowienie['fz6']) && 8 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >8</option>
							<option value="9" <?php echo isset($zamowienie['fz6']) && 9 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >9</option>
							<option value="10" <?php echo isset($zamowienie['fz6']) && 10 == $zamowienie['fz6'] ? 'selected="selected"' : ''; ?> >10</option>
						</select>
					</div>
					<div class="next cf">
						<label for="fFZ5">Zamawiana liczba tomu 5</label>
						<select id="fFZ5" name="zamowienie[fz5]">
						    <option value="0" <?php echo !isset($zamowienie['fz5']) ? 'selected="selected"' : ''; ?> >0</option>
						    <option value="1" <?php echo isset($zamowienie['fz5']) && 1 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >1</option>
						    <option value="2" <?php echo isset($zamowienie['fz5']) && 2 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >2</option>
						    <option value="3" <?php echo isset($zamowienie['fz5']) && 3 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >3</option>
						    <option value="4" <?php echo isset($zamowienie['fz5']) && 4 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >4</option>
						    <option value="5" <?php echo isset($zamowienie['fz5']) && 5 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >5</option>
						    <option value="6" <?php echo isset($zamowienie['fz5']) && 6 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >6</option>
						    <option value="7" <?php echo isset($zamowienie['fz5']) && 7 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >7</option>
						    <option value="8" <?php echo isset($zamowienie['fz5']) && 8 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >8</option>
						    <option value="9" <?php echo isset($zamowienie['fz5']) && 9 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >9</option>
						    <option value="10" <?php echo isset($zamowienie['fz5']) && 10 == $zamowienie['fz5'] ? 'selected="selected"' : ''; ?> >10</option>
						</select>
					</div>
					<div class="next cf">
						<label for="fFZ4">Zamawiana liczba tomu 4</label>
						<select id="fFZ4" name="zamowienie[fz4]">
						    <option value="0" <?php echo !isset($zamowienie['fz4']) ? 'selected="selected"' : ''; ?> >0</option>
						    <option value="1" <?php echo isset($zamowienie['fz4']) && 1 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >1</option>
						    <option value="2" <?php echo isset($zamowienie['fz4']) && 2 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >2</option>
						    <option value="3" <?php echo isset($zamowienie['fz4']) && 3 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >3</option>
						    <option value="4" <?php echo isset($zamowienie['fz4']) && 4 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >4</option>
						    <option value="5" <?php echo isset($zamowienie['fz4']) && 5 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >5</option>
						    <option value="6" <?php echo isset($zamowienie['fz4']) && 6 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >6</option>
						    <option value="7" <?php echo isset($zamowienie['fz4']) && 7 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >7</option>
						    <option value="8" <?php echo isset($zamowienie['fz4']) && 8 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >8</option>
						    <option value="9" <?php echo isset($zamowienie['fz4']) && 9 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >9</option>
						    <option value="10" <?php echo isset($zamowienie['fz4']) && 10 == $zamowienie['fz4'] ? 'selected="selected"' : ''; ?> >10</option>
						</select>
					</div>
					<div class="next cf">
						<label for="fFZ3">Zamawiana liczba tomu 3</label>
						<em>wyprzedany</em>
						<?php /* <select id="fFZ3" name="zamowienie[fz3]">
						    <option value="0" <?php echo !isset($zamowienie['fz3']) ? 'selected="selected"' : ''; ?> >0</option>
						    <option value="1" <?php echo isset($zamowienie['fz3']) && 1 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >1</option>
						    <option value="2" <?php echo isset($zamowienie['fz3']) && 2 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >2</option>
						    <option value="3" <?php echo isset($zamowienie['fz3']) && 3 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >3</option>
						    <option value="4" <?php echo isset($zamowienie['fz3']) && 4 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >4</option>
						    <option value="5" <?php echo isset($zamowienie['fz3']) && 5 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >5</option>
						    <option value="6" <?php echo isset($zamowienie['fz3']) && 6 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >6</option>
						    <option value="7" <?php echo isset($zamowienie['fz3']) && 7 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >7</option>
						    <option value="8" <?php echo isset($zamowienie['fz3']) && 8 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >8</option>
						    <option value="9" <?php echo isset($zamowienie['fz3']) && 9 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >9</option>
						    <option value="10" <?php echo isset($zamowienie['fz3']) && 10 == $zamowienie['fz3'] ? 'selected="selected"' : ''; ?> >10</option>
						</select> */ ?>
						<input type="hidden" name="zamowienie[fz3]" id="fFZ3" value="0" />
					</div>
					<div class="next cf">
						<label for="fFZ2">Zamawiana liczba tomu 2</label>
						<select id="fFZ2" name="zamowienie[fz2]">
						    <option value="0" <?php echo !isset($zamowienie['fz2']) ? 'selected="selected"' : ''; ?>>0</option>
						    <option value="1" <?php echo isset($zamowienie['fz2']) && 1 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >1</option>
						    <option value="2" <?php echo isset($zamowienie['fz2']) && 2 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >2</option>
						    <option value="3" <?php echo isset($zamowienie['fz2']) && 3 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >3</option>
						    <option value="4" <?php echo isset($zamowienie['fz2']) && 4 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >4</option>
						    <option value="5" <?php echo isset($zamowienie['fz2']) && 5 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >5</option>
						    <option value="6" <?php echo isset($zamowienie['fz2']) && 6 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >6</option>
						    <option value="7" <?php echo isset($zamowienie['fz2']) && 7 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >7</option>
						    <option value="8" <?php echo isset($zamowienie['fz2']) && 8 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >8</option>
						    <option value="9" <?php echo isset($zamowienie['fz2']) && 9 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >9</option>
						    <option value="10" <?php echo isset($zamowienie['fz2']) && 10 == $zamowienie['fz2'] ? 'selected="selected"' : ''; ?> >10</option>
						</select>
					</div>
					<div class="next cf" style="margin-top: 15px;">
						<label for="fUwagi"><strong>Uwagi</strong></label>
				        <textarea style="width: 300px; height: 80px;" id="fUwagi" name="zamowienie[uwagi]"><?php echo isset($zamowienie['uwagi']) ? $zamowienie['uwagi'] : ''; ?></textarea>
					</div>
					
					<div class="next cf" >
						<p>Chwilowo obsługujemy zamówienia tylko od ludzi (te zmawiane przez boty nas nie interesują). 
						Żeby potwierdzić, że nie jesteś maszyną wpisz proszę w poniższe pole słownie która edycja 
						naszego tomiku jest najnowsza (dla ułatwienia dodam, że czwarta, i to słowo trzeba wpisać)
						</p>
						<label for="fTest" style="width: 200px">Podaj ostatnią edycję tomiku:</label>
				        <input type="text" style="width: 200px;" id="fTest" name="zamowienie[test]" />
					</div>
					<div style="text-align: center; width: 100%; margin-top: 40px;">
						<input type="button" value="Wyślij" id="wyslij" onClick="checkAll('zamowienie')" />
					</div>
				</form>
				<h2 class="clear">Podsumowanie zamówienia</h2>
				<table>
				    <tr>
				        <th></th>
				        <th>Tom 2</th>
				        <th>Tom 3</th>
						<th>Tom 4</th>
						<th>Tom 5</th>
						<th>Tom 6</th>
				        <th>Przesyłka</th>
				    </tr>
				    <tr>
				        <td>szt.</td>
				        <td id="ile2">0</td>
				        <td id="ile3">0</td>
						<td id="ile4">0</td>
						<td id="ile5">0</td>
						<td id="ile6">0</td>
				        <td>-</td>
				    </tr>
				    <tr>
				        <td>cena</td>
				        <td>12 zł</td>
				        <td>12 zł</td>
						<td>12 zł</td>
						<td>15 zł</td>
						<td>15 zł</td>
				        <td>-</td>
				    </tr>
				    <tr>
				        <td>wartość</td>
				        <td><span id="wart2">0</span> zł</td>
				        <td><span id="wart3">0</span> zł</td>
						<td><span id="wart4">0</span> zł</td>
						<td><span id="wart5">0</span> zł</td>
						<td><span id="wart6">0</span> zł</td>
				        <td><span id="wysylka">0</span> zł</td>
				    </tr>
				</table>
			    <p>Suma: <span id="suma">0</span> zł</p>
    			</div>
			</div>
			<div id="column_right">
			    <?php include 'loga.php' ?>
			</div>
		</div>
	</div>
</body>

</html>

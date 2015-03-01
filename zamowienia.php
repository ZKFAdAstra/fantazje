<?php
    $gdzie = 'zamowienia';    
?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="StyleSheet" href="style.css?ver=1.1" type="text/css" />
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
    		    ($('#fFZ2').val() == '' && $('#fFZ3').val() == '')) {
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
	
        $(document).ready(function() {
     	
        	$('#cookie_accept').click(function(e) {
        		e.preventDefault();
        		$(this).parent().parent().slideUp('slow');
        		document.cookie = 'cookies_accepted=true;expires=Thu, 31 Dec 2099 12:34:23 GMT';
        	});

        	$('#fFZ2, #fFZ3').change(function() {
        	    ile2 = Number($('#fFZ2').val());
        	    ile3 = Number($('#fFZ3').val());        	    

        	    suma_ilosci = ile2 + ile3;

        	    wysylka = 0;
        	    if (suma_ilosci == 1) {
            	    wysylka = 7;
        	    } else if (suma_ilosci == 2) {
            	    wysylka = 10;
        	    } else {
            	    wysylka = 10 + (Math.ceil(suma_ilosci / 2)*2 - 2);
        	    }
        	    
        	    $('#ile2').text(ile2);
        	    $('#ile3').text(ile3);
        	    $('#wart2').text(12 * ile2);
        	    $('#wart3').text(12 * ile3);
        	    $('#wysylka').text(wysylka);

        	    suma = 12 * ile2 + 12 * ile3 + wysylka;

        	    $('#suma').text(suma);

        	});
        	
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
			<div id="column_left">
			    <div id="textcontainer">
                <p>
    			    Poniższy formularz umożliwia zamówienie antologii opowiadań 
    			    "Fantazje Zielonogórskie", tom 2 i 3. Prosimy o wypełnienie poniższych
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
                    Książki zostaną do Państwa wysłane w ciągu trzech dni od otrzymania
                    przelewu.
			    </p>
				<form action="zamowienie_mail.php" method="post" name="zamowienie" id="zamowienie" >
				    <div class="first">
			            <label for="fImie">Imię</label>
				        <input id="fImie" name="zamowienie[imie]" type="text" />
					</div>
					<div class="next cf">
			            <label for="fNazwisko">Nazwisko</label>
				        <input id="fNazwisko" name="zamowienie[nazwisko]" type="text" />
				    </div>
					<div class="next cf">
						<label for="fAdres">Ulica</label>
						<input id="fAdres" name="zamowienie[adres]" type="text" />
					</div>
					<div class="next cf">
						<label for="fKod">Kod pocztowy</label>
						<input id="fKod" name="zamowienie[kod]" type="text" />
					</div>
					<div class="next cf">
						<label for="fMiasto">Miejscowość</label>
						<input id="fMiasto" name="zamowienie[miasto]" type="text" />
					</div>
					<div class="next cf">
					    <label for="fEmail">E-mail</label>
						<input id="fEmail" name="zamowienie[email]" type="text" />
					</div>
					<div class="next cf">
					    <label for="fTelefon">Telefon kontaktowy</label>
				        <input id="fTelefon" name="zamowienie[telefon]" type="text" />
				        (opcjonalnie)
					</div>
					<div class="next cf">
						<label for="fFZ3">Zamawiana liczba tomu 3</label>
						<select id="fFZ3" name="zamowienie[fz3]">
						    <option value="0">0</option>
						    <option value="1">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
						    <option value="6">6</option>
						    <option value="7">7</option>
						    <option value="8">8</option>
						    <option value="9">9</option>
						    <option value="10">10</option>
						</select>
					</div>
					<div class="next cf">
						<label for="fFZ2">Zamawiana liczba tomu 2</label>
						<select id="fFZ2" name="zamowienie[fz2]">
						    <option value="0">0</option>
						    <option value="1">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
						    <option value="6">6</option>
						    <option value="7">7</option>
						    <option value="8">8</option>
						    <option value="9">9</option>
						    <option value="10">10</option>
						</select>
					</div>
					<div class="next cf" style="margin-top: 15px;">
						<label for="fUwagi"><strong>Uwagi</strong></label>
				        <textarea style="width: 300px; height: 80px;" id="fUwagi" name="zamowienie[uwagi]"></textarea>
					</div>
					<div style="text-align: center; width: 100%">
						<input type="button" value="Wyślij" id="wyslij" onClick="checkAll('zamowienie')" />
					</div>
				</form>
				<h2 class="clear">Podsumowanie zamówienia</h2>
				<table>
				    <tr>
				        <th></th>
				        <th>Tom 2</th>
				        <th>Tom 3</th>
				        <th>Przesyłka</th>
				    </tr>
				    <tr>
				        <td>szt.</td>
				        <td id="ile2">0</td>
				        <td id="ile3">0</td>
				        <td>-</td>
				    </tr>
				    <tr>
				        <td>cena</td>
				        <td>12 zł</td>
				        <td>12 zł</td>
				        <td>-</td>
				    </tr>
				    <tr>
				        <td>wartość</td>
				        <td><span id="wart2">0</span> zł</td>
				        <td><span id="wart3">0</span> zł</td>
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

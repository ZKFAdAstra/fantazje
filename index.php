<?php 
    session_start();
    $gdzie = isset($_GET['gdzie']) ? $_GET['gdzie'] : 'wstep';
    include_once('include/functions.php');
    $msg = unSetVar('msg');
?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="StyleSheet" href="style.css?ver=1.6" type="text/css" />
	<link rel="StyleSheet" href="js/colorbox.css" type="text/css" />
	<title>Fantazje Zielonogórskie</title>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js" ></script>
	<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="js/jquery.colorbox-pl.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
     	
        	$('#cookie_accept').click(function(e) {
        		e.preventDefault();
        		$(this).parent().parent().slideUp('slow');
        		document.cookie = 'cookies_accepted=true;expires=Thu, 31 Dec 2099 12:34:23 GMT';
        	});
        });
    </script>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.5";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

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
            <?php if (2 == $msg): ?>
                <div id="message">
                    Zamówienie zostało złożone.
                </div>
            <?php endif; ?>
			<div id="column_left">
			    <div id="textcontainer">
					<?php /*<div id="info">
						<strong>Szanowni piszący</strong> Wobec licznych próśb od zainteresowanych <strong>przedłużamy termin</strong> nadsyłania prac na konkurs o dwa tygodnie. 
						Macie zatem czas do <strong>14 czerwca</strong>.
					</div>*/ ?>
    				<?php 
    				    switch ($gdzie) { 
    				        case 'wstep': include 'wstep.php';
    				            break;
							case 'wyniki': include 'wyniki.php';
								break;
    				        case 'regulamin': include 'regulamin.php';
    				            break;
    				        case 'edycje': include 'pop.php';
    				            break;
    				        case 'kupno': include 'kupno.php';
    				            break;
    				        case 'galeria': include 'galeria.php';
    				            break;
    				        case 'media': include 'media.php';
    				            break;
    				    }
    				?>
    			</div>
			</div>
			<div id="column_right">
			    <?php include 'loga.php' ?>
			</div>
		</div>
	</div>
</body>

</html>
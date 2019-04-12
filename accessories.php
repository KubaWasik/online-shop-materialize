<?php
session_start();
if ((isset($_POST['cart_printer'])) || (isset($_POST['cart_monitor'])) || (isset($_POST['cart_mouse'])) || (isset($_POST['cart_keyboard']))
) {
		if (isset($_SESSION['table_accessories'])) {
			$table_accessories = $_SESSION['table_accessories'];
		} else {
			$table_accessories = array('printer', 'monitor', 'mouse', 'keyboard');
		}
		if ((isset($_POST['cart_printer']))) {
			$table_accessories['printer'] = $_POST['cart_printer'];
			unset($_POST['cart_printer']);
		} else {
			$table_accessories['printer'] = 0;
		}
		if ((isset($_POST['cart_monitor']))) {
			$table_accessories['monitor'] = $_POST['cart_monitor'];
			unset($_POST['cart_monitor']);
		} else {
			$table_accessories['monitor'] = 0;
		}
		if ((isset($_POST['cart_mouse']))) {
			$table_accessories['mouse'] = $_POST['cart_mouse'];
			unset($_POST['cart_mouse']);
		} else {
			$table_accessories['mouse'] = 0;
		}
		if ((isset($_POST['cart_keyboard']))) {
			$table_accessories['keyboard'] = $_POST['cart_keyboard'];
			unset($_POST['cart_keyboard']);
		} else {
			$table_accessories['keyboard'] = 0;
		}
		$_SESSION['table_accessories'] = $table_accessories;
		unset($table_accessories);
	}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css" media="screen,projection" />
	<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Modak" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Sigmar+One" rel="stylesheet">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="UTF-8">
	<title>ENTER - sklep internetowy</title>
</head>

<body>
	<header>
		<ul id="dropdown-id" class="dropdown-content">
			<li><a href="computers.php">Komputery<i class="material-icons right">desktop_windows</i></a></li>
			<li><a href="laptops.php">Laptopy<i class="material-icons right">laptop</i></a></li>
			<li class="divider"></li>
			<li><a href="accessories.php">Akcesoria<i class="material-icons right">print</i></a></li>
		</ul>
		<div class="navbar-fixed">
			<nav class="teal darken-3">
				<div class="nav-wrapper">
					&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" class="brand-logo" style="font-family: 'Modak', cursive;">ENTER<i style="font-size: 30px" class="material-icons right">keyboard_return</i></a>
					<a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<!-- Dropdown Trigger -->
						<li><a id="clock_tooltip" class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="">Aktualny czas: <span class="flow-text orange-text text-lighten-2" id="clock"></span></a></li>
						<li><a class="flow-text waves-effect waves-orange dropdown-button" href="#!" data-activates="dropdown-id">Asortyment sklepu<i class="material-icons right">arrow_drop_down</i></a></li>
						<li><a class="flow-text waves-effect waves-orange" href="programs.php">Programy<i class="material-icons right">code</i></a></li>
						<li><a class="flow-text waves-effect waves-orange" href="contact.php">Kontakt<i class="material-icons right">help</i></a></li>
						<?php
						if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
							echo '<li><a class="flow-text waves-effect waves-orange" href="logout.php">Wyloguj<i class="material-icons right">account_circle</i></a></li>';
						} else if (!isset($_SESSION['logged_in'])) {
							echo '<li><a class="flow-text waves-effect waves-orange" href="#login">Zaloguj<i class="material-icons right">account_circle</i></a></li>';
						}
						?>
					</ul>
				</div>
			</nav>
		</div>
		<nav class="nav-extended teal darken-3">
			<div>
				<ul class="side-nav" id="mobile-menu">
					<li><a class="waves-effect waves-orange" href="index.php">Strona główna<i class="material-icons center">home</i></a></li>
					<?php
					if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
						echo '<li><a class="waves-effect waves-orange" href="log_out.php">Wyloguj<i class="material-icons center">account_circle</i></a></li>';
					} else if (!isset($_SESSION['logged_in'])) {
						echo '<li><a class="waves-effect waves-orange" href="login_page.php">Zaloguj<i class="material-icons center">account_circle</i></a></li>';
					}
					?>
					<li class="divider"></li>
					<li><a class="waves-effect waves-orange" href="computers.php">Komputery<i class="material-icons">desktop_windows</i></a></li>
					<li><a class="waves-effect waves-orange" href="laptops.php">Laptopy<i class="material-icons">laptop</i></a></li>
					<li class="divider"></li>
					<li><a class="waves-effect waves-orange" href="accessories.php">Akcesoria<i class="material-icons">print</i></a></li>
					<li><a class="waves-effect waves-orange" href="programs.php">Programy<i class="material-icons">code</i></a></li>
					<li><a class="waves-effect waves-orange" href="contact.php">Kontakt<i class="material-icons">help</i></a></li>
				</ul>
			</div>
		</nav>
	</header>
	<main>
		<form id="login" class="card modal" action="login_script.php" method="post">
			<figure class="card-image waves-effect waves-block waves-light">
				<img class="activator" alt="avatar" src="assets/images/img_avatar.png" style="margin-left: 30%; border-radius: 150px; width:40%">
			</figure>
			<header class="card-content">
				<span class="card-title activator grey-text text-darken-4">Logowanie<i class="material-icons right">arrow_upward</i></span>
				<p><a href="register.php">Witaj nieznajomy, jeśli nie masz jeszcze konta w naszym serwisie, zarejestruj się</a></p>
			</header>
			<section class="card-reveal">
				<span class="card-title grey-text text-darken-4">Logowanie<i class="material-icons right">close</i></span>
				<div style="margin-top:10%" class="row">
					<div class="input-field col s8 offset-s2 l6 offset-l3">
						<i class="material-icons prefix">face</i>
						<input id="icon_prefix_login" type="text" class="validate" name="login" required>
						<label for="icon_prefix_login">Login</label>
					</div>
					<div class="input-field col s8 offset-s2 l6 offset-l3">
						<i class="material-icons prefix">vpn_key</i>
						<input id="icon_prefix_passwd" type="password" class="validate" name="passwd" required>
						<label for="icon_prefix_passwd">Hasło</label>
					</div>
				</div>
				<footer class="modal-footer input-field center">
					<input class="waves-effect waves-green btn-flat" type="submit" value="Zaloguj">
					<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
				</footer>
			</section>
		</form>
		
		<figure class="carousel">
			<figcaption>
				<h4 class="center orange-text text-lighten-2">Galeria naszych produktów</h4>
			</figcaption>
			<a class="carousel-item" href="#printer"><img alt="Drukarka - pokaz zdjęć" src="assets/images/printer_min.png"></a>
			<a class="carousel-item" href="#monitor"><img alt="Monitor - pokaz zdjęć" src="assets/images/monitor_min.png"></a>
			<a class="carousel-item" href="#mouse"><img alt="Mysz - pokaz zdjęć" src="assets/images/mouse_min.png"></a>
			<a class="carousel-item" href="#keyboard"><img alt="Klawiatura - pokaz zdjęć" src="assets/images/keyboard_min.png"></a>
		</figure>

		<section>
			<div class="row">
				<article id="printer" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="drukarka" src="assets/images/printer.png">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_printer" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Drukarka EPSON</h4>
							<div id="descrpition_printer" class="flow-text">
								<h5 class="center flow-text">
									Producent: EPSON<br>
									Cena: 170 zł
								</h5>
								Stylowe małe urządzenie wielofunkcyjne firmy Epson z przyjazną dla użytkownika łącznością Wi-Fi, które jest zarówno niedrogie, jak i bardzo kompaktowe. Doskonałe do udostępniania wielu użytkownikom.
							</div>
							<a id="expand_printer" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
				<article id="monitor" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="monitor" src="assets/images/monitor.jpg">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_monitor" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Monitor LG</h4>
							<div id="description_monitor" class="flow-text">
								<h5 class="center flow-text">
									Producent: <br>
									Cena: 300 zł
								</h5>
								Dobre parametry i zastosowanie nowoczesnych rozwiązań technologicznych w postaci układu scalonego f-Engine i technologii DFC gwarantują wysoką jakość obrazu. Dzięki nowatorskim technologiom DFC (Digital Fine Contrast) oraz f-Engine, monitory LG L194WT-SF są przygotowane do odtwarzania filmów, gier, animacji oraz zdjęć cyfrowych. Zastosowanie technologii DFC sprawia, ze wyświetlany obraz jest żywy, kolory bardziej naturalne, a tekst wyraźniejszy.
							</div>
							<a id="expand_monitor" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
				<article id="mouse" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="mysz" src="assets/images/mouse.png">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_mouse" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Mysz Logitech</h4>
							<div id="description_mouse" class="flow-text">
								<h5 class="center flow-text">
									Producent: Logitech<br>
									Cena: 50 zł
								</h5>
								Technologia optycznego śledzenia ruchów w wysokiej rozdzielczości (1000 dpi) zapewnia szybkie i płynne reakcje kursora oraz ułatwia zaznaczanie tekstu. Mysz została zaprojektowana ku zadowoleniu obu rąk. Dzięki temu jest wygodna nawet po wielu godzinach pracy.
							</div>
							<a id="expand_mouse" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
				<article id="keyboard" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="klawiatura" src="assets/images/keyboard.png">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_keyboard" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Klawiatura A4Tech</h4>
							<div id="description_keyboard" class="flow-text">
								<h5 class="center flow-text">
									Producent: A4Tech<br>
									Cena: 70 zł
								</h5>
								Prosta w obsłudze, z dodatkowymi intuicyjnymi klawiszami dla nie wymagających konsumentów, sprawdzona pod względem wytrzymałośći nie zawiedzie nawet przy intensywnej pracy.
							</div>
							<a id="expand_keyboard" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
			</div>
		</section>
		<form id="buy_printer" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Drukarka</h5>
				<p>Cena za sztukę: 170 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_printer(170)" id="quantity_printer" type="number" class="validate" name="cart_printer" min="1" max="100" required>
				<label for="quantity_printer">Ilość</label>
				<p>Cena razem: <span id="price_printer" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_monitor" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Monitor</h5>
				<p>Cena za sztukę: 300 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_monitor(300)" id="quantity_monitor" type="number" class="validate" name="cart_monitor" min="1" max="100" required>
				<label for="quantity_monitor">Ilość</label>
				<p>Cena razem: <span id="price_monitor" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_mouse" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Mysz</h5>
				<p>Cena za sztukę: 50 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_mouse(50)" id="quantity_mouse" type="number" class="validate" name="cart_mouse" min="1" max="100" required>
				<label for="quantity_mouse">Ilość</label>
				<p>Cena razem: <span id="price_mouse" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_keyboard" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Klawiatura</h5>
				<p>Cena za sztukę: 70 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_keyboard(70)" id="quantity_keyboard" type="number" class="validate" name="cart_keyboard" min="1" max="100" required>
				<label for="quantity_keyboard">Ilość</label>
				<p>Cena razem: <span id="price_keyboard" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
	</main>
	<aside class="fixed-action-btn toolbar">
		<a class="btn-floating btn-large orange">
			<i class="large material-icons">person_pin</i>
		</a>
		<ul>
			<li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Koszyk"><a href="cart.php"><i class="material-icons">shopping_basket</i></a></li>
			<li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Profil"><a href="profile.php"><i class="material-icons">person</i></a></li>
			<li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Kup produkty"><a href="computers.php"><i class="material-icons">add_shopping_cart</i></a></li>
			<?php
			if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
				echo '<li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Wyloguj"><a href="logout.php"><i class="material-icons">exit_to_app</i></a></li>';
			} else if (!isset($_SESSION['logged_in'])) {
				echo '<li class="waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Zaloguj"><a href="login_page.php"><i class="material-icons">assignment_ind</i></a></li>';
			}
			?>
		</ul>
	</aside>
	<footer class="page-footer teal darken-3">
		<section class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">ENTER</h5>
					<p class="flow-text grey-text text-lighten-4">
						Copyrights © ENTER. Wszystkie prawa zastrzeżone.
					</p>
				</div>
			</div>
		</section>
		<section class="footer-copyright">
			<div class="container">
				Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
			</div>
		</section>
	</footer>
	<!--Import jQuery before materialize.js-->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>
	<script>
		var months_names = ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
		var days_names = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];

		function getTime() {
			var date = new Date();
			var hour = date.getHours();
			var min = date.getMinutes();
			var sec = date.getSeconds();
			return hour + ((min < 10) ? ":0" : ":") + min + ((sec < 10) ? ":0" : ":") + sec;
		}

		function getDate() {
			var date = new Date();
			var day_number = date.getDay();
			var day_name = date.getDate();
			var month = date.getMonth();
			var year = date.getFullYear();
			return days_names[day_number - 1] + " " + day_name + " " + months_names[month] + " " + year;
		}
		document.getElementById('clock').innerHTML = getTime();
		document.getElementById('clock_tooltip').setAttribute("data-tooltip", getDate());
		setInterval(function() {
			document.getElementById('clock').innerHTML = getTime();
			document.getElementById('clock_tooltip').setAttribute("data-tooltip", getDate());
		}, 1000);

		function price_printer(val) {
			var x = document.getElementById("price_printer");
			x.innerHTML = document.forms['buy_printer'].quantity_printer.value * val;
		}

		function price_monitor(val) {
			var x = document.getElementById("price_monitor");
			x.innerHTML = document.forms['buy_monitor'].quantity_monitor.value * val;
		}

		function price_mouse(val) {
			var x = document.getElementById("price_mouse");
			x.innerHTML = document.forms['buy_mouse'].quantity_mouse.value * val;
		}

		function price_keyboard(val) {
			var x = document.getElementById("price_keyboard");
			x.innerHTML = document.forms['buy_keyboard'].quantity_keyboard.value * val;
		}
	</script>
	<script>
		$(document).ready(function() {
			$(".button-collapse").sideNav();
			$('.parallax').parallax();
			$(".dropdown-button").dropdown();
			$('.modal').modal();
			$('#login').modal('open');
			$('#login').modal('close');
			$('.fixed-action-btn').openFAB();
			$('.fixed-action-btn').closeFAB();
			$('.fixed-action-btn.toolbar').openToolbar();
			$('.fixed-action-btn.toolbar').closeToolbar();
			$('.carousel').carousel();

			$("#descrpition_printer").hide();
			$("#description_monitor").hide();
			$("#description_mouse").hide();
			$("#description_keyboard").hide();
			$("#expand_printer").click(function() {
				$("#descrpition_printer").slideToggle("medium");
			});
			$("#expand_monitor").click(function() {
				$("#description_monitor").slideToggle("medium");
			});
			$("#expand_mouse").click(function() {
				$("#description_mouse").slideToggle("medium");
			});
			$("#expand_keyboard").click(function() {
				$("#description_keyboard").slideToggle("medium");
			});
		});
	</script>
</body>

</html>
<?php
session_start();
if ((isset($_POST['cart_office'])) || (isset($_POST['cart_kaspersky'])) || (isset($_POST['cart_photoshop']))) {
	if (isset($_SESSION['table_programs'])) {
		$table_programs = $_SESSION['table_programs'];
	} else {
		$table_programs = array('office', 'kaspersky', 'photoshop');
	}
	if ((isset($_POST['cart_office']))) {
		$table_programs['office'] = $_POST['cart_office'];
		unset($_POST['cart_office']);
	} else {
		$table_programs['office'] = 0;
	}
	if ((isset($_POST['cart_kaspersky']))) {
		$table_programs['kaspersky'] = $_POST['cart_kaspersky'];
		unset($_POST['cart_kaspersky']);
	} else {
		$table_programs['kaspersky'] = 0;
	}
	if ((isset($_POST['cart_photoshop']))) {
		$table_programs['photoshop'] = $_POST['cart_photoshop'];
		unset($_POST['cart_photoshop']);
	} else {
		$table_programs['photoshop'] = 0;
	}
	$_SESSION['table_programs'] = $table_programs;
	unset($table_programs);
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

		<section>
			<article class="row container">
				<figure class="col s12 m8 offset-m2">
					<img class="materialboxed responsive-img" alt="Microsoft Office" src="assets/images/office.png">
				</figure>
				<div id="office" class="col s12 m8 offset-m2 center">

					<h3>Microsoft Office 2016 dla Użytkowników Domowych i Uczniów</h3>
					<p>
						Dla osób, które potrzebują podstawowych aplikacji pakietu Office dla 1 użytkownika, na 1 komputer Windows PC.
					</p>
					<a class="btn-floating btn-large waves-effect waves-light teal tooltipped" href="#buy_office" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
				</div>
			</article>
			<article class="row container">
				<figure class="col s12 m8 offset-m2">
					<img class="materialboxed responsive-img" alt="Autorski program księgowy" src="assets/images/program.png">
				</figure>
				<div id="accounting_program" class="col s12 m8 offset-m2 center">
					<h3>Autorski program księgowy</h3>
					<p>
						Program dla firm, które potrzebują szybko uporać się z problemami księgowania danych.
					</p><br>
					<p>Cena: 600 zł na 1 rok</p>
					<a class="btn-floating btn-large waves-effect waves-light teal tooltipped" href="#buy_accounting_program" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
				</div>
			</article>
			<article class="row container">
				<figure class="col s12 m8 offset-m2">
					<img class="materialboxed responsive-img" alt="Kaspersky Total Security" src="assets/images/kaspersky.png">
				</figure>
				<div id="antivirus" class="col s12 m6 offset-m3 center">
					<h3>Kaspersky Total Security</h3>
					<p>
						Pomaga Ci chronić Twoją rodzinę - na komputerach PC i Mac, iPhone'ach i iPadach oraz urządzeniach z Androidem.
					</p><br>
					<p>Cena: 200 zł na 1 rok</p>
					<a class="btn-floating btn-large waves-effect waves-light teal tooltipped" href="#buy_antivirus" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
				</div>
			</article>
			<article class="row">
				<figure class="col s12 m8 offset-m3">
					<img class="materialboxed responsive-img" alt="Adobe Photoshop" src="assets/images/photoshop.png">
				</figure>
				<div id="photoshop" class="col s12 m6 offset-m3 center">
					<h3>Adobe Photoshop</h3>
					<p>
						Profesjonalny program do obróbki grafiki, doskonały dla grafików amatarów jak i dla firm do tworzenia zaawansowanych projektów.
					</p><br>
					<p>Cena: 650 zł na 1 rok</p>
					<a class="btn-floating btn-large waves-effect waves-light teal tooltipped" href="#buy_photoshop" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
				</div>
			</article>
		</section>
		<form id="buy_office" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Microsoft Office 2016</h5>
				<p>Cena za jedną kopię na rok: 600 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_office(600)" id="quantity_office" type="number" class="validate" name="cart_office" min="1" max="100" required>
				<label for="quantity_office">Ilość</label>
				<p>Cena razem: <span id="price_office" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_accounting_program" class="modal" method="post">
			<section class="modal-content">
				<h4>Autorski program księgowy</h4>
				<p>Cena do ustalenia, aby omówić zakup naszego programu prosimy skontaktuj się z nami.</p>
				<a href="contact.php" class="modal-action waves-effect waves-green btn">Kontakt</a>
			</section>
			<footer class="modal-footer">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_antivirus" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Kaspersky Total Security</h5>
				<p>Cena za jedną kopię na rok: 200 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_kaspersky(200)" id="quantity_kaspersky" type="number" class="validate" name="cart_kaspersky" min="1" max="100" required>
				<label for="quantity_kaspersky">Ilość</label>
				<p>Cena razem: <span id="price_kaspersky" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_photoshop" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Adobe Photoshop</h5>
				<p>Cena za jedna kopie na rok: 650 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_photoshop(650)" id="quantity_photoshop" type="number" class="validate" name="cart_photoshop" min="1" max="100" required>
				<label for="quantity_photoshop">Ilość</label>
				<p>Cena razem: <span id="price_photoshop" class="orange-text"></span> zł</p>
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

		function price_office(val) {
			var x = document.getElementById("price_office");
			x.innerHTML = document.forms['buy_office'].quantity_office.value * val;
		}

		function price_kaspersky(val) {
			var x = document.getElementById("price_kaspersky");
			x.innerHTML = document.forms['buy_antivirus'].quantity_kaspersky.value * val;
		}

		function price_photoshop(val) {
			var x = document.getElementById("price_photoshop");
			x.innerHTML = document.forms['buy_photoshop'].quantity_photoshop.value * val;
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
			$('.materialboxed').materialbox();
		});
	</script>
</body>

</html>
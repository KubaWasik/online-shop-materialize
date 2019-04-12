<?php
session_start();
if (!isset($_SESSION['done_register'])) {
	header('Location: index.php');
	exit();
} else {
	unset($_SESSION['done_register']);
}
if (isset($_SESSION['saved_login'])) unset($_SESSION['saved_login']);
if (isset($_SESSION['saved_password_1'])) unset($_SESSION['saved_password_1']);
if (isset($_SESSION['saved_password_2'])) unset($_SESSION['saved_password_2']);
if (isset($_SESSION['saved_email'])) unset($_SESSION['saved_email']);
if (isset($_SESSION['saved_statute'])) unset($_SESSION['saved_statute']);
if (isset($_SESSION['error_login'])) unset($_SESSION['error_login']);
if (isset($_SESSION['error_password'])) unset($_SESSION['error_password']);
if (isset($_SESSION['error_email'])) unset($_SESSION['error_email']);
if (isset($_SESSION['error_statute'])) unset($_SESSION['error_statute']);
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
		<section class="container">
			<div class="row section" style="margin-top: 10%; margin-bottom: 15%;">
				<div class="section">
					<h2>Witamy</h2>
					<p> w naszym serwisie, zostałeś poprawnie zarejestrowany i teraz możesz się już zalogować.</p>
				</div>
				<div class="section scrollspy">
					<a class="waves-effect waves-light btn" onclick="$('.tap-target').tapTarget('open')">Informacje na temat nawigacji</a>&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="waves-effect waves-light btn" onclick="$('.tap-target').tapTarget('close')">Zamknij infromację</a>
				</div>
			</div>
		</section>
	</main>
	<aside class="fixed-action-btn toolbar">
		<a id="info" class="waves-effect waves-light btn-large btn-floating orange">
			<i class="large material-icons">person_pin</i>
		</a>
		<div class="tap-target cyan" data-activates="info">
			<div class="tap-target-content white-text">
				<h5>Informacja</h5>
				<p class="white-text">Ta ikonka pozwala na intuicyjne przemieszczenie się po serwisie dla osób zalogowanych, po kliknięciu rozwinie się menu z przydatnymi odnośnikami</p>
			</div>
		</div>
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
			$('.tap-target').tapTarget('open');
			$('.tap-target').tapTarget('close');
		});
	</script>
</body>

</html>
<?php
session_start();
if ((isset($_POST['cart_asus'])) || (isset($_POST['cart_dell'])) || (isset($_POST['cart_lenovo'])) || (isset($_POST['cart_hp']))) {
		if (isset($_SESSION['table_laptops'])) {
				$table_laptops = $_SESSION['table_laptops'];
			} else {
				$table_laptops = array('asus', 'dell', 'lenovo', 'hp');
			}
		if ((isset($_POST['cart_asus']))) {
				$table_laptops['asus'] = $_POST['cart_asus'];
				unset($_POST['cart_asus']);
			} else {
				$table_laptops['asus'] = 0;
			}
		if ((isset($_POST['cart_dell']))) {
				$table_laptops['dell'] = $_POST['cart_dell'];
				unset($_POST['cart_dell']);
			} else {
				$table_laptops['dell'] = 0;
			}
		if ((isset($_POST['cart_lenovo']))) {
				$table_laptops['lenovo'] = $_POST['cart_lenovo'];
				unset($_POST['cart_lenovo']);
			} else {
				$table_laptops['lenovo'] = 0;
			}
		if ((isset($_POST['cart_hp']))) {
				$table_laptops['hp'] = $_POST['cart_hp'];
				unset($_POST['cart_hp']);
			} else {
				$table_laptops['hp'] = 0;
			}
		$_SESSION['table_laptops'] = $table_laptops;
		unset($table_laptops);
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

		<figure class="carousel">
			<figcaption>
				<h4 class="center orange-text text-lighten-2">Galeria naszych produktów</h4>
			</figcaption>
			<a class="carousel-item" href="#asus"><img alt="Laptop ASUS - pokaz zdjęć" src="assets/images/asus.png"></a>
			<a class="carousel-item" href="#dell"><img alt="Laptop DELL - pokaz zdjęć" src="assets/images/dell.png"></a>
			<a class="carousel-item" href="#lenovo"><img alt="Laptop LENOVO - pokaz zdjęć" src="assets/images/lenovo.png"></a>
			<a class="carousel-item" href="#hp"><img alt="Laptop HP - pokaz zdjęć" src="assets/images/hp.png"></a>
		</figure>
		<section>
			<div class="row">
				<article id="asus" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="Laptop ASUS ZenBook 3" src="assets/images/asus.png">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_asus" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Laptop ASUS ZenBook 3</h4>
							<div id="description_asus" class="flow-text">
								<h5 class="center flow-text">
									Producent: ASUS<br>
									Cena: 5400 zł
								</h5>
								ZenBook 3 został całkowicie przeprojektowany i dostosowany do wymogów nowej ery komputerów przenośnych. Każdy pojedynczy komponent urządzenia oraz detal obudowy, zostały zaprojektowane zupełnie od nowa. Jest lżejszy, smuklejszy, bardziej wytrzymały, niewyobrażalnie potężny, a co najważniejsze, ponadczasowo elegancki.
							</div>
							<a id="expand_asus" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
				<article id="dell" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="Laptop DELL XPS 13" src="assets/images/dell.png">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_dell" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Laptop DELL XPS 13</h4>
							<div id="description_dell" class="flow-text">
								<h5 class="center flow-text">
									Producent: DELL<br>
									Cena: 7000 zł
								</h5>
								Ultracienki laptop premium z Windows 10 Home, najnowszym procesorem Intel® Core™ i5 siódmej generacji oraz bezramkowym wyświetlaczem InfinityEdge o rozdzielczości Full-HD przeciwodblaskowym.
							</div>
							<a id="expand_dell" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
				<article id="lenovo" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="laptop LENOVO G70" src="assets/images/lenovo.png">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_lenovo" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Laptop LENOVO G70</h4>
							<div id="description_lenovo" class="flow-text">
								<h5 class="center flow-text">
									Producent: LENOVO<br>
									Cena: 2300 zł
								</h5>
								Najzwyklejszy laptop w dogodnej cenie dla niewymagających użytkowników, napędza go szybki procesor oraz zintegrowana karta graficzna, przydatny może być duży ekran o rozdzielczości HD+ (1600x900px) i dobre głośniki, doskonale nadaje się do oglądania filmów czy grania w gry.
							</div>
							<a id="expand_lenovo" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
				<article id="hp" class="col s12 m6">
					<div class="card">
						<figure class="card-image">
							<img alt="Laptop HP OMEN" src="assets/images/hp.png">
							<a class="btn-floating btn-large halfway-fab waves-effect waves-light teal tooltipped" href="#buy_hp" data-position="top" data-delay="50" data-tooltip="Dodaj do koszyka"><i class="material-icons">add</i></a>
						</figure>
						<div class="card-content">
							<h4 class="center orange-text lighten-3">Laptop HP OMEN</h4>
							<div id="description_hp" class="flow-text">
								<h5 class="center flow-text">
									Producent: HP<br>
									Cena: 7000 zł
								</h5>
								Pracuj więcej, trenuj dłużej i wznieś się na poziom bezwzględnej konkurencji. Wyposażony w wydajny sprzęt i odznaczające się agresywnym wyglądem laptop OMEN jest gotowy do rywalizacji zawsze i wszędzie. Sięgnij po to, co Ci się należy.
							</div>
							<a id="expand_hp" class="btn-flat center">Rozwiń/Zwiń<i class="material-icons right">import_export</i></a>
						</div>
					</div>
				</article>
			</div>
		</section>
		<form id="buy_asus" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Asus ZenBook 3</h5>
				<p>Cena za sztukę: 5400 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_asus(5400)" id="quantity_asus" type="number" class="validate" name="cart_asus" min="1" max="100" required>
				<label for="quantity_asus">Ilość</label>
				<p>Cena razem: <span id="price_asus" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_dell" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Dell XPS 13</h5>
				<p>Cena za sztukę: 7000 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_dell(5400)" id="quantity_dell" type="number" class="validate" name="cart_dell" min="1" max="100" required>
				<label for="quantity_dell">Ilość</label>
				<p>Cena razem: <span id="price_dell" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_lenovo" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">Lenovo G70</h5>
				<p>Cena za sztukę: 2300 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_lenovo(2300)" id="quantity_lenovo" type="number" class="validate" name="cart_lenovo" min="1" max="100" required>
				<label for="quantity_lenovo">Ilość</label>
				<p>Cena razem: <span id="price_lenovo" class="orange-text"></span> zł</p>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="buy_hp" class="modal" method="post">
			<section class="modal-content">
				<h4>Dodaj wybrany produkt do koszyka</h4>
				<h5 class="orange-text">HP OMEN</h5>
				<p>Cena za sztukę: 7000 zł</p>
				<i class="material-icons prefix">add_shopping_cart</i>
				<input onchange="price_hp(7000)" id="quantity_hp" type="number" class="validate" name="cart_hp" min="1" max="100" required>
				<label for="quantity_hp">Ilość</label>
				<p>Cena razem: <span id="price_hp" class="orange-text"></span> zł</p>
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

		function price_asus(val) {
			var x = document.getElementById("price_asus");
			x.innerHTML = document.forms['buy_asus'].quantity_asus.value * val;
		}

		function price_dell(val) {
			var x = document.getElementById("price_dell");
			x.innerHTML = document.forms['buy_dell'].quantity_dell.value * val;
		}

		function price_lenovo(val) {
			var x = document.getElementById("price_lenovo");
			x.innerHTML = document.forms['buy_lenovo'].quantity_lenovo.value * val;
		}

		function price_hp(val) {
			var x = document.getElementById("price_hp");
			x.innerHTML = document.forms['buy_hp'].quantity_hp.value * val;
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

			$("#description_asus").hide();
			$("#description_dell").hide();
			$("#description_lenovo").hide();
			$("#description_hp").hide();
			$("#expand_asus").click(function() {
				$("#description_asus").slideToggle("medium");
			});
			$("#expand_dell").click(function() {
				$("#description_dell").slideToggle("medium");
			});
			$("#expand_lenovo").click(function() {
				$("#description_lenovo").slideToggle("medium");
			});
			$("#expand_hp").click(function() {
				$("#description_hp").slideToggle("medium");
			});
		});
	</script>
</body>

</html>
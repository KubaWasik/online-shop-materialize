<?php
session_start();
if (isset($_POST['login'])) {
	$is_valid = true;
	$login = $_POST['login'];
	if ((strlen($login) < 3) || (strlen($login) > 30)) {
		$is_valid = false;
		$_SESSION['error_login'] = "Login musi posiadać od 3 do 30 znaków!";
	}
	if (ctype_alnum($login) == false) {
		$is_valid = false;
		$_SESSION['error_login'] = "Login może składać się tylko z liter i cyfr (bez polskich znaków)!";
	}
	$email = $_POST['email'];
	$email_v = filter_var($email, FILTER_SANITIZE_EMAIL);
	if ((filter_var($email_v, FILTER_VALIDATE_EMAIL) == false) || ($email_v != $email)) {
		$is_valid = false;
		$_SESSION['error_email'] = "Podaj poprawny adres e-mail!";
	}
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];
	if (strlen($password_1) < 8 || strlen($password_1) > 20) {
		$is_valid = false;
		$_SESSION['error_password'] = "Hasło musi posiadać od 8 do 20 znaków!";
	}
	if ($password_1 != $password_2) {
		$is_valid = false;
		$_SESSION['error_password'] = "Podane hasła nie są identyczne!";
	}
	$hash_password = hash("sha256", $password_1);
	if (!isset($_POST['statute'])) {
		$is_valid = false;
		$_SESSION['error_statute'] = "Potwierdz akceptację regulaminu!";
	}
	$_SESSION['saved_login'] = $login;
	$_SESSION['saved_email'] = $email;
	$_SESSION['saved_password_1'] = $password_1;
	$_SESSION['saved_password_2'] = $password_2;
	if (isset($_POST['statute'])) {
		$_SESSION['saved_statute'] = true;
	}
	require_once('credentials.php');
	mysqli_report(MYSQLI_REPORT_STRICT);
	try {
		$conn = new mysqli($host, $db_user, $db_password, $db_name);
		if ($conn->connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		} else {
			$result = $conn->query("SELECT id FROM users WHERE email='$email'");
			if (!$result) throw new Exception($conn->error);
			$number_of_emails = $result->num_rows;
			if ($number_of_emails > 0) {
				$is_valid = false;
				$_SESSION['error_email'] = "Intnieje już konto z przypisanym takim adresem e-mail";
			}
			$result = $conn->query("SELECT id FROM users WHERE login='$login'");
			if (!$result) throw new Exception($conn->error);
			$number_of_logins = $result->num_rows;
			if ($number_of_logins > 0) {
				$is_valid = false;
				$_SESSION['error_login'] = "Intnieje już konto z takim loginem! Wybierz inny";
			}
			if ($is_valid == true) {
				if ($conn->query("INSERT INTO users (login, passwd, email) VALUES ('$login','$hash_password','$email')")) {
					$_SESSION['done_register'] = true;
					header("Location: done_register.php");
				} else {
					throw new Exception($conn->error);
				}
			}
			$conn->close();
		}
	} catch (Exception $blad) {
		echo '<p class="orange">Błąd serwera! Spróbuj ponownie za chwilę</p>';
	}
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
	<title>Rejestracja - ENTER</title>
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
			<div class="row section">
				<form class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 xl6 offset-xl3" method="post">
					<h2 class="center">Rejestracja</h2>
					<div class="divider"></div>
					<p class="section input-field">
						<i class="material-icons prefix">face</i>
						<input id="input_login" type="text" class="validate" name="login" required value="<?php if (isset($_SESSION['saved_login'])) {
							echo $_SESSION['saved_login'];
							unset($_SESSION['saved_login']);
						} ?>">
						<label for="input_login">Login</label>
					</p>
					<?php
					if (isset($_SESSION['error_login'])) {
						echo '<p class="red">' . $_SESSION['error_login'] . '</p>';
						unset($_SESSION['error_login']);
					}
					?>
					<p class="section input-field">
						<i class="material-icons prefix">done</i>
						<input id="input_password_1" type="password" class="validate" name="password_1" required value="<?php if (isset($_SESSION['saved_password_1'])) {
							echo $_SESSION['saved_password_1'];
							unset($_SESSION['saved_password_1']);
						} ?>">
						<label for="input_password_1">Hasło</label>
					</p>
					<?php
					if (isset($_SESSION['error_email'])) {
						echo '<p class="red">' . $_SESSION['error_email'] . '</p>';
						unset($_SESSION['error_email']);
					}
					?>
					<p class="section input-field">
						<i class="material-icons prefix">done_all</i>
						<input id="input_password_2" type="password" class="validate" name="password_2" required value="<?php if (isset($_SESSION['saved_password_2'])) {
							echo $_SESSION['saved_password_2'];
							unset($_SESSION['saved_password_2']);
						} ?>">
						<label for="input_password_2">Powtórz hasło</label>
					</p>
					<?php
					if (isset($_SESSION['error_password'])) {
						echo '<p class="red">' . $_SESSION['error_password'] . '</p>';
						unset($_SESSION['error_password']);
					}
					?>
					<p class="section input-field">
						<i class="material-icons prefix">contact_mail</i>
						<input id="input_email" type="email" class="validate" name="email" required value="<?php if (isset($_SESSION['saved_email'])) {
							echo $_SESSION['saved_email'];
							unset($_SESSION['saved_email']);
						} ?>">
						<label for="input_email">E-mail</label>
					</p>
					<p class="section input-field center">
						<input type="checkbox" id="statute" name="statute" <?php
																			if (isset($_SESSION['saved_statute'])) {
																					echo "checked";
																					unset($_SESSION['saved_statute']);
																				}
																			?>>
						<label for="statute">Akceptuję regulamin</label>
					</p>
					<?php
					if (isset($_SESSION['error_statute'])) {
						echo '<p class="red">' . $_SESSION['error_statute'] . '</p>';
						unset($_SESSION['error_statute']);
					}
					?>
					<p class="section input-field center">
						<input class="waves-effect waves-green btn-flat orange lighten-2" type="submit" value="Zaloguj">
					</p>
				</form>
			</div>
		</section>
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
		});
	</script>
</body>

</html>
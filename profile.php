<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
		header('Location: index.php');
		exit();
	} else if (isset($_POST['edit_login'])) {
		$is_valid = true;
		$new_logn = $_POST['edit_login'];
		if ((strlen($new_logn) < 3) || (strlen($new_logn) > 30)) {
				$is_valid = false;
				$_SESSION['error_login'] = "Login musi posiadać od 3 do 30 znaków!";
			}
		if (ctype_alnum($new_logn) == false) {
				$is_valid = false;
				$_SESSION['error_login'] = "Login może składać się tylko z liter i cyfr (bez polskich znaków)!";
			}
		require_once('credentials.php');
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$conn = new mysqli($host, $db_user, $db_password, $db_name);
			if ($conn->connect_errno != 0) {
					throw new Exception(mysqli_connect_errno());
				} else {
					$result = $conn->query("SELECT id FROM uzytkownicy WHERE login='$new_logn'");
					if (!$result) throw new Exception($conn->error);
					$number_of_logins = $result->num_rows;
					if ($number_of_logins > 0) {
							$is_valid = false;
							$_SESSION['error_login'] = "Intnieje już konto z takim loginem! Wybierz inny";
						}
					if ($is_valid == true) {
							$old_login = $_SESSION['login'];
							if ($conn->query("UPDATE users SET login='$new_logn' WHERE login='$old_login'")) {
									$_SESSION['done_edit'] = "Dane zostały edytowane poprawnie";
									$_SESSION['login'] = $new_logn;
									header('Location: profile.php');
									exit();
								} else {
									throw new Exception($conn->error);
								}
						}
					$conn->close();
				}
		} catch (Exception $error) {
			echo '<p class="orange">Błąd serwera! Spróbuj ponownie za chwilę</p>';
		}
	} else if (isset($_POST['edit_name'])) {
		$is_valid = true;
		$new_name = $_POST['edit_name'];
		if (strlen($new_name) > 30) {
				$is_valid = false;
				$_SESSION['error_name'] = "Imie może posiadać do 30 znaków!";
			}
		require_once('credentials.php');
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$conn = new mysqli($host, $db_user, $db_password, $db_name);
			if ($conn->connect_errno != 0) {
					throw new Exception(mysqli_connect_errno());
				} else {
					if ($is_valid == true) {
							$user_login = $_SESSION['login'];
							if ($conn->query("UPDATE users SET name='$new_name' WHERE login='$user_login'")) {
									$_SESSION['done_edit'] = "Dane zostały edytowane poprawnie";
									$_SESSION['name'] = $new_name;
									header('Location: profile.php');
									exit();
								} else {
									throw new Exception($conn->error);
								}
						}
					$conn->close();
				}
		} catch (Exception $error) {
			echo '<p class="orange">Błąd serwera! Spróbuj ponownie za chwilę</p>';
		}
	} else if (isset($_POST['edit_surname'])) {
		$is_valid = true;
		$new_surname = $_POST['edit_surname'];
		if (strlen($new_surname) > 30) {
				$is_valid = false;
				$_SESSION['error_surname'] = "Nazwisko może posiadać do 50 znaków!";
			}
		require_once('credentials.php');
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$conn = new mysqli($host, $db_user, $db_password, $db_name);
			if ($conn->connect_errno != 0) {
					throw new Exception(mysqli_connect_errno());
				} else {
					if ($is_valid == true) {
							$user_login = $_SESSION['login'];
							if ($conn->query("UPDATE users SET surname='$new_surname' WHERE login='$user_login'")) {
									$_SESSION['done_edit'] = "Dane zostały edytowane poprawnie";
									$_SESSION['surname'] = $new_surname;
									header('Location: profile.php');
									exit();
								} else {
									throw new Exception($conn->error);
								}
						}
					$conn->close();
				}
		} catch (Exception $error) {
			echo '<p class="orange">Błąd serwera! Spróbuj ponownie za chwilę</p>';
		}
	} else if (isset($_POST['edit_email'])) {
		$is_valid = true;
		$new_email = $_POST['edit_email'];
		if ((strlen($new_email) < 3) || (strlen($new_email) > 50)) {
				$is_valid = false;
				$_SESSION['error_email'] = "E-mail musi posiadać od 3 do 50 znaków!";
			}
		require_once('credentials.php');
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$conn = new mysqli($host, $db_user, $db_password, $db_name);
			if ($conn->connect_errno != 0) {
					throw new Exception(mysqli_connect_errno());
				} else {
					$result = $conn->query("SELECT id FROM users WHERE email='$new_email'");
					if (!$result) throw new Exception($conn->error);
					$number_of_emails = $result->num_rows;
					if ($number_of_emails > 0) {
							$is_valid = false;
							$_SESSION['error_email'] = "Intnieje już konto z takim adresem e-mail! Wybierz inny";
						}
					else {
						$is_valid = true;
					}
					if ($is_valid == true) {
							$user_login = $_SESSION['login'];
							if ($conn->query("UPDATE users SET email='$new_email' WHERE login='$user_login'")) {
									$_SESSION['done_edit'] = "Dane zostały edytowane poprawnie";
									$_SESSION['email'] = $new_email;
									header('Location: profile.php');
									exit();
								} else {
									throw new Exception($conn->error);
								}
						}
					$conn->close();
				}
		} catch (Exception $error) {
			echo '<p class="orange">Błąd serwera! Spróbuj ponownie za chwilę</p>';
		}
	} else if (isset($_POST['edit_address'])) {
		$is_valid = true;
		$new_address = $_POST['edit_address'];
		if (strlen($new_address) > 100) {
				$is_valid = false;
				$_SESSION['error_address'] = "Adres może posiadać do 100 znaków!";
			}
		require_once('credentials.php');
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$conn = new mysqli($host, $db_user, $db_password, $db_name);
			if ($conn->connect_errno != 0) {
					throw new Exception(mysqli_connect_errno());
				} else {
					if ($is_valid == true) {
							$user_login = $_SESSION['login'];
							if ($conn->query("UPDATE users SET address='$new_address' WHERE login='$user_login'")) {
									$_SESSION['done_edit'] = "Dane zostały edytowane poprawnie";
									$_SESSION['address'] = $new_address;
									header('Location: profile.php');
									exit();
								} else {
									throw new Exception($conn->error);
								}
						}
					$conn->close();
				}
		} catch (Exception $error) {
			echo '<p class="orange">Błąd serwera! Spróbuj ponownie za chwilę</p>';
		}
	} else if (isset($_POST['edit_phone'])) {
		$new_phone = $_POST['edit_phone'];
		require_once('credentials.php');
		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$conn = new mysqli($host, $db_user, $db_password, $db_name);
			if ($conn->connect_errno != 0) {
					throw new Exception(mysqli_connect_errno());
				} else {
					$user_login = $_SESSION['login'];
					if ($conn->query("UPDATE users SET phone='$new_phone' WHERE login='$user_login'")) {
							$_SESSION['done_edit'] = "Dane zostały edytowane poprawnie";
							$_SESSION['phone'] = $new_phone;
							header('Location: profile.php');
							exit();
						} else {
							throw new Exception($conn->error);
						}
					$conn->close();
				}
		} catch (Exception $error) {
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
		<section style="margin-top: 10%; margin-bottom: 10%;" class="container">
			<div class="row">
				<div class="center">
					<?php
					if (isset($_SESSION['done_edit'])) {
							echo '<p class="green">' . $_SESSION['done_edit'] . '</p>';
							unset($_SESSION['done_edit']);
						}
					?>
				</div>
				<article>
					<h3>Dane klienta</h3>
					<ul class="collection">
						<li class="collection-item avatar">
							<i class="material-icons circle orange">insert_photo</i>
							<span class="title">
								<h4>Login</h4>
							</span>
							<p class="orange-text"><?php echo $_SESSION['login']; ?></p>
							<?php
							if (isset($_SESSION['error_login'])) {
									echo '<p class="red">' . $_SESSION['error_login'] . '</p>';
									unset($_SESSION['error_login']);
								}
							?>
							<a class="secondary-content waves-effect waves-orange btn" href="#edit_login">Edytuj<i class="material-icons right">mode_edit</i></a>
						</li>
						<li class="collection-item avatar">
							<i class="material-icons circle orange">person</i>
							<span class="title">
								<h4>Imię</h4>
							</span>
							<p class="orange-text"><?php echo $_SESSION['name']; ?></p>
							<?php
							if (isset($_SESSION['error_name'])) {
									echo '<p class="red">' . $_SESSION['error_name'] . '</p>';
									unset($_SESSION['error_name']);
								}
							?>
							<a class="secondary-content waves-effect waves-orange btn" href="#edit_name">Edytuj<i class="material-icons right">mode_edit</i></a>
						</li>
						<li class="collection-item avatar">
							<i class="material-icons circle orange">person</i>
							<span class="title">
								<h4>Nazwisko</h4>
							</span>
							<p class="orange-text"><?php echo $_SESSION['surname']; ?></p>
							<?php
							if (isset($_SESSION['error_surname'])) {
									echo '<p class="red">' . $_SESSION['error_surname'] . '</p>';
									unset($_SESSION['error_surname']);
								}
							?>
							<a class="secondary-content waves-effect waves-orange btn" href="#edit_surname">Edytuj<i class="material-icons right">mode_edit</i></a>
						</li>
						<li class="collection-item avatar">
							<i class="material-icons circle orange">email</i>
							<span class="title">
								<h4>E-mail</h4>
							</span>
							<p class="orange-text"><?php echo $_SESSION['email']; ?></p>
							<?php
							if (isset($_SESSION['error_email'])) {
									echo '<p class="red">' . $_SESSION['error_email'] . '</p>';
									unset($_SESSION['error_email']);
								}
							?>
							<a class="secondary-content waves-effect waves-orange btn" href="#edit_email">Edytuj<i class="material-icons right">mode_edit</i></a>
						</li>
						<li class="collection-item avatar">
							<i class="material-icons circle orange">location_on</i>
							<span class="title">
								<h4>Adres</h4>
							</span>
							<p class="orange-text"><?php echo $_SESSION['address']; ?></p>
							<?php
							if (isset($_SESSION['error_address'])) {
									echo '<p class="red">' . $_SESSION['error_address'] . '</p>';
									unset($_SESSION['error_address']);
								}
							?>
							<a class="secondary-content waves-effect waves-orange btn" href="#edit_address">Edytuj<i class="material-icons right">mode_edit</i></a>
						</li>
						<li class="collection-item avatar">
							<i class="material-icons circle orange">call</i>
							<span class="title">
								<h4>Numer telefonu</h4>
							</span>
							<p class="orange-text"><?php echo $_SESSION['phone']; ?></p>
							<a class="secondary-content waves-effect waves-orange btn" href="#edit_phone">Edytuj<i class="material-icons right">mode_edit</i></a>
						</li>
					</ul>
				</article>
			</div>
		</section>
		<form id="edit_login" class="modal" method="post">
			<section class="modal-content">
				<h4>Edytuj login</h4>
				<i class="material-icons prefix">mode_edit</i>
				<input id="input_login" type="text" class="validate" name="edit_login" min="3" max="50" data-length="50" required>
				<label for="input_login">Login</label>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="edit_name" class="modal" method="post">
			<section class="modal-content">
				<h4>Edytuj imię</h4>
				<i class="material-icons prefix">mode_edit</i>
				<input id="input_name" type="text" class="validate" name="edit_name" min="3" max="30" data-length="30" required>
				<label for="input_name">Imię</label>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="edit_surname" class="modal" method="post">
			<section class="modal-content">
				<h4>Edytuj nazwisko</h4>
				<i class="material-icons prefix">mode_edit</i>
				<input id="input_surname" type="text" class="validate" name="edit_surname" min="3" max="30" data-length="30" required>
				<label for="input_surname">Nazwisko</label>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="edit_email" class="modal" method="post">
			<section class="modal-content">
				<h4>Edytuj e-mail</h4>
				<i class="material-icons prefix">mode_edit</i>
				<input id="input_email" type="email" class="validate" name="edit_email" min="3" max="50" data-length="50" required>
				<label for="input_email">E-mail</label>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="edit_address" class="modal" method="post">
			<section class="modal-content">
				<h4>Edytuj adres</h4>
				<i class="material-icons prefix">mode_edit</i>
				<textarea id="input_address" class="materialize-textarea" name="edit_address" max="100" data-length="100" required></textarea>
				<label for="input_address">Adres</label>
			</section>
			<footer class="modal-footer">
				<input type="submit" class="modal-action waves-effect waves-green btn-flat" value="Zapisz">
				<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Anuluj</a>
			</footer>
		</form>
		<form id="edit_phone" class="modal" method="post">
			<section class="modal-content">
				<h4>Edytuj numer telefonu</h4>
				<i class="material-icons prefix">mode_edit</i>
				<input id="input_phone" type="number" class="validate" name="edit_phone" min="100000000" max="999999999" data-length="9" required>
				<label for="input_phone">Nr telefonu</label>
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
			$('#input_address').val('Tu wpisz adres');
			$('#input_address').trigger('autoresize');
			$('input#input_text, textarea#input_address').characterCounter();
		});
	</script>
</body>

</html>
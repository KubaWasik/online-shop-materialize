<?php
session_start();
if (isset($_SESSION['table_computers']))
	$table_computers = $_SESSION['table_computers'];
if (isset($_SESSION['table_laptops']))
	$table_laptops = $_SESSION['table_laptops'];
if (isset($_SESSION['table_accessories']))
	$table_accessories = $_SESSION['table_accessories'];
if (isset($_SESSION['table_programs']))
	$table_programs = $_SESSION['table_programs'];
if (isset($_POST['delete_msi'])) {
		$table_computers['msi'] = 0;
		unset($_POST['delete_msi']);
	}
if (isset($_POST['delete_dell_pc'])) {
		$table_computers['dell_pc'] = 0;
		unset($_POST['delete_dell_pc']);
	}
if (isset($_POST['delete_lenovo_pc'])) {
		$table_computers['lenovo_pc'] = 0;
		unset($_POST['delete_lenovo_pc']);
	}
if (isset($_POST['delete_hp_pc'])) {
		$table_computers['hp_pc'] = 0;
		unset($_POST['delete_hp_pc']);
	}
if (isset($_POST['delete_asus'])) {
		$table_laptops['asus'] = 0;
		unset($_POST['delete_asus']);
	}
if (isset($_POST['delete_dell'])) {
		$table_laptops['dell'] = 0;
		unset($_POST['delete_dell']);
	}
if (isset($_POST['delete_lenovo'])) {
		$table_laptops['lenovo'] = 0;
		unset($_POST['delete_lenovo']);
	}
if (isset($_POST['delete_hp'])) {
		$table_laptops['hp'] = 0;
		unset($_POST['delete_hp']);
	}
if (isset($_POST['delete_printer'])) {
		$table_accessories['printer'] = 0;
		unset($_POST['delete_printer']);
	}
if (isset($_POST['delete_monitor'])) {
		$table_accessories['monitor'] = 0;
		unset($_POST['delete_monitor']);
	}
if (isset($_POST['delete_mouse'])) {
		$table_accessories['mouse'] = 0;
		unset($_POST['delete_mouse']);
	}
if (isset($_POST['delete_keyboard'])) {
		$table_accessories['keyboard'] = 0;
		unset($_POST['delete_keyboard']);
	}
if (isset($_POST['delete_office'])) {
		$table_programs['office'] = 0;
		unset($_POST['delete_office']);
	}
if (isset($_POST['delete_kaspersky'])) {
		$table_programs['kaspersky'] = 0;
		unset($_POST['delete_kaspersky']);
	}
if (isset($_POST['delete_photoshop'])) {
		$table_programs['photoshop'] = 0;
		unset($_POST['delete_photoshop']);
	}
if (isset($_SESSION['table_computers']))
	$_SESSION['table_computers'] = $table_computers;
if (isset($_SESSION['table_laptops']))
	$_SESSION['table_laptops'] = $table_laptops;
if (isset($_SESSION['table_accessories']))
	$_SESSION['table_accessories'] = $table_accessories;
if (isset($_SESSION['table_programs']))
	$_SESSION['table_programs'] = $table_programs;
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

		<?php
		if (((isset($_SESSION['table_computers'])) && array_sum($_SESSION['table_computers']) != 0) || ((isset($_SESSION['table_laptops']) && array_sum($_SESSION['table_laptops']) != 0)) || ((isset($_SESSION['table_accessories']) && array_sum($_SESSION['table_accessories']) != 0)) || ((isset($_SESSION['table_programs'])) && array_sum($_SESSION['table_programs']) != 0)) {
				echo '<table style="margin-bottom:10%;margin-top:10%" class="striped highlight centered responsive-table"><thead><tr>';
				echo '<th>Towar</th><th>Ilość</th><th>Cena za sztukę</th><th>Razem</th><th>Usuń</th></tr></thead>';
				echo '<tbody>';
				$all = 0;
				if (isset($_SESSION['table_computers'])) {
						echo '<tr>';
						$table_computers = $_SESSION['table_computers'];
						$computers = ($table_computers['msi'] * 4400) + ($table_computers['dell_pc'] * 4600) + ($table_computers['lenovo_pc'] * 4900) + ($table_computers['hp_pc'] * 3500);
						$all = $all + $computers;
						if ($table_computers['msi'] == 0);
						else {
								echo '<td>Komputer MSI Nightblade</td><td>' . $table_computers['msi'] . '</td><td>4400 zł</td><td>' . ($table_computers['msi'] * 4400) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_msi" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_computers['dell_pc'] == 0);
						else {
								echo '<td>Komputer DELL Inspiron</td><td>' . $table_computers['dell_pc'] . '</td><td>4600 zł</td><td>' . ($table_computers['dell_pc'] * 4600) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_dell_pc" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_computers['lenovo_pc'] == 0);
						else {
								echo '<td>Komputer LENOVO Ideacentre AIO 700</td><td>' . $table_computers['lenovo_pc'] . '</td><td>4900 zł</td><td>' . ($table_computers['lenovo_pc'] * 4900) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_lenovo_pc" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_computers['hp_pc'] == 0);
						else {
								echo '<td>Komputer HP EliteDesk 705</td><td>' . $table_computers['hp_pc'] . '</td><td>3500 zł</td><td>' . ($table_computers['hp_pc'] * 3500) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_hp_pc" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
					}
				if (isset($_SESSION['table_laptops'])) {
						echo '<tr>';
						$table_laptops = $_SESSION['table_laptops'];
						$laptops = ($table_laptops['asus'] * 5400) + ($table_laptops['dell'] * 7000) + ($table_laptops['lenovo'] * 2300) + ($table_laptops['hp'] * 7000);
						$all = $all + $laptops;
						if ($table_laptops['asus'] == 0);
						else {
								echo '<td>Laptop ASUS ZenBook 3</td><td>' . $table_laptops['asus'] . '</td><td>5400 zł</td><td>' . ($table_laptops['asus'] * 5400) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_asus" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_laptops['dell'] == 0);
						else {
								echo '<td>Laptop DELL XPS 13</td><td>' . $table_laptops['dell'] . '</td><td>7000 zł</td><td>' . ($table_laptops['dell'] * 7000) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_dell" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_laptops['lenovo'] == 0);
						else {
								echo '<td>Laptop LENOVO G70</td><td>' . $table_laptops['lenovo'] . '</td><td>2300 zł</td><td>' . ($table_laptops['lenovo'] * 2300) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_lenovo" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_laptops['hp'] == 0);
						else {
								echo '<td>Laptop HP OMEN</td><td>' . $table_laptops['hp'] . '</td><td>7000 zł</td><td>' . ($table_laptops['hp'] * 7000) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_hp" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
					}
				if (isset($_SESSION['table_accessories'])) {
						echo '<tr>';
						$table_accessories = $_SESSION['table_accessories'];
						$accessories = ($table_accessories['printer'] * 170) + ($table_accessories['monitor'] * 300) + ($table_accessories['mouse'] * 50) + ($table_accessories['keyboard'] * 70);
						$all = $all + $accessories;
						if ($table_accessories['printer'] == 0);
						else {
								echo '<td>Drukarka EPSON</td><td>' . $table_accessories['printer'] . '</td><td>170 zł</td><td>' . ($table_accessories['printer'] * 170) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_printer" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_accessories['monitor'] == 0);
						else {
								echo '<td>Monitor LG</td><td>' . $table_accessories['monitor'] . '</td><td>300 zł</td><td>' . ($table_accessories['monitor'] * 300) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_monitor" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_accessories['mouse'] == 0);
						else {
								echo '<td>Mysz Logitech</td><td>' . $table_accessories['mouse'] . '</td><td>50 zł</td><td>' . ($table_accessories['mouse'] * 50) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_mouse" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_accessories['keyboard'] == 0);
						else {
								echo '<td>Klawiatura A4Tech</td><td>' . $table_accessories['keyboard'] . '</td><td>70 zł</td><td>' . ($table_accessories['keyboard'] * 70) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_keyboard" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
					}
				if (isset($_SESSION['table_programs'])) {
						echo '<tr>';
						$table_programs = $_SESSION['table_programs'];
						$programs = ($table_programs['office'] * 600) + ($table_programs['kaspersky'] * 200) + ($table_programs['photoshop'] * 650);
						$all = $all + $programs;
						if ($table_programs['office'] == 0);
						else {
								echo '<td>Microsoft Office 2016</td><td>' . $table_programs['office'] . '</td><td>600 zł</td><td>' . ($table_programs['office'] * 600) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_office" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_programs['kaspersky'] == 0);
						else {
								echo '<td>Kaspersky Total Security</td><td>' . $table_programs['kaspersky'] . '</td><td>200 zł</td><td>' . ($table_programs['kaspersky'] * 200) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_kaspersky" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
						if ($table_programs['photoshop'] == 0);
						else {
								echo '<td>Adobe Photoshop</td><td>' . $table_programs['photoshop'] . '</td><td>650 zł</td><td>' . ($table_programs['photoshop'] * 650) . '</td>';
								echo '<td><form method="post"><input type="submit" name="delete_photoshop" class="btn-flat btn-large" value="Usuń"><i class="material-icons">remove_circle</i></input></form></td></tr>';
							}
					}
				echo '<tfoot><tr><th>Suma</th><td>Wartość towarów w koszyku: ' . $all . ' zł</td></tr></tfoot>';
				echo '</tbody></table>';
			} else {
				echo '<article style="margin-top: 15%; margin-bottom: 30%;" class="container">';
				echo '<h2>Koszyk pusty!</h2>';
				echo '<br><a class="btn waves-effect waves-light" href="computers.php">Przejdź do sklepu<i class="material-icons right">add_shopping_cart</i></a>';
				echo '</article>';
			}
		?>
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
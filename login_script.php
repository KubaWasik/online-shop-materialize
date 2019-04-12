<?php
	session_start();
	if ((!isset($_POST['login'])) || (!isset($_POST['passwd'])))
	{
		header('Location: index.php');
		exit();
	}
	require_once "credentials.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	try 
	{
		$conn = new mysqli($host, $db_user, $db_password, $db_name);
		if ($conn->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$login = $_POST['login'];
			$passwd = $_POST['passwd'];
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			if ($result = $conn->query(
			sprintf("SELECT * FROM users WHERE login='%s'",
			mysqli_real_escape_string($conn,$login))))
			{
				$number_of_users = $result->num_rows;
				if($number_of_users>0)
				{
					$row = $result->fetch_assoc();
					if (hash("sha256",$passwd)==$row['passwd'])
					{
						$_SESSION['logged_in'] = true;
						$_SESSION['id'] = $row['id'];
						$_SESSION['login'] = $row['login'];
						$_SESSION['name'] = $row['name'];
						$_SESSION['surname'] = $row['surname'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['address'] = $row['address'];
						$_SESSION['phone'] = $row['phone'];
						unset($_SESSION['error']);
						$result->free_result();
						header('Location: profile.php');
					}
					else 
					{
						$_SESSION['error'] = '<p class="red">Nieprawidłowy login lub hasło!</p>';
						header('Location: login_page.php');
					}
				} 
				else 
				{
					
					$_SESSION['error'] = '<p class="red">Nieprawidłowy login lub hasło!</p>';
					header('Location: login_page.php');
					
				}
			}
			else
			{
				throw new Exception($conn->error);
			}
			$conn->close();
		}
	}
	catch(Exception $e)
	{
		echo '<p class="red">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</p>';
	}

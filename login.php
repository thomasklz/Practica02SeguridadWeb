<html>
	<head>
		<title> SEGURIDAD WEB | Autentificación </title>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php
		session_start();
		if (isset($_POST['registro'])) {
			header("Location: registro.php");
		}
		if (isset($_POST['login'])) {
			include ("includes/abrirbd.php");
			$LUser= $_POST['user'];
			$LPass= $_POST['passwd'];
	        $sql = "SELECT * FROM usuarios WHERE user = '$LUser' and password = '$LPass'";
			$resultado = mysqli_query($link, $sql);
			if (mysqli_num_rows($resultado) >= '1') {
				$usuario = mysqli_fetch_assoc($resultado);
					$_SESSION['autenticado'] = 'correcto';
					$_SESSION['permisos'] = str_split($usuario['permisos']);
					$_SESSION['user'] = $usuario['user'];
					header("Location:home.php");
				
			} else {
				$_SESSION['autenticado'] = 'incorrecto';
				header("Location: NoAuth.php");
			}
			mysqli_close($link);
		} else {
			?>
			<br><br><br>
		<center>
			<img src="logo1.png" width= 280 height= 60>
			<br><br><br>
			<form action= '<?php "{$_SERVER['PHP_SELF']}" ?>' method = post>
				<input type=submit name = 'registro' value = "REGISTRAR USUARIO"> <br><br><br>
				<table bgcolor = 'lightgrey'> 
					<tr>
						<td width= 100> Usuario: </td> 
						<td> <input type = text name ='user'></td>
					</tr>
					<tr>
						<td width= 100> Password: </td> 
						<td><input type = password name ='passwd'autocomplete="off"></td>
					</tr>
				</table><br>
			
				<input type=submit name = 'login' value = "LOGIN"><br><br><br>
			</form>
			<?php
		}
		?>
	</center>
</body>
</html>
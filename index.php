<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Before | After</title>
		<link rel="stylesheet" href="vue/css/index.css">
	</head>
	<body>
		<header>
			<div id="mainMenu">
				<img src="vue/images/logo-header.png" alt="logo">
			</div>
		</header>
		<div class="content">
			<div id="register">
				<img src="vue/images/logo-header.png" alt="Inscription">
				<form>
					<input type="text" placeholder="Votre nom" id="register_name" maxlength="25">
					<input type="text" placeholder="Votre prenom" id="register_firstname" maxlength="25">
					<input type="text" placeholder="Votre ville" id="register_city" maxlength="25">
					<input type="email" placeholder="Votre email"  id="register_email">
					<input type="password" placeholder="Votre mot de passe" id="register_password">
					<input type="password" placeholder="Retaper votre mot de passe" id="register_repass">
					<button type="button" id="envoyer">S'inscrire</button>
					<div id="infoForm"></div>
				</form>
			</div>
			<div id="event">
				<div id="connexion">
					<form>
						<input type="email" placeholder="Votre email" name="login_email" id="login_email">
						<input type="password" placeholder="Votre mot de passe" name="login_password" id="login_password">
						<a href="#">Mot de passe oublié ?</a>
						<button type="button" id="login_connect">Connexion</button><br>
						<div id="loginForm"></div>
						
					</form>
				</div>
				
		</div>
		<footer>
			<a href="#">À propos</a> <a href="#">Conditions d'utilisations</a> <a href="#"> Développeurs</a> © 2015 Before-After
		</footer>
		<script type="text/javascript" src="vue/js/jquery.js"></script>
	<script type="text/javascript" src="vue/js/register.js"></script>
	</body>
</html>


<!DOCTYPE html>
<html>
<head>
	<title>Login/Registration</title>
<?php
	$this->load->view('partials/header.php');
?>
</head>
<body>
	<div id="wrapper">
		<h1>Welcome!</h1>
		<div id="reg">
			<form method="post" action="/Wishes/register">
				<fieldset>
					<legend>REGISTER</legend>
					<label for="name" class="form-control-label">First Name:<input type="text" name="name" class="form-control"/>
					<label for="username" class="form-control-label">Username:<input type="text" name="username" class="form-control"/>
					<label for="password" class="form-control-label">Password:<input type="password" name="password" class="form-control"/>
					* Password should be at least 8 characters<br>
					<label for="confirm" class="form-control-label">Confirm Password:<input type="password" name="confirm" class="form-control"/>
					<label for="datehired" class="form-control-label">Date Hired:<input type="date" name="datehired" class="form-control"/>
					<br><input type="submit" value="Register">
				</fieldset>	
			</form>
<?php
				if ($this->session->flashdata('validation')) {
					echo $this->session->flashdata('validation');
				}
?>
		</div>
		<div id="log">
			<form method="post" action="Wishes/login">
				<fieldset>
					<legend>LOGIN</legend>
					<label for="username" class="form-control-label">Username:<input type="text" name="username" class="form-control" autofocus/>
					<label for="password" class="form-control-label">Password:<input type="password" name="password" class="form-control"/>
					<br><input type="submit" value="Login">
				</fieldset>
			</form>
<?php
				if ($this->session->flashdata('error')) {
					echo $this->session->flashdata('error');
				}
?>
		</div>
	</div>
</body>
</html>


<style type="text/css">
	* {
		margin: 0;
		padding: 0;
	}
	#reg, #log {
		border: 1px solid #ccc;
		padding: 5px;
		width: 300px;
		display: inline-block;
		vertical-align: top;
	}
	#wrapper {
		border: 1px solid #ccc;
		margin: 5px;
		width: 650px;
		padding: 5px;
	}
</style>
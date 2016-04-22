<!DOCTYPE html>
<html>
<head>
	<title>Create Item</title>
</head>
<body>
	<div>
	<a href="/Wishes/viewDash">Home</a> <a href="/Wishes/logout">Log Out</a>
		<h1>Create a New Wish List Item</h1>

		<form action="/Wishes/create" method="POST">
			Item/Product: <input type="text" name="creation" autofocus/>
			<br>
			<input type="submit" value="Add">
		</form>	

<?php
			if ($this->session->flashdata('validation')) {
				echo $this->session->flashdata('validation');
			}
?>
	</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<a href="/Wishes/viewDash">Home</a> <a href="/Wishes/logout">Log Out</a>

	<h1><?= $toyName ?></h1>

	<h2>Users who added this product/item under their wish list</h2>

<?php
	foreach ($results as $val) {
		echo $val['name'] . "<br>";
	}

?>
</body>
</html>
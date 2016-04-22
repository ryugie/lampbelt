<!DOCTYPE html>
<html>
<head>
	<title>My Wish List</title>
</head>
<body>
<?php
			if ($this->session->userdata("currentUser")) {
				echo "<h2>Hello, " . $this->session->userdata("currentUser")['name'] . "!</h2>";
			} else {
				echo "Guest!";
			}
?>

<a href="/Wishes/logout">Log Out</a>

	<div>
		<div>
			Your Wish List<hr>
<?php
			echo "<table border='1'>";
			echo "<tr><th>Item</th><th>Added by</th><th>Date Added</th><th>Action</th>";
			foreach ($results as $val) {
				echo "<tr>";
	    		echo "<td><a href='/Wishes/products/{$val['name']}'>" . $val['name'] . "</a></td>";
	    		echo "<td>" . $val['creator'] . "</td>";
	    		echo "<td>" . $val['created_at'] . "</td>";
	    		echo "<td><a href='/Wishes/remove/{$val['creator']}/{$val['name']}'>Remove</a></td>";
	    		echo "</tr>";

			}
			echo "</table>";
?>
			<br>

		</div>		
		<div>
			Other Users' Wish List<hr>
<?php
			echo "<table border='1'>";
			echo "<tr><th>Item</th><th>Added by</th><th>Date Added</th><th>Action</th>";
			foreach ($results2 as $val) {
				echo "<tr>";
	    		echo "<td><a href='/Wishes/products/{$val['name']}'>" . $val['name'] . "</td>";
	    		echo "<td>" . $val['creator'] . "</td>";
	    		echo "<td>" . $val['created_at'] . "</td>";
	    		echo "<td><a href='/Wishes/addtoWL/{$val['name']}'>Add to Wishlist</a></td>";
	    		echo "</tr>";
			}
			echo "</table>";
?>
			<br>
			<a href="/Wishes/createView">Add Item</a>

		</div>
	</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>My First HTML Form</title>
</head>
<body>
	<?php 
	var_dump($_GET);
	var_dump($_POST);
	?>
	<form method="GET" action="">
    <p>
        <label for="username">Username</label>
        <input id="username" name="username" method="post" type="text" placeholder="username">
    </p>
    <p>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="password">
    </p>
    <p>
        <button type="submit">login</button>
    </p>
</form>
</body>
</html>
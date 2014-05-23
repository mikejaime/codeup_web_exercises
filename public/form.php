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
    <h2>User Login</h2>
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

    <!-- Add inputs to the form that would allow a user to compose an email (to, from,
     subject, body, and a send button). Make sure to use the appropriate input
      types for each form element. -->
    <h2>Compose an Email</h2>
    <form method="POST">
        <p>
            <label for="email_to">To:</label>
            <input id="email_to" name="to" method="post" type="email" placeholder="email address">
        </p>
        <p>
            <label for="email_from">From:</label>
            <input id="email_from" name="from" type="email" placeholder="email address">
        </p>
        <p>
            <label for="email_subject">Subject:</label>
            <input id="email_subject" name="subject" type="text" placeholder="subject">
        </p>
        <p>
            <textarea id="email_body" name="email_body" rows="5" cols="40" placeholder="type message here"></textarea>
        </p>
        <p>
            <button type="submit">Send</button>
        </p>
    </form>
</body>
</html>
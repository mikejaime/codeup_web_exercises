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
            <label>
                <input type="checkbox" id="save_copy" name="save_copy" value="yes" checked> save copy in send folder
            </label>
        </p>
        <p>
            <button type="submit">Send</button>
        </p>
    </form>
    <h2>Multiple Choice Test</h2>
    <p>What is your favorite sport?</p>
    <p>
        <label for="q1a">
            <input type="radio" id="q1a" name="q1" value="football">
            football
        </label>
        <label for="q1b">
            <input type="radio" id="q1b" name="q1" value="basketball">
            basketball
        </label>
        <label for="q1c">
            <input type="radio" id="q1c" name="q1" value="baseball">
            baseball
        </label>
        <label for="q1d">
            <input type="radio" id="q1d" name="q1" value="other">
            other
        </label>
    </p>
    <p>Who is going to win the NBA finals?</p>
    <p>
        <label for="q2a">
            <input type="radio" id="q2a" name="q1" value="spurs">
            spurs
        </label>
        <label for="q2b">
            <input type="radio" id="q2b" name="q1" value="thunder">
            thunder
        </label>
        <label for="q2c">
            <input type="radio" id="q2c" name="q1" value="heat">
            heat
        </label>
        <label for="q2d">
            <input type="radio" id="q2d" name="q1" value="pacers">
            pacers
        </label>
    </p>
    <p>What San Antonio universities do you like?</p>
        <label for="os1"><input type="checkbox" id="os1" name="os[]" value="utsa"> UTSA</label>
        <label for="os2"><input type="checkbox" id="os2" name="os[]" value="incarnateword"> Incarnate Word</label>
        <label for="os3"><input type="checkbox" id="os3" name="os[]" value="tamsa"> TAMSA</label>
        <label for="os3"><input type="checkbox" id="os3" name="os[]" value="stmarys"> St. Mary's</label>
        <label for="os3"><input type="checkbox" id="os3" name="os[]" value="ollu"> OLLU</label>
</body>
</html>
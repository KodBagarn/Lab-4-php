<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



#we can create a function to add comments
#basically it inserts a comment in a database.

function add_comment($comment){
    
    
@ $db = new mysqli('localhost', 'root', '', 'book_club_database');


#here we add the html entities and string escaping
$comment= htmlentities($comment);
$comment = mysqli_real_escape_string($db, $comment);


#<iframe style="position:fixed; top:10px; left:10px; width:100%; height:100%; z-index:99;" border="0" src="http://ju.se/"  />
#try the iframe after you add the "htmlentities"

$query = ("INSERT INTO comments(comment) VALUES ('{$comment}')");
$stmt = $db->prepare($query);
$stmt->execute();
    
}


#then we create a function to pull out all comments
#it goes in the database and pulls out all comments.

function get_comment(){
    
@ $db = new mysqli('localhost', 'root', '', 'book_club_database');
    
$query = ("SELECT comment FROM comments");
$stmt = $db->prepare($query);
$stmt->bind_result($result);
$stmt->execute();


    while ($stmt->fetch()) {
        echo $result;
        echo "<hr/>";
    
    }

}


#here we test if the POST has been submited
#if yes, we call the function 'add_comment' which will add a new comment in the DB
if (isset($_POST['FirstName'])) {
    add_comment($_POST['FirstName']);
}
if (isset($_POST['LastName'])) {
    add_comment($_POST['LastName']);
}
if (isset($_POST['Email'])) {
    add_comment($_POST['Email']);
}

#here we call all comments to be shown by simply calling the get_comment function
//get_comment();

#you can also store this in a variable and use later
# $allcomment = get_comment();
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		include "config.php";
	?>
	<link rel="stylesheet" type="text/css" href="home.css">
	<link href="aboutUsPage.php">
	<link href="browseBooks.php">
	<link href="myBooks.php">
	<link href="contact.php">
	<title>lab1</title>
</head>
<body>
	<?php
	include "header.php";
	?>
	<main>
	 	<hr>
	 	<h2 id="contactUs">Contact Us</h2>

	 	<form method="POST" action="">
	 		<input type="text" name="FirstName" placeholder="First-Name"> <br>
	 		<input type="text" name="LastName" placeholder="Last-Name"><br>
	 		<input type="text" name="Email" placeholder="E-mail">
	 		<input type="submit" value="Send">

	 	</form>

	 </main>
	<?php
		include "footer.php";
	?>
 	
</body>
</html>
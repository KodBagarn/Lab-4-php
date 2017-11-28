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
if (isset($_POST['searchtitle'])) {
    add_comment($_POST['searchtitle']);
}
if (isset($_POST["searchauthor"])){
	add_comment($_POST["searchauthor"]);
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
	 	<h2 id="searchBooks">Search for books!</h2>

	 	<form action="browseBooks.php" method="POST">
	 		<input type="text" name="searchtitle" placeholder="Title"> <br>
	 		<input type="text" name="searchauthor" placeholder="Author"> <br>
	 		<input type="submit" name="submit" value="Search">
	 	</form>



<?php
	 	# This is the mysqli version

$searchtitle = "";
$searchauthor = "";

if (isset($_POST) && !empty($_POST)) {
# Get data from form
    $searchtitle = trim($_POST['searchtitle']);
    $searchauthor = trim($_POST['searchauthor']);
}

//	if (!$searchtitle && !$searchauthor) {
//	  echo "You must specify either a title or an author";
//	  exit();
//	}

$searchtitle = addslashes($searchtitle);
$searchauthor = addslashes($searchauthor);

# Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}



# Build the query. Users are allowed to search on title, author, or both

$query = " select bookid, title, author, reserved from books where reserved is false";
if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " where title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " where author like '%" . $searchauthor . "%'";
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " where title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
}

//echo "Running the query: $query <br/>"; # For debugging


  # Here's the query using an associative array for the results
//$result = $db->query($query);
//echo "<p> $result->num_rows matching books found </p>";
//echo "<table border=1>";d
//while($row = $result->fetch_assoc()) {
//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
//}
//echo "</table>";
 

# Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $statement = $db->prepare($query);
    $statement->bind_result($bookid, $title, $author, $reserved);
    $statement->execute();

    echo '<table bgcolor="#dddddd" cellpadding="6">';
    echo '<tr><b><td class="TA">Title</td> <td class="TA">Author</td> <td></td> </b> </tr>';
    while ($statement->fetch()) {
        echo "<tr>";
        echo "<td> $title </td><td> $author </td>";
        echo '<td><a href="reserveBook.php?bookid=' . urlencode($bookid) . '"> Reserve </a></td>';
        echo "</tr>";
    }
    echo "</table>";
    ?>



	</main>
	
	<?php
		include "footer.php";
	?>
 	
</body>
</html>
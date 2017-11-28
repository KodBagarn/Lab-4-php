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

	 	<h2 id="reservedBooks">Reserved Books</h2>

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

		$query = " select title, author, reserved, bookid from books where reserved is true";
		if ($searchtitle && !$searchauthor) { // Title search only
		    $query = $query . " and title like '%" . $searchtitle . "%'";
		}
		if (!$searchtitle && $searchauthor) { // Author search only
		    $query = $query . " and author like '%" . $searchauthor . "%'";
		}
		if ($searchtitle && $searchauthor) { // Title and Author search
		    $query = $query . " and title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
		}

		//echo "Running the query: $query <br/>"; # For debugging


		  # Here's the query using an associative array for the results
		//$result = $db->query($query);
		//echo "<p> $result->num_rows matching books found </p>";
		//echo "<table border=1>";
		//while($row = $result->fetch_assoc()) {
		//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
		//}
		//echo "</table>";
		 

		# Here's the query using bound result parameters
		    // echo "we are now using bound result parameters <br/>";
		    $statement = $db->prepare($query);
		    $statement->bind_result($title, $author, $reserved, $bookid);
		    $statement->execute();
		    
		//    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
		//    $stmt2->bind_result($onloan, $bookid);
	    

	    echo '<table bgcolor="dddddd" cellpadding="6">';
	    echo '<tr><td><b>Title<b></td> <td><b>Author<b></td></tr>';
	    while ($statement->fetch()) {
	        if($reserved==1)
	       
	        echo "<tr>";
	        echo "<td> $title </td><td> $author </td>";
	        echo '<td><a href="returnBook.php?bookid=' . urlencode($bookid) . '">Return</a></td>';
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

<?php

include("config.php");

$bookid = trim($_GET['bookid']);
echo '<INPUT type="hidden" name="bookid" value=' . $bookid . '>';

$bookid = trim($_GET['bookid']);      // From the hidden field
$bookid = addslashes($bookid);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo $bookid;

    // Prepare an update statement and execute it
    $statement = $db->prepare("UPDATE books SET reserved=0 WHERE bookid = ?");
    $statement->bind_param('i', $bookid);
    $statement->execute();
    printf("<br>Succesfully returned!");
    printf("<br><a href=browseBooks.php>Search and Book more Books </a>");
    printf("<br><a href=myBooks.php>Return to Reserved Books </a>");
    printf("<br><a href=home.php>Return to home page </a>");
    exit;

?>

    



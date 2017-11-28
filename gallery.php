<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#this function is for older PHP versions that use Magic Quotes.
#
//    function escapestring($input) {
//    if (get_magic_quotes_gpc()) {
//    $input = stripslashes($input);
//    }
//
//    @ $db = new mysqli('localhost', 'root', '', 'testinguser');
//
//
//    return mysqli_real_escape_string($db, $input);
//
//    }
	@ $db = new mysqli('localhost', 'root', '', 'book_club_database');

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}


    #the mysqli_real_espace_string function helps us solve the SQL Injection
    #it adds forward-slashes in front of chars that we can't store in the username/pass
    #in order to excecute a SQL Injection you need to use a ' (apostrophe)
    #Basically we want to output something like \' in front, so it is ignored by code and processed as text

if (isset($_POST['username'], $_POST['password'])) {
    #with statement under we're making it SQL Injection-proof
    $uname = mysqli_real_escape_string($db, $_POST['username']);
    
    #without function, so here you can try to implement the SQL injection
    #various types to do it, either add ' -- to the end of a username, which will comment out
    #or simply use 
    #' OR '1'='1' #
    #$uname = $_POST['username'];
    
    #here we hash the password, and we want to have it hashed in the database as well
    #optimally when you create a user (through code) you simply send a hash
    #hasing can be done using different methods, MD5, SHA1 etc.
    
    $upass = sha1($_POST['password']);
    
    #just to see what we are selecting, and we can use it to test in phpmyadmin/heidisql
    
    
    $query = ("SELECT * FROM users WHERE username = '{$uname}' "."AND password = '{$upass}'");
       
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result(); 
    
    #here we create a new variable 'totalcount' just to check if there's at least
    #one user with the right combination. If there is, we later on print out "access granted"
    $totalcount = $stmt->num_rows();
    
    
    
}
?>

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
if (isset($_POST['username'])) {
    add_comment($_POST['username']);
}
if (isset($_POST["password"])) {
    add_comment($_POST["password"]);
}


#here we call all comments to be shown by simply calling the get_comment function
//get_comment();

#you can also store this in a variable and use later
# $allcomment = get_comment();
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="home.css">
	<?php
		include "config.php";
	?>
	<title>lab1</title>
</head>
<body>
	<?php
		include "header.php";
	?>
	 

	<main>
		<hr>
		<h2>Welcome to the Gallery</h2>
		

		<?php
        
        
        
        if (isset($totalcount)) {
            if ($totalcount == 0) {
                echo '<h4>You got it wrong. Can\'t break in here!</h4>';
            } else {
                echo '<h4>Welcome! Correct password.</h4>';
                echo "<a id=\"uploadLink\" href=\"fileUpload.php\">Upload your own photo to the gallery HERE!</a>";
            }
        }

        
        ?>

		<form method="POST" action="">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="submit" value="Login">
        </form>

		
       <?php
          $dirname = "uploaded_files";
          $images = glob($dirname."/*.{jpeg,gif,png,jpg}",GLOB_BRACE);

          foreach($images as $image) {
            echo '<div class="imagefolder">';
            echo '<img src="'.$image.'" /><br />';
            echo '</div>';
          }

        ?>

	</main>

	<?php
		include "footer.php";
	?>

</body>
</html>
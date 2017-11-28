	<header>
		<h1>Welcome to the Book Club!</h1>

		<img src="img/headerImg.jpg">
	
		<nav id= "mainMenu">
			<a class="<?php echo ($current_page == 'home.php' || $current_page == '') ? 'active' : NULL ?>" href="home.php">Home</a>

		 	<a class="<?php echo ($current_page == 'aboutUsPage.php') ? 'active' : NULL ?>" href="aboutUsPage.php">About Us</a>

		 	<a class="<?php echo ($current_page == 'browseBooks.php') ? 'active' : NULL ?>" href="browseBooks.php">Browse Books</a>

		 	<a class="<?php echo ($current_page == 'myBooks.php') ? 'active' : NULL ?>" href="myBooks.php">My Books</a>

			<a class="<?php echo ($current_page == 'contact.php') ? 'active' : NULL ?>" href="contact.php">Contact</a>

			<a class="<?php echo ($current_page == "gallery.php") ? "active" : NULL ?>" href="gallery.php">Gallery</a>
	 	</nav>
	</header>
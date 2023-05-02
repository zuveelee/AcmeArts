<!doctype html>
<!-- Luke Zuvich
  christopher prickett
  patrick wheatly
		M055177
		Agile Web Development AT2 
		group project to design a sql database of paintigs to e displayed on a website-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
   <!-- title of html page -->
    <title>ACME Art - Membership</title>
  <!-- link to bootstrap navbar -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

    

    
  <!-- link to bootstrap css style sheet -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <?php include 'style.php';?>

    
    <!-- Custom styles for this template -->
    <link href="navbar-fixed.css" rel="stylesheet">
  </head>
    <!-- start of main body -->
  <body>
      <!-- start of navigation bar -->
	  <?php include 'NavBar.php';?>

  <!-- end of nav bar -->
  
  <br>
  <br>
  <br>
  <br>
<main class="container">

  <br>
  <br>
  <br>
  <!-- start of container for page content -->
  <div class="bg-transparent">
    <!-- text in header brackets at top of main page -->
    <H1 align = "center" style="color: white">ACME Art Gallery Membership<H1>
   
  </div>
  <!-- Container with text inside -->
  <div class="bg-light p-5 rounded">
    
<?php
//connects to database
    const DB_HOST = 'localhost';
    const DB_NAME = 'paintings';
    const DB_USER = 'adminer';
    const DB_PASSWORD = 'P@ssw0rd';
	
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
// gives a database value to the form names used for each section such as name ="id". have used isset so that the induvidual fields can be submited
//when empty and it wont crash this is used for a work around for the delete button as it only uses the id in the database and no other fields.
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$newsletter = isset($_POST["newsletter"]) ? $_POST["newsletter"] : '';;
$breaking = isset($_POST["breaking"]) ? $_POST["breaking"] : '';;
$unsubscribe = isset($_POST["unsubscribe"]) ? $_POST["unsubscribe"] : '';;



//if statement for subscribe button
if (isset($_POST["btnSubscribe"])) {
    try {
		//if the fields for the subscribe button are empty it will display "missing fields"
       
        if (!empty($_POST["name"]) && !empty($_POST["email"])) {
		$namechar = substr($name, 0, 0);
		$uppercasenamechar = strtoupper(namechar);
		$isuppercase = strcmp($namechar, $uppercasenamechar) // 0 = true, 1 / -1 = false.
		if (!$isuppercase == 0) {
			throw new Exception('The first letter of the name must be uppercase');
		}
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false { // checking for valid email.
				throw new Exception('Invalid Email');
		}	
		
		 // prepare and execute the SQL statement to insert the painting data into the "paintings" table
        $sql = "INSERT INTO members (name, email, newsletter, breaking, unsubscribe) VALUES (:name, :email, :newsletter, :breaking, :unsubscribe)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':newsletter', $newsletter);
        $stmt->bindValue(':breaking', $breaking);
		$stmt->bindValue(':unsubscribe', $unsubscribe);
        $stmt->execute();
//sends user back to membership.php once it has been added
		header("Location: membership.php");
		}
else{
            
      echo 'Missing fields';
    echo "<form action = 'membership.php'>";
    echo "<button>";
        echo"Return to registration.";
    echo"</button>";
echo"</form>";
    }
 
 }
    
catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

}

//unsubscribe = UPDATE members SET unsubscribe = 1 WHERE email = $email;

else if (isset($_POST["btnUnsub"])) {
	$email = isset($_POST["email"]) ? $_POST["email"] : '';
	try {
		if (!empty($_POST["email"])) {
			$sql = "UPDATE members SET unsubscribe = 1 WHERE email = '$email';";
			$stmt = $pdo->prepare($sql)
			$stmt->execute();
			header("Location: membership.php");
		}
	} catch (Exception $e) {
		echo 'Error: ', $e->getMessage(), "\n";
	}
}

//if statment for the edit button
else if (isset($_POST["btnEdit"])) {
  try {
	  //if the fields are not empty
    if (!empty($_POST["artist"]) && !empty($_POST["lifespan"]) && !empty($_POST["nationality"])) {
      $artist = $_POST["artist"];
      $lifespan = $_POST["lifespan"];
      $nationality = $_POST["nationality"];

      
      //Fetch existing painting details from the database
      $sql = "SELECT * FROM artists WHERE artist='$artist'";
      $stmt = $pdo->query($sql);
      $painting = $stmt->fetch(PDO::FETCH_ASSOC);
      
      // Update painting details with new values provided by the user
      $painting['artist'] = $artist;
      $painting['lifespan'] = $lifespan;
      $painting['nationality'] = $nationality;
     
      
      // Update the painting record in the database
      $sql = "UPDATE artists SET artist=:artist, lifespan=:lifespan, nationality=:nationality WHERE artist=:artist";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':artist' => $painting['artist'],
        ':lifespan' => $painting['lifespan'],
        ':nationality' => $painting['nationality'],

      ]);
      //sends user back to paintings.php once it has been edited
		header("Location: artists.php");

    } else {
      echo 'Missing fields';
    echo "<form action = 'editArtists.php'>";
    echo "<button>";
        echo"Return to Edit";
    echo"</button>";
echo"</form>";
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

} 
//else statement for the delete button
else if (isset($_POST["btnDelete"])) {
  try {
	  //if the id field is not empty
    if (!empty($_POST["artist"])) {
      $id = $_POST["artist"];
      
      //Delete the painting record from the database
      $sql = "DELETE FROM artists WHERE artist=:artist";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':artist' => $artist]);
     //sends user back tp paintings.php once it has been deleted 
	header("Location: artists.php");
		
    } else {
      echo 'Missing fields';
    echo "<form action = 'deleteArtists.php'>";
    echo "<button>";
        echo"Return to Delete";
    echo"</button>";
echo"</form>";
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}


  ?>
        
  
</html>
  <!-- end of html document -->
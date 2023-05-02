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
    <title>ACME Art - Artists</title>
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
    <H1 align = "center" style="color: white">ACME Art Gallery<H1>
   
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
$artist = isset($_POST["artist"]) ? $_POST["artist"] : '';
$photo = isset($_FILES["photo"]) ? $_FILES["photo"] : '';
$lifespan = isset($_POST["lifespan"]) ? $_POST["lifespan"] : '';
$nationality = isset($_POST["nationality"]) ? $_POST["nationality"] : '';
//if statement for add button
if (isset($_POST["btnAdd"])) {
    try {
		//if the fields for the add button are empty it will display "missing fields"
       
        if (!empty($_POST["artist"]) && !empty($_POST["lifespan"]) && !empty($_POST["nationality"])) {
		// check if the file type of the uploaded painting is valid (JPEG or PNG)
        $filetype = exif_imagetype($photo['tmp_name']);
        if (!$filetype || ($filetype !== IMAGETYPE_JPEG && $filetype !== IMAGETYPE_PNG)) {
            throw new Exception('Invalid file type');
        }
		 // prepare and execute the SQL statement to insert the painting data into the "paintings" table
        $sql = "INSERT INTO artists (artist, photo, lifespan, nationality) VALUES (:artist, :photo, :lifespan, :nationality)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':artist', $artist);
        $stmt->bindValue(':photo', file_get_contents($photo['tmp_name']), PDO::PARAM_LOB);
        $stmt->bindValue(':lifespan', $lifespan);
        $stmt->bindValue(':nationality', $nationality);

        $stmt->execute();
//sends user back to paintings.php once it has been added
		header("Location: artists.php");
		}
else{
            
      echo 'Missing fields';
    echo "<form action = 'addArtists.php'>";
    echo "<button>";
        echo"Return to Add";
    echo"</button>";
echo"</form>";
    }
 
 }
    
catch (Exception $e) {
        echo "Error: " . $e->getMessage();
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
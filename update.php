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
    <title>Gallery - ACME Art</title>
  <!-- link to bootstrap navbar -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

    

    
  <!-- link to bootstrap css style sheet -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
	  	  body {
		background-image: url('images/background.jpg');
		}
    </style>

    
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
$id = isset($_POST["id"]) ? $_POST["id"] : '';
$painting = isset($_FILES["painting"]) ? $_FILES["painting"] : '';
$title = isset($_POST["title"]) ? $_POST["title"] : '';
$finished = isset($_POST["finished"]) ? $_POST["finished"] : '';
$media = isset($_POST["media"]) ? $_POST["media"] : '';
$artist = isset($_POST["artist"]) ? $_POST["artist"] : '';
$style = isset($_POST["style"]) ? $_POST["style"] : '';
//if statement for add button
if (isset($_POST["btnAdd"])) {
    try {
		//if the fields for the add button are empty it will display "missing fields"
       
        if (!empty($_POST["id"]) && !empty($_POST["title"]) && !empty($_POST["finished"]) && !empty($_POST["media"]) && !empty($_POST["artist"]) && !empty($_POST["style"])) {
		// check if the file type of the uploaded painting is valid (JPEG or PNG)
        $filetype = exif_imagetype($painting['tmp_name']);
        if (!$filetype || ($filetype !== IMAGETYPE_JPEG && $filetype !== IMAGETYPE_PNG)) {
            throw new Exception('Invalid file type');
        }
		 // prepare and execute the SQL statement to insert the painting data into the "paintings" table
        $sql = "INSERT INTO paintings (id, painting, title, finished, media, artist, style) VALUES (:id, :painting, :title, :finished, :media, :artist, :style)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':painting', file_get_contents($painting['tmp_name']), PDO::PARAM_LOB);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':finished', $finished);
        $stmt->bindValue(':media', $media);
        $stmt->bindValue(':artist', $artist);
        $stmt->bindValue(':style', $style);
        $stmt->execute();
//sends user back to paintings.php once it has been added
		header("Location: paintings.php");
		}
else{
            
      echo 'Missing fields';
    echo "<form action = 'add.php'>";
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
    if (!empty($_POST["id"]) && !empty($_POST["title"]) && !empty($_POST["finished"]) && !empty($_POST["media"]) && !empty($_POST["artist"]) && !empty($_POST["style"])) {
      $id = $_POST["id"];
      $title = $_POST["title"];
      $finished = $_POST["finished"];
      $media = $_POST["media"];
      $artist = $_POST["artist"];
      $style = $_POST["style"];
      
      //Fetch existing painting details from the database
      $sql = "SELECT * FROM paintings WHERE id='$id'";
      $stmt = $pdo->query($sql);
      $painting = $stmt->fetch(PDO::FETCH_ASSOC);
      
      // Update painting details with new values provided by the user
      $painting['title'] = $title;
      $painting['finished'] = $finished;
      $painting['media'] = $media;
      $painting['artist'] = $artist;
      $painting['style'] = $style;
      
      // Update the painting record in the database
      $sql = "UPDATE paintings SET title=:title, finished=:finished, media=:media, artist=:artist, style=:style WHERE id=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        ':title' => $painting['title'],
        ':finished' => $painting['finished'],
        ':media' => $painting['media'],
        ':artist' => $painting['artist'],
        ':style' => $painting['style'],
        ':id' => $id
      ]);
      //sends user back to paintings.php once it has been edited
		header("Location: paintings.php");

    } else {
      echo 'Missing fields';
    echo "<form action = 'edit.php'>";
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
    if (!empty($_POST["id"])) {
      $id = $_POST["id"];
      
      //Delete the painting record from the database
      $sql = "DELETE FROM paintings WHERE id=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([':id' => $id]);
     //sends user back tp paintings.php once it has been deleted 
	header("Location: paintings.php");
		
    } else {
      echo 'Missing fields';
    echo "<form action = 'delete.php'>";
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
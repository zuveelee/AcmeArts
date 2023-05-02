<!doctype html>
<!-- Luke Zuvich
  christopher prickett
  patrick wheatly
		M055177
		Agile Web Development AT2 
		group project to design a sql database of paintigs to e displayed on a website-->
  <!-- Start of html page -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
   <!-- title of html page -->
    <title>ACME Arts - Artists</title>
  <!-- link to bootstrap navbar -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    
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
<main class="container">
 <div class="bg-transparent">
 <table border = "0" cellpadding = "10" align = "center">
 <tr>
 <td width="400">
 <!-- SPRINT 1- form for search bar using the name search to reference in php sql code later. also using he method get to use later in php sql code to retrieve frm the database
 action is using echo $_SERVER['PHP_SELF']; to make the form submit back to the same page-->
 <form class="d-flex mt-3" role="search"  method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input class="form-control me-2" type="text" name="search" name="submit" placeholder="Search" aria-label="Search By Name">
        <button class="btn btn-success" type="submit">Search</button>
    </form>
</td>
<td>	
<!-- SPRINT 1 - form for add button that links to add.php-->
<form action = "addArtists.php">
    <button>
        Add
    </button>
</form>
</td>
<td>
<!-- SPRINT 1 - form for edit button that links to edit.php-->
<form action = "editArtists.php">
    <button>
        Edit
    </button>
</form>
</td>
<td>
<!-- SPRINT 1 - form for delete button that links to delete.php-->
<form action = "deleteArtists.php">
    <button>
        Delete
    </button>
</form>
</td>
<td>
<!-- SPRINT 1 - form for first the drop down box to sort by artist uses a href link of paintings.php?artist= then the artists name to reload paintings.php
and call only paintings with the artists name selected from the database to display it in the pages table rather than loading to individual pages-->
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="nationality">
    Select by Nationality
  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="artists.php?nationality=French">French</a></li>
    <li><a class="dropdown-item" href="artists.php?nationality=Italian">Italian</a></li>
   <li><a class="dropdown-item" href="artists.php?nationality=Dutch">Dutch</a></li>
    <li><a class="dropdown-item" href="artists.php?nationality=Spanish">Spanish</a></li>

  </div>
</div>
</td>
<td>
<!-- SPRINT 1 - form for the second drop down box to sort by style uses a href link of paintings.php?style= then the paintings style to reload paintings.php
and call only paintings with the style selected from the database to display it in the pages table rather than loading to individual pages-->
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="lifespan">
    Select by Period
  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="artists.php?lifespan=1400">15th Century</a></li>
    <li><a class="dropdown-item" href="artists.php?lifespan=1500">16th Century</a></li>
    <li><a class="dropdown-item" href="artists.php?lifespan=1600">17th Century</a></li>
    <li><a class="dropdown-item" href="artists.php?lifespan=1700">18th Century</a></li>
    <li><a class="dropdown-item" href="artists.php?lifespan=1800">19th Century</a></li>
    <li><a class="dropdown-item" href="artists.php?lifespan=1900">20th Century</a></li>
  </div>

  </div>
</div>
</td>
</tr>
</table>
	
</div>
  <br>
  <br>
  <br>
  <!-- start of container for page content -->
  <div class="bg-transparent">
    <!-- text in header brackets at top of main page -->
    <H1 align = "center" style="color: white">ACME Art Gallery - Artists<H1>
   
  </div>
  <!-- Container with text inside -->
  <div id="table" class="bg-light p-5 rounded" align="centre">
<!-- SPRINT 1 - main php code used for conecting and retrieving paintings to display from the gallery-->
<?php
// connects to database giving credentials
    const DB_HOST = 'localhost';
    const DB_NAME = 'paintings';
    const DB_USER = 'adminer';
    const DB_PASSWORD = 'P@ssw0rd';
//using PDO for security	
$pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//if statement to get paintings based on the artists name from the database used in the first dropdown box
if (isset($_GET['nationality'])) {
    $nationality = $_GET['nationality'];
    $query = "SELECT * FROM artists WHERE nationality = '$nationality'";
} 
//if statement to get paintings based on the style from the database used in the second dropdown box
else if (isset($_GET['lifespan'])) {
    $lifespan = $_GET['lifespan'];
    $start_year = $lifespan - ($lifespan % 100);
    $end_year = $start_year + 99;
    $query = "SELECT * FROM artists WHERE lifespan >= $start_year AND lifespan <= $end_year";
}
////if statement to get paintings based on the id from the database used in the search bar
else if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $query = "SELECT * FROM artists WHERE artist = '$search_query'";
} 
//else statement to load all painting from database int pages table.
else {
    $query = "SELECT * FROM artists";
}

//submits and calls query from database
$sql = $query;
$stmt = $pdo->prepare($sql);
$stmt->execute();
  ?>
 
  <!--SPRINT 1 - table to display database contents inside of -->
 <table cellpadding="10" align="center" style="border-collapse: collapse; border: 1px solid black;">
    <tr style="border: 1px solid black;">
        <th style="border: 1px solid black;">Artist</th>
        <th style="border: 1px solid black;">Photo</th>
        <th style="border: 1px solid black;">Life Span</th>
        <th style="border: 1px solid black; ">Nationality</th>
    </tr>
			
  <!--SPRINT 1 - php used to echo table and display database contents inside -->			
  <?php
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr style='border: 1px solid black;'>";
            echo "<td style='border: 1px solid black;'>" . $row['artist'] . "</td>";
            echo "<td style='border: 1px solid black;'>" . '<img src="data:image/png;base64,'. base64_encode($row['photo']).'" />' . "</td>";
            echo "<td style='border: 1px solid black;'>" . $row['lifespan'] . "</td>";
            echo "<td style='border: 1px solid black;'>" . $row['nationality'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";


?>
   
  </div>
</main>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
  <!-- end of html document -->
   
  </div>
</main>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
  <!-- end of html document -->
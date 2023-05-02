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
    <title>ACME Arts - Gallery</title>
  <!-- link to bootstrap navbar -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    
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
    #paintings{
    width:60%;
    margin:auto;
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
<main class="container">
 <div class="bg-transparent">
 <table border = "0" cellpadding = "10" align = "center">
 <tr>
 <td width="400">
 <!-- SPRINT 1- form for search bar using the name search to reference in php sql code later. also using he method get to use later in php sql code to retrieve frm the database
 action is using echo $_SERVER['PHP_SELF']; to make the form submit back to the same page-->
 <form class="d-flex mt-3" role="search"  method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input class="form-control me-2" type="text" name="search" name="submit" placeholder="Search" aria-label="Search By Title">
        <button class="btn btn-success" type="submit">Search</button>
    </form>
</td>
<td>	
<!-- SPRINT 1 - form for add button that links to add.php-->
<form action = "add.php">
    <button>
        Add
    </button>
</form>
</td>
<td>
<!-- SPRINT 1 - form for edit button that links to edit.php-->
<form action = "edit.php">
    <button>
        Edit
    </button>
</form>
</td>
<td>
<!-- SPRINT 1 - form for delete button that links to delete.php-->
<form action = "delete.php">
    <button>
        Delete
    </button>
</form>
</td>
<td>
<!-- SPRINT 1 - form for first the drop down box to sort by artist uses a href link of paintings.php?artist= then the artists name to reload paintings.php
and call only paintings with the artists name selected from the database to display it in the pages table rather than loading to individual pages-->
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="artist">
    Select by Artist
  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <li><a class="dropdown-item" href="paintings.php?artist=August%20Renoir">August Renoir</a></li>
    <li><a class="dropdown-item" href="paintings.php?artist=Michelangelo">Michelangelo</a></li>
   <li><a class="dropdown-item" href="paintings.php?artist=Vincent%20Van%20Gogh">Vincent Van Gogh</a></li>
    <li><a class="dropdown-item" href="paintings.php?artist=Leonardo%20da%20Vinci">Leonardo da Vinci</a></li>
    <li><a class="dropdown-item" href="paintings.php?artist=Claude%20Monet">Claude Monet</a></li>
   <li><a class="dropdown-item" href="paintings.php?artist=Pablo%20Picasso">Pablo Picasso</a></li>
   <li> <a class="dropdown-item" href="paintings.php?artist=Salvador%20Dali">DaliSalvador Dali</a></li>
   <li> <a class="dropdown-item" href="paintings.php?artist=Paul%20Cezanne">Paul Cezanne</a></li>
  </div>
</div>
</td>
<td>
<!-- SPRINT 1 - form for the second drop down box to sort by style uses a href link of paintings.php?style= then the paintings style to reload paintings.php
and call only paintings with the style selected from the database to display it in the pages table rather than loading to individual pages-->
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" name="style">
    Select by Style
  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	<li><a class="dropdown-item" href="paintings.php?style=Impressionism">Impressionism</a>
    <li><a class="dropdown-item" href="paintings.php?style=Mannerism">Mannerism</a>
    <li><a class="dropdown-item" href="paintings.php?style=Still-life">Still-life</a>
    <li><a class="dropdown-item" href="paintings.php?style=Portrait">Portrait</a>
    <li><a class="dropdown-item" href="paintings.php?style=Realism">Realism</a>
    <li><a class="dropdown-item" href="paintings.php?style=Cubism">Cubism</a>
    <li><a class="dropdown-item" href="paintings.php?style=Surrealism">Surrealism</a>
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
    <H1 align = "center" style="color: white">ACME Art Gallery<H1>
   
  </div>
  <!-- Container with text inside -->
  <div id="paintings" class="bg-white p-5 rounded" align="centre">
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
if (isset($_GET['artist'])) {
    $artist = $_GET['artist'];
    $query = "SELECT * FROM paintings WHERE artist = '$artist'";
} 
//if statement to get paintings based on the style from the database used in the second dropdown box
else if (isset($_GET['style'])) {
    $style = $_GET['style'];
    $query = "SELECT * FROM paintings WHERE style = '$style'";
}
////if statement to get paintings based on the id from the database used in the search bar
else if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $query = "SELECT * FROM paintings WHERE title = '$search_query'";
} 
//else statement to load all painting from database int pages table.
else {
    $query = "SELECT * FROM paintings";
}

//submits and calls query from database
$sql = $query;
$stmt = $pdo->prepare($sql);
$stmt->execute();
  ?>
 
  <!--SPRINT 1 - table to display database contents inside of -->
 <table cellpadding="10" align="center" style="border-collapse: collapse; border: 1px solid black; border-radius: 10px;">
    <tr style="border: 1px solid black;">
        <th style="border: 1px solid black;  border-radius: 10px;">ID</th>
        <th style="border: 1px solid black;  border-radius: 10px;">Painting</th>
        <th style="border: 1px solid black;  border-radius: 10px;">Title</th>
        <th style="border: 1px solid black;  border-radius: 10px;">Finished</th>
        <th style="border: 1px solid black;  border-radius: 10px;">Media</th>
        <th style="border: 1px solid black;  border-radius: 10px;">Artist</th>
        <th style="border: 1px solid black;  border-radius: 10px;">Style</th>
    </tr>
			
  <!--SPRINT 1 - php used to echo table and display database contents inside -->			
  <?php
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr style='border: 1px solid black;'>";
            echo "<td style='border: 1px solid black;  border-radius: 10px;'>" . $row['id'] . "</td>";
            echo "<td style='border: 1px solid black;  border-radius: 10px;'>" . '<img src="data:image/png;base64,'. base64_encode($row['painting']).'" />' . "</td>";
            echo "<td style='border: 1px solid black;  border-radius: 10px;'>" . $row['title'] . "</td>";
            echo "<td style='border: 1px solid black;  border-radius: 10px;'>" . $row['finished'] . "</td>";
            echo "<td style='border: 1px solid black;  border-radius: 10px;'>" . $row['media'] . "</td>";
            echo "<td style='border: 1px solid black;  border-radius: 10px;'>" . $row['artist'] . "</td>";
            echo "<td style='border: 1px solid black;  border-radius: 10px;'>" . $row['style'] . "</td>";
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
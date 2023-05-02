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
   <!-- title of html page -->
    <title>ACME Arts - Add Artist</title>
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
    <H1 align = "center" style="color: white">ACME Art Gallery - Add to Artists<H1>
   
  </div>
  <!-- Container  -->
  <div class="bg-light p-5 rounded">
    
 
           <!--SPRINT 1 - form for the user to enter details to enter a new painting into the gallery.
			action links to update.php for SQL database submision. enctype multi form data is used to
			allow submision of images.-->
			<Table align = "center" border ="0" width ="500">
			<tr>
			<td>
                 <form method="POST" action="updateArtists.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="artist">Artist</label>
          <input type="text" class="form-control" name="artist" placeholder="Artists Name:">
          <br>
        </div>
        <div class="form-group">
          <label for="photo">Photo</label>
          <input type="file" class="form-control" name="photo" accept="image/png" placeholder="Select image:">
          <br>
        </div>
        <div class="form-group">
          <label for="lifespan">Life Span</label>
          <input type="text" class="form-control" name="lifespan" placeholder="Artists Life Span:">
          <br>
        </div>
        <div class="form-group">
          <label for="nationality">Nationality</label>
          <input type="text" class="form-control" name="nationality" placeholder="Artists Nationality:">
          <br>
        </div>
        <div>
		<!--SPRINT 1 -  button used by user to submit form -->
		
          <input type="submit" value="Add" name="btnAdd" class="btn btn-success">

          <br>
        </div>
		</form>
		</td>
		</tr>
		</table>
  </div>
</main>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
  <!-- end of html document -->

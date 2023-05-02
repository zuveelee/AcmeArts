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
    <title>ACME Arts - Membership</title>
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
    <H1 align = "center" style="color: white">ACME Art Gallery - Membership<H1>
   
  </div>
  <!-- Container -->
  <div class="bg-light p-4 rounded">
    

                      <!--SPRINT 1 - form for the user to edit details to an existing painting in the gallery.
			action links to update.php for SQL database submision. enctype multi form data is used to
			allow submision of images.-->
						<Table align = "center" border ="0" width ="500">
			<tr>
			<td>
                 <form method="POST" action="updateMembership.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" placeholder="Your Name Here:">
          <br>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" placeholder="Your Email Here:">
          <br>
        </div>
                 
        <div class="form-group">
          <label for="newsletter">Newsletter</label>
          <input type="checkbox" id="newsletter" name="newsletter" value="1">
          <br>
        </div>
                 
        <div class="form-group">
          <label for="breaking">Breaking News</label>
          <input type="checkbox" id="breaking" name="breaking" value="1">
          <br>
        </div>
        <div>
		<!--SPRINT 1 -  button used by user to submit form -->
		
          <input type="submit" value="Subscribe" name="btnSubscribe" title = "Subscibe to Newsletter or Breaking News" class="btn btn-success">
          

          <br>
        </div>
		</form>
		
		<form method="POST" action="unsubscribe.php" enctype = "multipart/form-data">
			<input type="submit" value="Unsubscribe" name="btnUnsub" title = "Unsubscribe from Newsletter and Breaking News" class="btn btn-danger">
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

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
    <title>ACME Arts - Edit</title>
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
    <H1 align = "center" style="color: white">ACME Art Gallery - Edit Gallery<H1>
   
  </div>
  <!-- Container -->
  <div class="bg-light p-5 rounded">
    

                      <!--SPRINT 1 - form for the user to edit details to an existing painting in the gallery.
			action links to update.php for SQL database submision. enctype multi form data is used to
			allow submision of images.-->
			<Table align = "center" border ="0" width ="500">
			<tr>
			<td>
                 <form method="POST" action="update.php"  enctype="multipart/form-data">
        <div class="form-group">
          <label for="id">ID</label>
          <input type="number" class="form-control" name="id" placeholder="id:">
          <br>
        </div>
        <div class="form-group">
          <label for="painting">Painting</label>
          <input type="file" class="form-control" name="painting" accept="image/png" placeholder="Select image:">
          <br>
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" placeholder="painting name:">
          <br>
        </div>
        <div class="form-group">
          <label for="finished">Finished</label>
          <input type="number" class="form-control" name="finished" placeholder="year finished:">
          <br>
        </div>
        <div class="form-group">
          <label for="media">Media Type</label>
          <input type="text" class="form-control" name="media" placeholder="media type:">
          <br>
        </div>
        <div class="form-group">
          <label for="artist">Artist Name</label>
          <input type="text" class="form-control" name="artist" placeholder="artist name:">
          <br>
        </div>
        <div class="form-group">
          <label for="style">Painting Style</label>
          <input type="text" class="form-control" name="style" placeholder="style:">
          <br>
        </div>
        <div>
 	<!--SPRINT 1 -  button used by user to submit form -->
          <input type="submit" value="Edit" name="btnEdit" action = "paintings.php" class="btn btn-success">

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

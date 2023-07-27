<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Ju Han Ng"  />
  <title>Home page</title>

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="styles/style.css" />
  <script
    src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"
  ></script>
</head>


<body class="home">


  <?php
  require_once 'headernologin.inc';
  ?>




      <div
        id="carouselExampleControls"
        class="carousel slide"
        data-ride="carousel"
      >
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              class="d-block w-100"
              src="images/banner1.webp"
              alt="First slide"
            />
          </div>
          <div class="carousel-item">
            <img
              class="d-block w-100"
              src="images/banner03.jpg"
              alt="Second slide"
            />
          </div>
          <div class="carousel-item">
            <img
              class="d-block w-100"
              src="images/banner3.jpg"
              alt="Third
            slide"
            />
          </div>
        </div>
        <a
          class="carousel-control-prev"
          href="#carouselExampleControls"
          role="button"
          data-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a
          class="carousel-control-next"
          href="#carouselExampleControls"
          role="button"
          data-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <div class="jumbotron mh-100" id="welcome_section" style="height: 40vh;">
        <div class="container">
          <h1 class="display-3">Welcome</h1>
          <p></p>
          <p><a class="btn btn-primary btn-lg" href="./register.php" role="button">Join now</a></p>
        </div>
      </div>



    <section class="jumbotron text-center mh-75" id="info_section" style="height: 100vh;">
      <h1 class="display-3">Our Game Library</h1>
      <img src="images/infosection.png"/ width="40%" height="90%">
    </section>


      <!-- cards -->
      <div class="container mh-100" id="card_container" >
          <!-- Example row of columns -->
          <div class="row">
            <div class="col-md-4">
              <h2>Games</h2>
              <p>We've got educational games such as Addition, Math & Science</p>
            </div>
            <div class="col-md-4">
              <h2>Education</h2>
              <p>We are dedicated to early childhood education to create future leaders.</p>
            </div>
            <div class="col-md-4">
              <p>The game is to keep learning, and I don't think people are going to keep learning who don't like the learning process. - Charlie Munger</p>
            </div>
          </div>

          <hr>

        </div>



      <div class="jumbotron mh-100" id="end_section" style="height: 40vh;">
      <div class="container">
          <h1 class="display-3">Ready to Join?</h1>
          <p></p>
          <p><a class="btn btn-primary btn-lg" href="./register.php" role="button">Get started now</a></p>
        </div>
      </div>



  <?php
  require_once 'footer.inc';
  ?>



  </body>
</html>

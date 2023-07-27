<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <meta name="description" content="Login page" />
  <meta name="keywords" content="PHP, MySql" />
  <meta name="author" content="(HTML) Zhonglong Li & Shiqi Zhang, (PHP) Ashmin Karki"  />
  <link href="styles/style.css" rel="stylesheet"/>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
  integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
  crossorigin="anonymous">

  <script
  src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
  crossorigin="anonymous">
  </script>

  <script
  src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
  crossorigin="anonymous">
  </script>

  <title>Login</title>
</head>



<?php

  session_start();
  if(isset($_SESSION['user_id'])){
    header('Location: dashboard.php');
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tep";
  if(isset($_POST['submit'])){

      if (empty($_POST["user_name"])) {  
          $user_nameErr = "User name is Required";  
      }

      if (empty($_POST["password"])) {  
          $passwordErr = "Password is required";  
      }
      
  }
  else{
      echo 'false';
  }

  if(empty($user_nameErr) && empty($passwordErr)){
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      }
      $user_name = $_POST['user_name'];
      $customer_password = md5($_POST['password']);
      $check_user = "SELECT * FROM tep_users WHERE u_name = '$user_name'";
      if(mysqli_query($conn, $check_user)){
          $result = mysqli_query($conn, $check_user);
          if(mysqli_num_rows($result) <= 0){
              $user_nameErr = 'This user does not exist';
          }
          else{
              $data = mysqli_fetch_assoc($result);
              if($customer_password != $data['user_password']){
                  $passwordErr = 'Wrong Password';
              }
              else{
                  session_start();
                  $_SESSION['user_id'] = $data['user_id'];
                  $_SESSION['user_name'] = $data['u_name'];
                  $redirect_url = "dashboard.php?user_name=".$data['user_id'];
                  header('Location:'.$redirect_url);
              }
              
          }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);
  }
  
}

?>




<body>



  <?php
  require_once 'headernologin.inc';
  ?>



  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5 d-flex justify-content-center carousel slide" id="carouselExampleSlidesOnly"
        data-ride="carousel">
          <div class="carousel-inner" transition: 0.6s ease-in-out left>
            <div class="carousel-item active">
              <img src="images/login1.jpg" class="img-fluid" alt="login image" /> <!-- https://www.freepik.com/free-vector/children-playing-board-game-white-background_24781815.htm-->
            </div>
            <div class="carousel-item">
              <img src="images/login2.jpg" class="img-fluid" alt="login image2" /><!-- https://blissfulkids.com/fun-mindfulness-game-for-children-mindful-marco-polo/--> 
            </div>
          </div>  
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 d-flex justify-content-center">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/formdata">
            <!-- Email input -->
            <h1 class="text-center">Log In</h1>
            <br />
            <div class="form-outline mb-4">
              <label class="form-label" for="username">User Name</label>
              <input
                type="text"
                id="user_name"
                name="user_name"
                class="form-control form-control-lg"
                placeholder="Enter user name"
              />
            </div>
            <?php
            if(!empty($user_nameErr)){ ?>
              <span class="error">* <?php echo $user_nameErr; ?> </span>  
              <?php
            }
            ?>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <label class="form-label" for="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control form-control-lg"
                placeholder="Enter password"
              />
            </div>
            <?php 
            if(!empty($passwordErr)){ ?>
              <span class="error">* <?php echo $passwordErr; ?> </span>  
              <?php
            }
            ?>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button
                type="submit"
                name="submit"
                value ="submit" 
                class="btn btn-secondary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem"
              >
                Login
              </button>
              <p class="small fw-bold mt-2 pt-1 mb-0">
                Don't have an account?
                <a href="register.php" class="link-danger">Register</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>



  <?php
  require_once 'footer.inc';
  ?>



</body>
</html>

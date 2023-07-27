<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="description" content="Register page" />
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

  <title>Register</title>
</head>




<?php
  $nameErr = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tep";
  if(isset($_POST['submit'])){
      // Validate User Name
      if (empty($_POST["user_name"])) {  
          $nameErr = "Username is required";  
      } else {  
          $name = $_POST["user_name"];  
          // if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
          //     $nameErr = "Only alphabets and white space are allowed";  
          // }  
      }
      // Validate first name
      if (empty($_POST["first_name"])) {  
          $first_nameErr = "First name is required";  
      } else {  
          $first_name = $_POST["first_name"];  
          if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {  
              $first_nameErr = "Only alphabets and white space are allowed";  
          }  
      }
      // Validate last name
        if (empty($_POST["last_name"])) {  
          $last_nameErr = "Last name is required";  
      } else {  
          $last_name = $_POST["last_name"];  
          if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {  
              $last_nameErr = "Only alphabets and white space are allowed";  
          }  
      }
      // Validate Date of Birth
      if (empty($_POST["dob"])) {  
          $dobErr = "Please select a date of birth";  
      }
      else{
              $dob = $_POST["dob"];
              $current_date = strtotime(date("d-m-Y"));
              $daydiff = strtotime($dob) -$current_date;


              if($daydiff >=  -31536000 && $daydiff < 0){
                  $dobErr = 'Age of a child must be at least 1 years to use this learning platform!';
              }
              elseif($daydiff >= 0){
                  $dobErr = 'Date of birth cannot be prior to current date';
              }
              else{
                  $dobErr ='';
              }
      }
      // Validate Email
      if (empty($_POST["email"])) {  
              $emailErr = "Email is required";  
      } else {  
              $email = $_POST["email"];  
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                  $emailErr = "Invalid email format";  
              }  
      }
      // Validate Password
      if (empty($_POST["password"])) {  
          $passwordErr = "Password is required";  
      } else {  
          $user_password = $_POST["password"];  
          $uppercase = preg_match('@[A-Z]@', $user_password);
          $lowercase = preg_match('@[a-z]@', $user_password);
          $number    = preg_match('@[0-9]@', $user_password);
          $specialChars = preg_match('@[^\w]@', $user_password);

          if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($user_password) < 8) {
              $passwordErr = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
          }
      }
      // Validate Password
      if (empty($_POST["confirm_password"])) { 
          if(empty($user_password)){
              $confirm_passwordErr = "Password is required";  
          }
          else{
              $confirm_passwordErr = "Password does not match";
          } 
      } else {
          $confirm_password = $_POST["confirm_password"]; 
          if($user_password !== $confirm_password){
              $confirm_passwordErr = "Password does not match";  
          }
      }
      // Validate Role
      if (empty($_POST["role"])) {  
          $roleErr = "Role is required";  
      } else {  
          $role = $_POST["role"];  
      }
      // Validate Phone number
      // if (empty($_POST["contact_phone"])) {  
      //         $mobilenoErr = "Mobile no is required";  
      // }
      // else {  
      //     $mobileno = $_POST["contact_phone"];  
      //     if (!preg_match ("/^[0-9]*$/", $mobileno) ) {  
      //         $mobilenoErr = "Only numeric value is allowed.";  
      //     }  
      //     if (strlen ($mobileno) != 10) {  
      //         $mobilenoErr = "Mobile no must contain 10 digits.";  
      //     }  
      // }  
  }
  else{
      echo 'false';
  }

  if(empty($nameErr) && empty($first_nameErr) && empty($last_nameErr) && empty($dobErr) && empty($emailErr) && empty($passwordErr) && empty($confirm_passwordErr) && empty($roleErr)){
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      }
      $user_name = $_POST['user_name'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $dob = $_POST['dob'];
      $role = $_POST['role'];
      $user_pass = md5($_POST['password']);
      $user_email = $_POST['email'];
      // $user_contact = $_POST['contact_phone'];
      $registered_at = strtotime(date("d-m-Y H:i:s"));
      $check_user = "SELECT * FROM tep_users WHERE u_name = '$user_name'";
      if(mysqli_query($conn, $check_user)){
          $user_check = mysqli_query($conn, $check_user);
          if(mysqli_num_rows($user_check) > 0){
              $nameErr = 'This username is already a registered user.';
          }
          else{
              $sql = "INSERT INTO tep_users (u_name, first_name, last_name,dob, user_role, email, user_password, registered_at)
              VALUES ('$user_name', '$first_name', '$last_name', '$dob', '$role',  '$user_email','$user_pass', $registered_at)";
              if (mysqli_query($conn, $sql)) {
                  $success_message = 'Dear '.$user_name.', you are successfully registered.';
              } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              }

              mysqli_close($conn);
          }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
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
        <div class="col-md-9 col-lg-6 col-xl-5 d-flex justify-content-center"carousel slide" id="carouselExampleSlidesOnly"
        data-ride="carousel">
          <div class="carousel-inner" transition: 0.6s ease-in-out left>
            <div class="carousel-item active">
              <img src="images/register1.jpg" class="img-fluid" alt="register1 image" /> <!-- https://www.freepik.com/search?format=search&page=2&query=children%20game%20cartoon -->
            </div>
            <div class="carousel-item">
            <img src="images/register2.png" class="img-fluid" alt="register2 image2" /><!-- https://www.freepik.com/free-vector/day-care-center-kindergarten-pupils-tutor-primary-education-nursery-school-high-quality-preschool-program-private-nursery-near-you-concept-bright-vibrant-violet-isolated-illustration_10780566.htm#page=3&query=children%20game%20cartoon&position=29&from_view=search&track=sph--> 
            </div>
          </div> 
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 d-flex justify-content-center">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/formdata">
            <h1>Create Your Account!</h1>
            <br>
            <div class="row register-form">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="form-label" for="first_name">First Name</label>
                      <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name *" value="" />
                  </div>
                  <?php if(!empty($first_nameErr)){ ?>
                    <span class="error">* <?php echo $first_nameErr; ?> </span>  
                  <?php
                  }
                  ?>
                  <div class="form-group">
                      <label class="form-label" for="last_name">Last Name</label>
                      <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name *" value="" />
                  </div>
                  <?php if(!empty($last_nameErr)){ ?>
                    <span class="error">* <?php echo $last_nameErr; ?> </span>  
                  <?php
                  }
                  ?>
                  <div class="form-group">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" name="password" id="password" class="form-control" placeholder="Enter password *" value="" />
                  </div>
                  <?php if(!empty($passwordErr)){ ?>
                    <span class="error">* <?php echo $passwordErr; ?> </span>  
                  <?php
                  }
                  ?>
                  <div class="form-group">
                      <label class="form-label" for="confirm_password">Confirm Your Password</label>   
                      <input type="password" name="confirm_password" id="confirm_password" class="form-control"  placeholder="Confirm your password *" value="" />
                  </div>
                  <?php if(!empty($confirm_passwordErr)){ ?>
                    <span class="error">* <?php echo $confirm_passwordErr; ?> </span>  
                  <?php
                  }
                  ?>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="form-label" for="user_name">User Name</label>
                      <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter user name *" value="" />
                  </div>
                  <?php if(!empty($nameErr)){ ?>
                    <span class="error">* <?php echo $nameErr; ?> </span>  
                  <?php
                  }
                  ?>
                  <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email *" value="" />
                  </div>
                  <?php if(!empty($emailErr)){ ?>
                    <span class="error">* <?php echo $emailErr; ?> </span>  
                  <?php
                  }
                  ?>
                  <div class="form-group">
                      <label class="form-label" for="dob">Date of Birth</label>
                      <input type="date" name="dob" id="dob" class="form-control" placeholder="Enter your date of birth *" value="" />
                  </div>
                  <?php if(!empty($dobErr)){ ?>
                    <span class="error">* <?php echo $dobErr; ?> </span></br>
                  <?php
                  }
                  ?>
                  <div class="form-group">
                    <label class="form-label" for="role">Select Your Role</label>
                    <select class="form-control" id="role" name="role">
                      <option selected disabled>Select Role</option>
                      <option value="student">Student</option>
                      <option value="teacher">Teacher</option>
                    </select>
                  
                  </div>
                    <?php if(!empty($roleErr)){ ?>
                      <span class="error">* <?php echo $roleErr; ?> </span>  
                    <?php
                    }
                    ?>
              </div>
            </div>
              <br />
              <div class="row justify-content-center">
                <input type="submit" name="submit" class="btn btn-secondary btn-lg"  value="Register"/>
              </div>
              <?php if(!empty($success_message)){ ?>
              <span class="success"><?php echo $success_message; ?> </span>  
              <?php
              }
              ?>

    </div>
  </section>


  <?php
  require_once 'footer.inc';
  ?>



</body>
</html>
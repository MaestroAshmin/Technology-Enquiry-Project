<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Ju Han Ng"  />
    <title>Account page</title>

    <link href="styles/style.css" rel="stylesheet"/>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
  	integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
  	crossorigin="anonymous">
  </head>





  <?php

    session_start();
    if(!isset($_SESSION['user_id'])){
      header('Location: login.php');
    }


    function sanitise_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['submit'])){

          $errMsg = "";

          if(isset($_POST["firstname"])){
              $firstname = sanitise_input($_POST["firstname"]);
          }

          if(isset($_POST["lastname"])){
            $lastname = sanitise_input($_POST["lastname"]);
          }


          if(isset($_POST["email"])){
            $email = sanitise_input($_POST["email"]);
          }


          if(isset($_POST["u_name"])){
            $u_name = sanitise_input($_POST["u_name"]);
          }


          if(isset($_POST["user_password"])){
            $user_password = md5(sanitise_input($_POST["user_password"]));
          }


          if(isset($_POST["dob"])){
            $dob = sanitise_input($_POST["dob"]);
            $current_date = strtotime(date("d-m-Y"));
            $daydiff = strtotime($dob) -$current_date;
          }


        if ($firstname == "") {
            $errMsg .= "<p>You must enter your first name.</p>";
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $firstname)) {
            $errMsg .= "<p>Only alpha characters allowed in your first name.</p>";
        }



        if ($lastname == "") {
            $errMsg .= "<p>You must enter your last name.</p>";
        }
        else if (!preg_match("/^[a-zA-Z]+$/", $lastname)) {
            $errMsg .= "<p>Only alpha characters allowed in your last name.</p>";
        }



        if ($email == "") {
            $errMsg .= "<p>You must enter your email.</p>";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errMsg .= "<p>Please enter a valid email address.</p>";
        }


        if ($u_name == "") {
            $errMsg .= "<p>You must enter your user name.</p>";
        }


        if ($user_password == "") {
          $errMsg .= "<p>You must enter your password.</p>";
        }


        if ($dob == "") {
          $errMsg .= "<p>You must enter your date of birth.</p>";
        }
        else if($daydiff >=  -31536000 && $daydiff < 0){
          $errMsg .= 'Age of a child must be at least 1 years to use this learning platform!';
        }
        else if($daydiff >= 0){
          $errMsg .= 'Date of birth cannot be prior to current date';
        }

        


        if ($errMsg == "") {
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "tep";
          $conn = mysqli_connect($servername, $username, $password, $dbname);

          if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
          }

          $table = "tep_users";
          $user_id = $_SESSION["user_id"];

          $sql = "UPDATE $table SET first_name = '$firstname', last_name = '$lastname', email = '$email', user_password = '$user_password', u_name = '$u_name', dob = '$dob' WHERE user_id = $user_id ";
          if (mysqli_query($conn, $sql)) {
              $success_message = 'Your information has been submitted successfully';
          } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }

          mysqli_close($conn);
      }



    }
    }
?>


  






<body class="account_setting">



  <?php
    require_once 'header.inc';
  ?>


  <div class="wrapper bg-white mt-sm-5">
      <h4 class="pb-4 border-bottom">Account settings</h4>

      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tep";
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $sql_table = "tep_users";
      $user_id = $_SESSION["user_id"];

      $sql = "SELECT * FROM $sql_table WHERE user_id = '$user_id'";

      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_assoc($result);


      
      echo '
      <div id="user_information">
      <div class="row">
        <div class="col-md-6">
            <label for="firstname">First Name</label>
           ';

        echo '<p>',$row["first_name"],'</p>';

        echo '</div>
        <div class="col-md-6 pt-md-0 pt-3">
            <label for="u_name">User Name</label>';

        echo '<p>',$row["u_name"],'</p>';

        echo '
        </div>
        </div>
        ';


      echo '
      <div class="row">
        <div class="col-md-6">
            <label for="firstname">Last Name</label>
           ';

        echo '<p>',$row["last_name"],'</p>';

        echo '</div>
        <div class="col-md-6 pt-md-0 pt-3">
            <label for="u_name">Email</label>';

        echo '<p>',$row["email"],'</p>';

        echo '
        </div>
        </div>
        ';


      echo '
      <div class="row">
        <div class="col-md-6">
            <label for="firstname">Date of Birth</label>
           ';

        echo '<p>',$row["dob"],'</p>';

        echo '</div>
        <div class="col-md-6 pt-md-0 pt-3">
            <label for="u_name">Role</label>';

        echo '<p>',ucfirst($row["user_role"]),'</p>';

      echo '
        </div>
      </div>
    </div>';

      ?>




      <form id="account" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate="novalidate">
          <fieldset>
      <div class="py-2">
          <div class="row py-2">
              <div class="col-md-6">
                  <label for="firstname">First Name</label>
                  <input type="text" name="firstname" class="bg-light form-control" placeholder="Steve" pattern="^[a-zA-Z]+$" required="required">
              </div>
              <div class="col-md-6 pt-md-0 pt-3">
                  <label for="u_name">User Name</label>
                  <input type="text" name="u_name" class="bg-light form-control" placeholder="stevesmith123" required="required"> <br/>
              </div>
      
              <div class="col-md-6">
                  <label for="lastname">Last Name</label>
                  <input type="text" name="lastname" class="bg-light form-control" placeholder="Smith" pattern="^[a-zA-Z]+$" required="required"> 
              </div>
              <div class="col-md-6">
                  <label for="email">Email Address</label>
                  <input type="email" name="email" class="bg-light form-control" placeholder="steve@email.com" required="required"> <br/>
              </div>
              <div class="col-md-6">
                  <label for="user_password">Password</label>
                  <input type="text" name="user_password" class="bg-light form-control" placeholder="Enter password" required="required">
              </div>
              <div class="col-md-6 pt-md-0 pt-3">
                  <label for="dob">Date of Birth</label>  
                  <input type="date" name="dob" id="dob" class="bg-light form-control" placeholder="dd/mm/yyyy" required="required" value="" /> <br/>
              </div>


              
              <div class="col-md-6 pt-md-0 pt-3">
              <?php if(!empty($errMsg)){ ?>
                    <br>
                    <span class="error">* <?php echo $errMsg; ?> </span>  
                  <?php
                  }
                  ?>
              </div>

              </div>
          </div>

          <button class="btn btn-primary mr-3" input type="submit" name = "submit" id="saveButton">Save Changes</button>

          <div class="py-3 pb-4 border-bottom" ></div>

          </fieldset>

      </form>

          <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tep";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            $sql_table = "score";
            $select_query = "game_type, score";
            $user_id = $_SESSION["user_id"];

            $sql = "SELECT $select_query FROM $sql_table WHERE user_id = '$user_id'";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
              echo "<p>Something is wrong with ", $query, "</p>";
            }
            else {
                echo "<table border=\"1\">\n";
                echo "<tr>\n "
                    ."<th scope=\"col\">Game Type</th>\n "
                    ."<th scope=\"col\">Score</th>\n "
                    ."</th>\n ";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n ";
                    echo "<td>",$row["game_type"],"</td>\n ";
                    echo "<td>",$row["score"],"</td>\n ";
                    "</tr>\n ";
            }
            echo "</table>\n ";

            mysqli_free_result($result);
            }
            mysqli_close($conn);
          ?>

      </div>
  </div>



  <?php
    require_once 'footer.inc';
  ?>



</body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="(HTML) Zhonglong Li, (PHP) Ju Han Ng"  />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />
    <link href="styles/style.css" rel="stylesheet"/>
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



<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "tep";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  }
  $check_user = "SELECT user_role FROM tep_users WHERE user_id = '$user_id'";
  if(mysqli_query($conn, $check_user)){
      $result = mysqli_query($conn, $check_user);
      if(mysqli_num_rows($result) <= 0){
          header('Location: home.php');
      }
      else{
          $data = mysqli_fetch_assoc($result);
          $user_role = $data['user_role'];
      }
  }
  else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  mysqli_close($conn); 
?>



<body>

  <?php
  require_once 'header.inc';
  ?>

<?php if($user_role == 'student'){?>
    <!-- header -->
    <section id="header" class="jumbotron text-center mh-50">
      <h1 class="display-3">Games</h1>
      <p class="lead">Educational games for your studies</p>
    </section>
    
    <!-- math game -->
    <section id="mathgames">
       <h1 class="d-flex justify-content-center mb-5">Math Games</h1>
      <div class="container">
        <div class="row">
        <div class="col mb-4">
        <div class="card">
          <img src="images/mathgame1.png" alt="mathgame1" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Addition & Subtraction</h5>
           <a href="./mathgame1holder.php" class="btn btn-outline-success btn-sm ">Play</a>
          </div>
         </div>
        </div>
      <div class="col mb-4">
      <div class="card">
          <img src="images/mathgame2.png" alt="mathgame2" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Multiply</h5>
           <a href="./mathgame2holder.php" class="btn btn-outline-success btn-sm">Play</a>
          </div>
          </div>
        </div>
        <div class="col mb-4">
        <div class="card">
          <img src="images/mathgame3.png" alt="mathgame3" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Arithmetic</h5>
           <a href="./mathgame3holder.php" class="btn btn-outline-success btn-sm">Play</a>
          </div>
         </div>
        </div>

        <div class="col mb-4">

      </div>


    </section>
    <!-- english game -->
    <section id="englishgames">
        <h1 class="d-flex justify-content-center mb-5 mt-5">English Games</h1>
        <div class="container">
          <div class="row">
          <div class="col-lg-3 mb-4">
          <div class="card">
            <img src="images/englishgame1.jpg" alt="englishgame1" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Punctuation</h5>
             <a href="./englishgame1holder.php" class="btn btn-outline-success btn-sm ">Play</a>
            </div>
           </div>
          </div>

        <div class="col-lg-3 mb-4">

      </div>
      
      </section>
    <!-- science game -->
    <section id="sciencegames">
        <h1 class="d-flex justify-content-center mb-5 mt-5">Science Games</h1>
        <div class="container">
          <div class="row">
          <div class="col-lg-3 mb-4">
          <div class="card">
            <img src="images/sciencegame1.jpg" alt="sciencegame1" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Science</h5>
             <a href="./sciencegame1holder.php" class="btn btn-outline-success btn-sm ">Play</a>
            </div>
           </div>
          </div>
        </div>
      </div>
      </section>
      <?php 
      }
      elseif($user_role == 'teacher'){ 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tep";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      }
      $check_user = "SELECT u.first_name, u.last_name, s.game_type, s.score,u.user_role FROM tep_users as u JOIN score as s ON u.user_id=s.user_id WHERE u.user_role = 'student'";
      // print_r($check_user);
      // exit;
      if(mysqli_query($conn, $check_user)){
          $result = mysqli_query($conn, $check_user);
          if(mysqli_num_rows($result) <= 0){
              header('Location: home.php');
          }
          else{
            
              echo '<table class="dashboard">
              <thead>
              <tr>
                  <th>Student Name</th>
                  <th>Game Type</th>
                  <th>Score</th>
              </tr>
              </thead>';
              // $data = mysqli_fetch_assoc($result);
              while($row = mysqli_fetch_assoc($result)){
                 echo '<tr> 
                  <td>'.$row['first_name'].' '.$row['last_name'].'</td> 
                  <td>'.$row['game_type'].'</td> 
                  <td>'.$row['score'].'</td> 
 
              </tr>';
              }
              // print_r($data);
              echo '<table>';
          }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);   
      ?>

        <?php } 
      elseif($user_role == 'admin'){
        ?>
      <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Teachers')">Teachers</button>
        <button class="tablinks" onclick="openCity(event, 'Students')">Students</button>
        <button class="tablinks" onclick="openCity(event, 'Parents')">Parents</button>
        <button class="tablinks" onclick="openCity(event, 'Scores')">Scores</button>
        <button class="tablinks" onclick="openCity(event, 'Feedbacks')">Feedbacks</button>
      </div>
      <?php 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tep";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      }
      $teacher = "SELECT * FROM tep_users WHERE user_role = 'teacher'";
      $student = "SELECT * FROM tep_users WHERE user_role = 'student'";
      $parent = "SELECT * FROM tep_users WHERE user_role = 'parent'";
      $scores = "SELECT u.first_name, u.last_name, s.game_type, s.score,u.user_role,s.score_id FROM tep_users as u JOIN score as s ON u.user_id=s.user_id WHERE u.user_role = 'student'";
      $feedbacks = "SELECT * from feedback";
      if(mysqli_query($conn, $teacher)){
          $result = mysqli_query($conn, $teacher);
          if(mysqli_num_rows($result) <= 0){
              // echo 'No records found';
          }
          else{

              $i = 1;
              $teacher_array = array();
              while($row = mysqli_fetch_assoc($result)){
                array_push($teacher_array, $row);

              }

          }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      if(mysqli_query($conn, $student)){
          $result = mysqli_query($conn, $student);
          if(mysqli_num_rows($result) <= 0){
              // echo 'No records found';
          }
          else{
              $i = 1;
              $student_array = array();
              while($row = mysqli_fetch_assoc($result)){
                array_push($student_array, $row);
              }
            }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      if(mysqli_query($conn, $parent)){
          $result = mysqli_query($conn, $parent);
          if(mysqli_num_rows($result) <= 0){
              // echo 'No records found';
          }
          else{
              $i = 1;
              $parent_array = array();
              while($row = mysqli_fetch_assoc($result)){
                array_push($parent_array, $row);
              }
            }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
        if(mysqli_query($conn, $scores)){
          $result = mysqli_query($conn, $scores);
          if(mysqli_num_rows($result) <= 0){
              // echo 'No records found';
          }
          else{
              $i = 1;
              $scores_array = array();
              while($row = mysqli_fetch_assoc($result)){
                array_push($scores_array, $row);
              }
            }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      if(mysqli_query($conn, $feedbacks)){
          $result = mysqli_query($conn, $feedbacks);
          if(mysqli_num_rows($result) <= 0){
              // echo 'No records found';
          }
          else{
              $i = 1;
              $feedbacks_array = array();
              while($row = mysqli_fetch_assoc($result)){
                array_push($feedbacks_array, $row);
              }
            }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn);   
      ?>
        <div id="Teachers" class="tabcontent">
              <table class="dashboard">
                <thead>
                <tr>
                  <th>S.N</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Action</th>
               </tr>
            </thead>
               <?php
               if(isset($teacher_array)){
               $i = 1;
               foreach($teacher_array as $teacher){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $teacher['first_name']?> <?php echo $teacher['last_name']?>'</td>
                    <td><?php echo $teacher['email']?></td>
                    <td><a href="removeuser.php?id=<?php echo $teacher['user_id']?>" class="btn btn-danger">Remove User</a></td>
              </tr>
                <?php 
                $i++;
                }
              }
              ?>
              </table>
      </div>
      <div id="Students" class="tabcontent">
         <table class="dashboard">
          <thead>
                <tr>
                  <th>S.N</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Action</th>
               </tr>
            </thead>
               <?php
               if(isset($student_array)){
               $i = 1;
               foreach($student_array as $student){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $student['first_name']?> <?php echo $student['last_name']?>'</td>
                    <td><?php echo $student['email']?></td>
                    <td><a href="removeuser.php?id=<?php echo $student['user_id']?>" class="btn btn-danger">Remove User</a></td>
              </tr>
                <?php 
                $i++;
                }
              }?>
              </table>
      </div>

      <div id="Parents" class="tabcontent">
         <table class="dashboard">
          <thead>
                <tr>
                  <th>S.N</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Action</th>
               </tr>
            </thead>
               <?php if(isset($parent_array)){
               $i = 1;
               foreach($parent_array as $parent){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $parent['first_name']?> <?php echo $parent['last_name']?>'</td>
                    <td><?php echo $parent['email']?></td>
                    <td><a href="removeuser.php?id=<?php echo $parent['user_id']?>" class="btn btn-danger">Remove User</a></td>
              </tr>
                <?php 
                $i++;
                }
              }?>
              </table>
      </div>
      <div id="Scores" class="tabcontent">
        <table class="dashboard">
          <thead>
                <tr>
                  <th>S.N</th>
                   <th>Name</th>
                   <th>Game Type</th>
                   <th>Scores</th>
                   <th>Action</th>
               </tr>
            </thead>
               <?php if(isset($scores_array)){
               $i = 1;
               foreach($scores_array as $score){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $score['first_name']?> <?php echo $score['last_name']?>'</td>
                    <td><?php echo $score['game_type']?></td>
                    <td><?php echo $score['score']?></td>
                    <td><a href="removescore.php?id=<?php echo $score['score_id']?>" class="btn btn-danger">Remove Score</a></td>
              </tr>
                <?php 
                $i++;
                }
              }?>
              </table>
      </div>
      <div id="Feedbacks" class="tabcontent">
        <table class="dashboard">
          <thead>
                <tr>
                  <th>S.N</th>
                   <th>Name</th>
                   <th>Email</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Contact Preference</th>
                    <th>Feedback Type</th>
                    <th>Topic</th>
                    <th>Comment</th>
                    <th>Created at</th>
                   <th>Action</th>
               </tr>
            </thead>
               <?php
               if(isset($feedbacks_array)){
               $i = 1;
               foreach($feedbacks_array as $feedback){?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $feedback['first_name']?> <?php echo $feedback['last_name']?>'</td>
                    <td><?php echo $feedback['email']?></td>
                    <td><?php echo $feedback['street_address']?></td>
                    <td><?php echo $feedback['phone_no']?></td>
                    <td><?php echo $feedback['contact']?></td>
                    <td><?php echo $feedback['feedback_type']?></td>
                    <td><?php echo $feedback['topic']?></td>
                    <td><?php echo $feedback['comment']?></td>
                    <td><?php echo $feedback['created_at']?></td>
                    <td><a href="removefeedback.php?id=<?php echo $feedback['feedback_id']?>" class="btn btn-danger">Delete</a></td>
              </tr>
                <?php 
                $i++;
                }
              }?>
              </table>
      </div>
        <?php }?>
    <?php

    if ($user_role == 'student') {
      require_once 'footer.inc';
    }
    else {
    require_once 'footerdashboard.inc';
    }
    ?>


</body>
</html>
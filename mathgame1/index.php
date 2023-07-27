<?php
session_start();
  if(isset($_SESSION['user_id'])){

    $user_name = $_SESSION['user_name'];
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "tep";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      }
      $check_user = "SELECT user_role,user_id FROM tep_users WHERE u_name = '$user_name'";
      if(mysqli_query($conn, $check_user)){
          $result = mysqli_query($conn, $check_user);
          if(mysqli_num_rows($result) <= 0){
              header('Location: home.php');
          }
          else{
              $data = mysqli_fetch_assoc($result);
              $user_role = $data['user_role'];
              $user_id = $data['user_id']; 
          }
      }
      else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
      mysqli_close($conn); 
  }
  else{
    header('Location: ../login.php');
  }  

?>
<?php if($user_role == 'student') { ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Math Quiz</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<section>
 <div class='start-container slide-container'>
   <button id="start">START</button>
   <div id="timer-slide" class='timer slide-cover slid-up'>
     <p id="timer-label" class='label'>Timer</p>
     <p id="timer" class='main'></p>
   </div>
</div>
  
<div class='problem'>
  <p class='label'>PROBLEM</p>
  <p id="question" class='main'></p>
</div>
<div class='lights'>
  <div id='green-light' class='light'></div>
  <div id='red-light' class='light'></div>
</div>
<div class='score-container'>
  <p class='label'>SCORE</p>
  <p id="score" class='main'></p>
</div>
<form action="save-score.php" class="save-score" method="post">
  <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
  <input type="hidden" name="score" id="game-score" value="">
  <input type="hidden" name="game_type" value="1">
  <input type="submit" name="submit" value="Save Score">
</form>
</section>

<p class='label'>(Enter Your Answer By Keyboard)</p>
  <script  src="./script.js"></script>

</body>
</html>
<?php }
else{
  header('Location:../dashboard.php');
}
?>


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
  <title>CodePen - simple math game</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="bar">
  <div class="segment"><strong>MATH GAME</strong></div>
  <div class="segment" id="points">Points: 0000</div>
</div>
<div class="number">#1</div>
<div class="time">120</div>
<div class="center">
  <button>Begin</button>
  <div class="expression">666</div>
  <input type="text"/>
  <div class="done"></div>
  <div>
      <form action="save-score.php" class="save-score" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
    <input type="hidden" name="score" id="game-score" value="">
    <input type="hidden" name="game_type" value="3">
    <input type="submit" id="submit" name="submit" value="Save Score" style="display:block !important;">
  </form>
  </div>

</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
<?php }
else{
  header('Location:../dashboard.php');
}
?>
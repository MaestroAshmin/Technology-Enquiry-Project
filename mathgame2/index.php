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
<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>Multiplying Number Game</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--css-->
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>

    <body>
        <div id="container">
            <!-- title-->
            <h1 class="gametitle">Multiplying Number Game</h1>
            <!--game board-->
            <div id="board">            
                <div id="right">Right</div>
                <div id="wrong">Try again</div>
                <div id="score">Score: <span id="scoreNumber">0</span></div>
                <div id="problem"></div> 
                <div id="instruction"></div>
                <div id="answers">
                    <div id="answer1"></div>
                    <div id="answer2"></div>
                    <div id="answer3"></div>
                    <div id="answer4"></div>     
                </div>
                <div id="start">Start Game</div>

                <div id="time">Time: <span id="remainingTime">55</span> sec</div>
                <div id="gameover">GAME OVER Your score: <span id="finalscore">0</span>
    
                </div>
                <div>
                        <form action="save-score.php" class="save-score" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                        <input type="hidden" name="score" id="game-score" value="">
                        <input type="hidden" name="game_type" value="2">
                        <input type="submit" name="submit" value="Save Score">
                    </form> 
                </div>
            </div> 

        </div>

       
        <script src="script.js"></script>

    </body>
</html>
<?php }
else{
  header('Location:../dashboard.php');
}
?>
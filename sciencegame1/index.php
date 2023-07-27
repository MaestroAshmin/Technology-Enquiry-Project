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
              $_SESSION['user_id'] = $user_id;
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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <!-- Coding with nick -->
  <title>Quiz App</title>
</head>
<body>

  <div class="quiz-container" id="quiz">
    <div class="quiz-header">
      <h2 id="question">Question Text</h2>
      <ul>
        <li>
          <input type="radio" name="answer" id="a" class="answer">
          <label for="a" id="a_text">Answer</label>
        </li>

        <li>
          <input type="radio" name="answer" id="b" class="answer">
          <label for="b" id="b_text">Answer</label>
        </li>

        <li>
          <input type="radio" name="answer" id="c" class="answer">
          <label for="c" id="c_text">Answer</label>
        </li>

        <li>
          <input type="radio" name="answer" id="d" class="answer">
          <label for="d" id="d_text">Answer</label>
        </li>

      </ul>
    </div>

    <button id="submit">Submit</button>

  </div>


  <script src="script.js"></script>
  
</body>
</html>
<?php }
else{
  header('Location:../dashboard.php');
}
?>
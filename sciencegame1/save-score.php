<?php
    if(isset($_GET['score'])){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tep";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            session_start();
            $user_id = $_SESSION['user_id'];
            $score = $_GET['score'];
            $game_type = "Science";
            echo $user_id;
            $sql = "INSERT INTO score (user_id,score,game_type) VALUES ('$user_id','$score','$game_type')";
            if (mysqli_query($conn, $sql)) {
                header('Location: index.php');
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
    }
?>
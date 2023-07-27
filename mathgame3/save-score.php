<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['submit'])){
        if(empty($_POST['score'])){
            header('Location: index.php');
        }
        else{
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "tep";
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $user_id = $_POST['user_id'];
            $score = $_POST['score'];
            $game_type = $_POST['game_type'];
            $sql = "INSERT INTO score (user_id,score,game_type) VALUES ('$user_id','$score','$game_type')";
            if (mysqli_query($conn, $sql)) {
                header('Location: index.php');
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    }
    else{
        header('Location: index.php');
    }
}
?>
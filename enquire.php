<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Enquire Form" />
    <meta name="keywords" content="enquire" />
    <meta name="author" content="Ju Han Ng"  />
    
	<link href="styles/style.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
  	integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
  	crossorigin="anonymous">

    <title>Enquire</title>

</head>


<body class="enquire">



    <?php
    require_once 'headernologin.inc';
    ?>

<?php
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['submit'])){

            if(isset($_POST["person-type"])){
                $person_type = sanitise_input($_POST["person-type"]);
                // echo "<p>$person_type</p>";
            }
            
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }
            if (isset ($_POST["firstname"])) {
                $firstname = sanitise_input($_POST["firstname"]);
                // echo "<p>$firstname</p>";
            }
            else {
                //header ("location: enquire.php"); //Send the user back to the enquire.php order form if the user enter this form using a link
            }


            if (isset ($_POST["lastname"])) {
                $lastname = sanitise_input($_POST["lastname"]);
                // echo "<p>$lastname</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }


            if (isset ($_POST["email"])) {
                $email = sanitise_input($_POST["email"]);
                // echo "<p>$email</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }


            if (isset ($_POST["streetaddress"])) {
                $streetaddress = sanitise_input($_POST["streetaddress"]);
                // echo "<p>$streetaddress</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }


            if (isset ($_POST["phone_no"])) {
                $phone_no = sanitise_input($_POST["phone_no"]);
                // echo "<p>$phone_no</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }


            if (isset ($_POST["contact"])) {
                $contact = sanitise_input($_POST["contact"]);
                // echo "<p>$contact</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }


            if (isset ($_POST["feedbackType"])) {
                $feedbackType = sanitise_input($_POST["feedbackType"]);
                // echo "<p>$feedbackType</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }


            if (isset ($_POST["topic"])) {
                $topic = sanitise_input($_POST["topic"]);
                // echo "<p>$topic</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }


            if (isset ($_POST["comment"])) {
                $comment = sanitise_input($_POST["comment"]);
                // echo "<p>$comment</p>";
            }
            else {
                echo "<p>Error: Enter data in the <a href=\"enquire.php\">form</a></p>";
            }



            $errMsg = "";

            if($person_type == ""){
                $errMsg .= "<p>You must select your user type.</p>";
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



            if ($streetaddress == "") {
                $errMsg .= "<p>You must enter your street address.</p>";
            }



            if ($phone_no == "") {
                $errMsg .= "<p>You must enter your post code.</p>";
            }
            else if (!preg_match("/^[0-9]+$/", $phone_no)) {
                $errMsg .= "<p>Only digits in your phone no.</p>";
            }



            if ($contact == "") {
                $errMsg .= "<p>You must select your preferred contact method.</p>";
            }



            if ($feedbackType == "") {
                $errMsg .= "<p>You must select a feedback type.</p>";
            }



            if ($topic == "") {
                $errMsg .= "<p>You must select a topic.</p>";
            }



            if ($comment == "") {
                $errMsg .= "<p>You must leave a comment.</p>";
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
                $sql = "INSERT INTO feedback (person_type, first_name, last_name, email, street_address, phone_no, contact, feedback_type, topic, comment)
                    VALUES ('$person_type', '$firstname', '$lastname', '$email', '$streetaddress',  '$phone_no','$contact', '$feedbackType','$topic', '$comment')";
                    if (mysqli_query($conn, $sql)) {
                        $success_message = 'Your feedback has been submitted successfully';
                    } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                    mysqli_close($conn);
            }
    }
}
?>

    <div class="form_body">
        <form id="enquire_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate="novalidate">
            <h1>FEEDBACK FORM</h1>

            <aside>Please enter your personal information and leave your feedback in the comment box
            </aside>

            <h2>Your Details</h2>


            <!--info-master contains the labels of all the personal information of the user (name & email)-->
            <div class="info-master">
                <?php if(!empty($success_message)){ ?>
                <span class="success"><?php echo $success_message; ?> </span>  
                <?php
                }
                ?>
                <div class="row">

                    <div class="left">
                        <label for="product">Are you a:</label> 
                    </div>

                    <div class="right">
                        <select name="person-type" id="person-type">
                            <option value="">-Select One-</option>		
                            <option value="Student">Student</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Parent">Parent</option>
                            <option value="Administrator">Administrator</option>
                        </select>
                    </div>
                        
                </div>


                <div class="row">

                    <div class="left">
                        <label for="firstname">First Name</label>
                    </div>

                    <div class="right">
                        <input type="text" name="firstname" id="firstname" maxlength="25" placeholder="Enter your first name" required="required"/>
                    </div>
                        
                </div>
    
                <div class="row">

                    <div class="left">
                        <label for="lastname">Last Name</label>
                    </div>

                    <div class="right">
                        <input type="text" name="lastname" id="lastname" maxlength="25" placeholder="Enter your last name" required="required"/>
                    </div>

                </div>

                <div class="row">

                    <div class="left">
                        <label for="email">Email</label>
                    </div>

                    <div class="right">
                        <input type="email" name="email" id="email" placeholder="abc123@def.com" required="required"/>
                    </div>

                </div>


                <div class="row">

                    <div class="left">
                        <label for="streetaddress">Address</label>
                    </div>

                    <div class="right">
                        <textarea id="streetaddress" name="streetaddress" rows="4" cols="70"></textarea>
                    </div>
                </div>


                <div class="row" id="phone-no-row">

                    <div class="left">
                        <label for="phone_no">Phone No</label>
                    </div>

                    <div class="right">
                        <input type="text" name="phone_no" id="phone_no" maxlength="10" placeholder="0123456789" required="required"/>
                    </div>
                        
                </div>

                <div class="row">
                    <div class="left">
                        <p>Preferred contact</p>
                    </div>

                    <div class="right" id="right-contact-radio">
                        <input type="radio" id="email-pref" name="contact" value="Email" checked="checked"/> 
                        <label for="email-pref">Email</label> 
                        
                        <input type="radio" id="post-pref" name="contact" value="Post" /> 
                        <label for="post-pref">Post</label>
                        
                        <input type="radio" id="phone-pref" name="contact" value="Phone" />
                        <label for="phone-pref">Phone</label> 
                    </div>
                </div>



            </div>




            <div class="feedback-master">
    
                <h2>Type of Feedback</h2>

                <div class="row">

                    <div class="left">
                        <label for="feedbackType">I would like to make a:</label> 
                    </div>

                    <div class="right">
                        <select name="feedbackType" id="feedbackType">
                            <option value="">-Select One-</option>		
                            <option value="Complaint">Complaint</option>
                            <option value="Compliment">Compliment</option>
                            <option value="Suggestion">Suggestion</option>
                        </select>
                    </div>
                        
                </div>


                <div class="row">

                    <div class="left">
                        <label for="topic">Topic:</label> 
                    </div>

                    <div class="right">
                        <select name="topic" id="topic">
                            <option value="">-Select One-</option>		
                            <option value="Academic Course">Academic Course</option>
                            <option value="Assessment">Assessment</option>
                            <option value="Website">Website</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                        
                </div>


                <!--comment-master contain the comment textbox field which the user can use to enter their feedback.-->
                <div class="comment-master">
                    <label for="comment">Comments</label>
                    <textarea id="comment" name="comment" placeholder="Please enter any comments here." rows="4" cols="40"></textarea>
                </div>

                </div>

                <input type= "submit" name ="submit" id="submitButton" value="Submit"/>
                <?php if(!empty($errMsg)){ ?>
                    <span class="error">* <?php echo $errMsg; ?> </span>  
                  <?php
                  }
                  ?>
                  
            </form>
    </div>



    <?php
    require_once 'footer.inc';
    ?>


</body>
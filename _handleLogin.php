<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    $sql = "SELECT * FROM `users` WHERE user_email='$email'";
    
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_email'] = $email;
            $_SESSION['sno'] = $row['sno'];
            echo 'logged in '. $email;
        }
       
    //     <script type="text/javascript">
    //     window.location.href = "/iforum/index.php";
    //    </script> 
    }
    // else {
    // header("Location: /iforum/index.php?login=false");
    // }
       
}
?>
<script type="text/javascript">
         window.location.href = "/iforum/index.php";
        </script> 
 <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>

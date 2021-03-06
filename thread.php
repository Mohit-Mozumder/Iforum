<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
    $id = $_GET['threadid'];
        $showAlert=false;
        $method= $_SERVER['REQUEST_METHOD'];
        if($method=='POST')
        {
            $comment = $_POST['comment'];
            $sno = $_POST['sno']; 
            $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);
            $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`)
             VALUES ('$comment', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert=true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your comment has been added!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>';
            }
        }
    
    ?>
    <?php
    
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $id= $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
        ?>

    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-6"> <?php echo $title  ?> </h1>

            <hr class="my-4">
            <p><?php echo $desc ?></p>

        </div>


        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id"; 
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content']; 
                $comment_time = $row['comment_time']; 
                $thread_user_id = $row['comment_by']; 
                $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $user_email = $row2['user_email'];
        
                echo '<div class="media my-3">
                <img class="mr-3" src="/iforum/pics/user.jpg" weidth="35px" height="35px" alt="image">
                <div class="media-body">
                <p class="font-weight-bold my-0"> Answered by: '.$user_email.' at '. $comment_time. '</p>
                   
                    '. $content .'
                </div>
            </div>';}
            if($noResult){
                echo " <hr><b> No comment, Be the first </b><hr>";
            }
    
    ?>
    </div>
    <!-- form -->


<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
echo '
    <div class="container">
        <form action="'. $_SERVER['REQUEST_URI'] . '" method="post">

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Write your answer</label>

                <textarea class="form-control" required="required" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value=" '. $_SESSION["sno"]. '">
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>

    </div>';
    
    }
    else{
    echo 
    '<div class="container">
    <h1 class="display-6">Logged in to answer question</h1>
    </div>';

}
    ?>
    <!-- form -->
    <br>

    <br>
    <?php 
    include 'partials/_footer.php';
    include 'partials/_signupModal.php';
     include 'partials/_loginModal.php';
    //  include 'partials/_handleLogin.php';
    //  include  'partials/_handleSignup.php';
    
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>
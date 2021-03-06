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
    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id"; 
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)){
       
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];

    }
        ?>
    <!-- form php -->

    <?php
        $showAlert=false;
        $method= $_SERVER['REQUEST_METHOD'];
        if($method=='POST')
        {
            
            $th_title=$_POST['title'];
            $th_desc=$_POST['desc'];
            $sno = $_POST['sno'];
            
      $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);
        
        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);
           
           $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
             VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert=true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          </div>';
            }
        }
    
    ?>



    <!-- form php end -->




    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-6">Welcome to <?php echo $catname  ?> forums</h1>

            <hr class="my-4">
            <p><?php echo $catdesc ?></p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button"> more</a>
            </p>
        </div>
    </div>

    <!-- form -->
    <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
echo '
    <div class="container">
        <form action="'. $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Ask a Question</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                    placeholder="Your question" required>

            </div>
            <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Describe Your Problem</label>
                <textarea class="form-control" required="required" id="desc" name="desc" rows="3" ></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>

    </div>';
}
else{
    echo 
    '<div class="container">
    <p>Logged in to ask question</p>
    </div>';

}
?>
    <!-- form -->
    <br>

    <div class="container">

        <h1 py-2>Browse Questions</h1>
        <?php
    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noResult=true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult=false;
        $id= $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $thread_user_id= $row['thread_user_id'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];

    
         echo '<div class="media my-3">
            <img class="mr-3" src="/iforum/pics/user.jpg" weidth="35px" height="35px" alt="image">
            <div class="media-body">
            <p class="font-weight-bold my-0"> Asked by: '. $posted_by.' at '. $thread_time. '</p>
                <h5 class="mt-0"> <a href="thread.php?threadid=' .$id. '"> '. $title .' </a> </h5>
                '. $desc .'
            </div>
        </div>';}
        if($noResult){
            echo " <hr><b> No questions, Be the first </b><hr>";
        }


?>
    </div>
    <hr>
    <hr>


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
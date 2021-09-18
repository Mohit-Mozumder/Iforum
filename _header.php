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

<body>
    <?php 
  session_start();
   echo '
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">iforum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                   
                   
    <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Categories
                </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
      $sql = "SELECT category_name, category_id FROM `categories`";
      $result = mysqli_query($conn, $sql); 
      while($row = mysqli_fetch_assoc($result)){
        echo '<a class="dropdown-item" href="threadlist.php?catid='. $row['category_id']. '">' . $row['category_name']. '</a>'; 
      }        
      echo '
      </div>
    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Contact</a>
                    </li>
                </ul>';
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                    echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
                      <input class="form-control mr-sm-2" name="search" type="search"  placeholder="Search" aria-label="Search">
                      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                      
                       <button type="button" class="btn btn-outline-secondary ml-2" disabled>'. $_SESSION['user_email'] .'</button>
   
                        <a href="/iforum/partials/_logout.php" class="btn btn-outline-success ml-2" >Logout
                        </a>
                     
                        </form>';
                  }
                  else{ 
                    echo '<form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                      </form>

                      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
                      <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>';
                    }
                   
            echo '
            </div>
        </div>
    </nav>';
     
     include 'partials/_signupModal.php';
     include 'partials/_loginModal.php';
    // include 'partials/_handleLogin.php';
     //include  'partials/_handleSignup.php';
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        
    } 
    else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){ 
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
    <strong>ERROR!</strong> password not matched/Email already in use.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>';
    }

if(isset($_GET['logout']) && $_GET['logout']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              <strong>Success!</strong> logout
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>';
          
      } 

     if(isset($_GET['login']) && $_GET['login']=="false"){ 
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>ERROR!</strong> password or username invalid.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>';

}

      
   
        ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</body>

</html>
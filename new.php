<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
echo '
    <div class="container">
        <form action=" echo $_SERVER["REQUEST_URI"]" method="post">

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Write your answer</label>

                <textarea class="form-control" required="required" id="comment" name="comment" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>

    </div>';
    
    }
    else{
    echo 
    '<div class="container">
    <h1 class="display-6">Logged in to ask question</h1>
    </div>';

}
    ?>
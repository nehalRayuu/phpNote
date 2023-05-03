<?php 
      $error="";
      $succ="";
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      include 'database.php';

      $username=  $_POST['username'];
      $password=$_POST['password'];

      
      
      if(!$username || !$password){
        $error='enter name or password';
    }
else{
      $sql= "select * from user where username= '$username'";
      $query=mysqli_query($conn,$sql);
      $num=mysqli_num_rows($query);
      
      if($num == 1){
        
        while($row = mysqli_fetch_assoc($query)){
            
            $hash= password_verify( $password,$row['password']);
            
            if($hash){
                      session_start();
                      $_SESSION["login"] = true;
                      $_SESSION["username"] = $username;
                      header( 'location:welcome.php');
            }
            else{
                $error = 'invalid password';
            }
        }
      }
      else{
        $error = 'invalid credentials';
      }
    }
  }

?>


<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  </head>
  <body>
    <?php 
     require 'navbar.php'
     ?>
       <?php
        if($error){

        
      echo " <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>$error</strong>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>" ;}



?>
    
    
    
    <div class="container-fluid">
     <form action="./login.php" method='post' >
  <div class="mb-3 my-5">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1">
   
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary">Login</button>
</form>

    </div>







    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    

  
  </body>
</html>
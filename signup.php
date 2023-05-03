
<?php 
$error= "";
$succ="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include 'database.php';
  $username = $_POST['name'];
  $password = $_POST['password'];

  if(!$username || !$password){
      $error='enter name or password';
  }
  else{
     
    $sql = "SELECT * FROM user WHERE username = '$username'";

    $query = mysqli_query($conn,$sql);

    $exists= mysqli_num_rows($query);
    if($exists > 0){
      $error= $exists;
    }
    else{
         $hashed = password_hash($password , PASSWORD_DEFAULT);
      $sql ="INSERT INTO user (username , password) VALUES ( '$username' , '$hashed')";
      $query=mysqli_query($conn,$sql);
      if($query){
             $succ='user created';
      }
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



?> <?php
if($succ){


echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>$succ</strong>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>" ;}



?> 
    
    
    
    <div class="container-fluid">
     <form action="./signup.php" method='post' >
  <div class="mb-3 my-5">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
    <div  class="form-text">Enter your name.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    </div>







    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    

  
  </body>
</html>


<?php 
    require './database.php';
     $error="";
     $succ="";
     if($_SERVER["REQUEST_METHOD"] == 'POST'){
       
       if(isset($_POST['idEdit'])){
        $title=$_POST['editTitle'];
        $note = $_POST['editNotes'];
        $id=$_POST['idEdit'];
 
        $sql ="update note set title='$title' , notes = '$note' where id='$id' ";
        $query=mysqli_query($conn,$sql);
 
        if($query){
         $succ = 'note updated';
        }







       }
      else{
        $title=$_POST['title'];
        $note = $_POST['notes'];
 
        $sql =" INSERT INTO note ( title, notes, date) VALUES ( '$title', '$note', current_timestamp())";
        $query=mysqli_query($conn,$sql);
 
        if($query){
         $succ = 'note added';
        }
        else{
         $error="something went wrong";
        }

      }
      
      
      
      
      
     



     }






     if(isset($_GET['delete'])){
       
      $id=$_GET['delete'];
      
     
      $sql= "delete from note where id = '$id'";
      $query=mysqli_query($conn,$sql);
      if($query){
        $succ='note deleted';
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script><link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  </head>
  <body>
    <?php 
     require 'navbar.php';
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
</div>" ;
}
?> 
    
    
    
    <div class="container-fluid my-5">
        
    <h5>Welcome to note keeper</h5>
    

     <form action="./welcome.php" method='post' >
  <div class="mb-3 my-5">
  <label for="exampleInputEmail1" class="form-label">Title :</label>
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder='give a title'>
    
    <label for="exampleInputEmail1" class="form-label">Notes :</label>
    <input type="text" name="notes" class="form-control" id="exampleInputEmail1" placeholder="enter notes....">

  </div>

  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

    </div>


    <div class="container">
    <table class="table" >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Notes</th>
    

      
    </tr>
  </thead>
  <tbody>
    <?php 
    require './database.php';
    $sqli="select * from note";
    $res=mysqli_query($conn,$sqli);
    $no=0;
    while($row=mysqli_fetch_assoc($res)){
      $no+=1;
      $id=$row['id'];
      
    echo " <tr>
      <th scope='row'>$no</th>
      <td>$row[title]</td>
      <td>$row[notes]</td>
      <td><button type='button' class='btn btn-primary update' id ='$id' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
      update
    </button></td>
      <td><button type='submit' class='btn btn-danger delete' id ='$id' >Delete</button></td>
      
    </tr>";
    }
    ?>
  </tbody>
</table>


    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="./welcome.php?update=true" method='post' >
        <input type="hidden" name="idEdit" id='idEdit'>
      <div class="modal-body">
    <div class="mb-3 my-5">
    <label for="exampleInputEmail1" class="form-label">Title :</label>
    <input type="text" id="editTitle" name="editTitle" class="form-control" id="exampleInputEmail1" placeholder='give a title'>
    
    <label for="exampleInputEmail1" class="form-label">Notes :</label>
    <input type="text" id="editNotes" name="editNotes" class="form-control" id="exampleInputEmail1" placeholder="enter notes....">
    
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary ">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       </form>
      </div>
    </div>
  </div>
</div>
  




    <script>
     let del =document.getElementsByClassName('delete');
     Array.from(del).forEach((btn)=>{
      btn.addEventListener('click',(e)=>{
             id = e.target.id


             if(confirm("Are you sure you want to delete this note!")){
              window.location=`/php/project/welcome.php?delete=${id}`;
             }
            
      })
     })





     let upd =document.getElementsByClassName('update');
     Array.from(upd).forEach((btn)=>{
      btn.addEventListener('click',(e)=>{
             let tr = e.target.parentNode.parentNode;
             title= tr.getElementsByTagName('td')[0].innerText;
             notes= tr.getElementsByTagName('td')[1].innerText;
             editNotes.value =notes;
             editTitle.value= title;
              idEdit.value =  e.target.id
            


             
            
      })
     })





















    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
    

  
  </body>
</html>

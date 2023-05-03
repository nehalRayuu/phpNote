
  <?php 
  $login=false;
  session_start();
  if(isset($_SESSION["login"] ) && $_SESSION['login'] == true ){
           $login = true;
  }
 
  
  
  










  echo " <nav class='navbar navbar-expand-lg bg-body-tertiary'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='#'>Note Keeper</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNav'>
      <ul class='navbar-nav'>";
         if(!$login){
          echo"
        <li class='nav-item'>
          <a class='nav-link ' aria-current='page' href='/php/project/signup.php'>Signup</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='/php/project/login.php'>Login</a>
        </li> ";
         }
        if($login){
        echo " <li class='nav-item'>
          <a class='nav-link' href='/php/project/logout.php'>Logout</a>
        </li>";

        }
        echo "
      </ul>
    </div>
  </div>
</nav>
   ";

?>







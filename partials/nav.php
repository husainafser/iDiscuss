<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
          $sql="SELECT category_name,category_id FROM `categories` LIMIT 3";
          $result = mysqli_query($conn,$sql);
          while($row= mysqli_fetch_assoc($result)){
            $categoryid=$row["category_id"];
        echo  '<li><a class="dropdown-item" href="threads.php?catid='.$categoryid.'">'.$row["category_name"].'</a></li>';
          }
          
       echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
    </ul>';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
       echo '<form class="d-flex">
       <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
       <button class="btn btn-outline-success mx-1" type="submit">Search</button>
      <button class=" btn btn-outline-primary text-primary my-1 mx-1"> '.$_SESSION['username'].' </button>
     </form>
     <a href="partials/logout.php" class="btn btn-outline-danger mx-2" >LogOut</a>';
    }
    else{
     echo '<form class="d-flex" action="search.php" method="get">
     <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
     <button class="btn btn-outline-success" type="submit">Search</button>
     </form>
     <button class="btn btn-outline-success mx-2"  data-bs-toggle="modal" data-bs-target="#loginModal">login</button>
       <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
    }
     echo '</div>
          </div>
         </nav>';
         
 include 'partials/dbconnect.php';
 include 'partials/login.php';
 include 'partials/signup.php';
 
 if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
   echo '<div class=" my-0 alert alert-success alert-dismissible fade show" role="alert">
   <strong>Boom!</strong> Your account has been created !
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
 }
 if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false") {
  echo '<div class=" my-0 alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Warning!</strong> Your account has not been created !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
 if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true") {
  echo '<div class=" my-0 alert alert-success alert-dismissible fade show" role="alert">
   <strong>Boom!</strong> Your account has been created !
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false") {
  echo '<div class=" my-0 alert alert-danger alert-dismissible fade show" role="alert">
   <strong>Warning!</strong> Wrong credentials !
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';
}
 
?>
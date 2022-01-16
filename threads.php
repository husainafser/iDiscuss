<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <title>Threads</title>
  </head>
  <body>
  <?php include 'partials/dbconnect.php'; ?>
  <?php include 'partials/nav.php';?>
  
  <?php
  $id=$_GET['catid'];
  $sql="SELECT * FROM `categories` WHERE category_id=$id";
  $result=mysqli_query($conn,$sql);
while( $row=mysqli_fetch_assoc($result)){
    $categoryname=$row["category_name"];
    $categorydescription=$row["category_description"];
  }
  ?>
<?php
$method=$_SERVER['REQUEST_METHOD'];
  if($method=='POST'){
    // insert thread into database
    $th_title=$_POST['title'];
    $th_description=$_POST['description'];
    $th_title= str_replace("<","&lt;",$th_title);
    $th_title= str_replace(">","&gt;",$th_title);
    $th_description= str_replace(">","&gt;",$th_description);
    $th_description= str_replace("<","&lt;",$th_description);
    $sno=$_POST['sno'];
    $sql="INSERT INTO `threads` (`thread_title`,`thread_description`,`thread_cat_id`,`thread_user_id`,`created`) VALUES ('$th_title','$th_description','$id','$sno',current_timestamp())";
    $result=mysqli_query($conn,$sql);
  }
?>
  <div class="bg-dark" >
    <div class="container col d-flex justify-content-center ">
    <div class="col-md-8 my-5">
        <div class="h-100 p-5 text-white bg-success rounded-3 my-2">
          <h2><?php echo $categoryname;?> Forum</h2>
          <p><?php echo $categorydescription;?></p>
          <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
     echo '<p><button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               Ask question !
             </button>
          </p>
<div class="collapse" id="collapseExample">
  <div class="bg-dark p-3">
  <!-- REQUEST_URI will submits the form at same page with full url -->
<form action="'. $_SERVER["REQUEST_URI"].'" method="POST" >
                   <div class="mb-3">
                   <label for="exampleInputEmail1" class="form-label">Question Title</label>
                   <input type="text" class="form-control" id="title" name="title"aria-describedby="emailHelp">
                   <div id="emailHelp" class="form-text"><b>Please be short n crisp !</b></div>

                      </div>
                      <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Describe ur concern !</label>
                      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                       <input type="hidden" name="sno" value=" '.$_SESSION['sno'].'  ">
                       <button type="submit" class="btn btn-primary">Submit</button>
                           </form>
    </div>
</div>';}
else {
 echo '<p><button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               Ask question !
             </button>
          </p>
<div class="collapse" id="collapseExample">
  <div class="bg-dark p-3">
  <p class="text-danger">You have to logged in first !</p>
  <button class="btn btn-outline-primary mx-2"  data-bs-toggle="modal" data-bs-target="#loginModal">login</button>
       <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
    </div>
</div>';
}
?>
        </div>
      </div>
    </div>
    <h2 class="text-light container my-3 mt-4 h-100  text-white">THREADS</h2>
  <?php
  $id=$_GET['catid'];
  $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
  $result=mysqli_query($conn,$sql);
  $noresult=true;
while( $row=mysqli_fetch_assoc($result)){
  $noresult=false;
    $id=$row["thread_id"];
    $threadtitle=$row["thread_title"];
    $threaddescription=$row["thread_description"];
    $thread_user_id=$row['thread_user_id'];
    $sql2="SELECT user_name FROM `user` WHERE sno='$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);

    echo '<div class="container my-3 mt-4 h-100 p-2 text-white bg-secondary rounded-3 pagination">
    <div class="media">
    <img src="user.jpg" class="mr-3 rounded-3" width=50px alt="...">
    <p class="font-weight-bold text-info"><b>'.$row2['user_name'].'</b></p>
    <div class="media-body">
      <h5 class="mt-1"> <a href="thread.php?threadid='.$id.'" class="text-dark"> '.$threadtitle.' </a></h5>
       '.substr($threaddescription,0,90).'<a href="thread.php?threadid='.$id.'" class="text-light">... read more</a>
    </div>
    </div>
          </div>';}
          if ($noresult) {
            echo '<div class="bg-dark mb-3" >
            <div class="container col d-flex justify-content-center my-3">
            <div class="col-md-8">
                <div class="h-100 p-5 text-white bg-secondary rounded-3 my-2">
                  <h2 class="text-light"><b>Sorry !</h2>
                  <p><h3>No threads are found !</h3></p>
                 
            
                </div>
              </div>
            </div>';
          }
        
        
  ?>
  
       
<footer>
    <?php include 'partials/footer.php';?>
</footer>
</div>
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>>
  </body>
    
</html>

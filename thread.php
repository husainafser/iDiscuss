<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Threads</title>
  </head>
  <body>
  <?php include 'partials/dbconnect.php'; ?>
  <?php include 'partials/nav.php';?>
  <?php
  $id=$_GET['threadid'];
  $sql="SELECT * FROM `threads` WHERE thread_id=$id";
  $result=mysqli_query($conn,$sql);
while( $row=mysqli_fetch_assoc($result)){
    $threadtitle=$row["thread_title"];
    $threaddescription=$row["thread_description"];
    $thread_user_id=$row['thread_user_id'];
    $sql2="SELECT user_name FROM `user` WHERE sno='$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $posted_by=$row2['user_name'];
  }
  ?>
  <?php
$method=$_SERVER['REQUEST_METHOD'];
  if($method=='POST'){
    // insert comments into database
    $th_comment=$_POST['comment'];
    $th_comment= str_replace("<","&lt;",$th_comment);
    $th_comment= str_replace(">","&gt;",$th_comment);
    $sno=$_POST['sno'];
    // INSERT INTO `comments` (`comment_id`, `comment_description`, `thread_id`, `comment_by`, `created`) VALUES (NULL, 'this is acomment', '1', '0', current_timestamp());
    $sql="INSERT INTO `comments` (`comment_description`, `thread_id`,`comment_by`) VALUES ('$th_comment','$id','$sno')";
    $result=mysqli_query($conn,$sql);
  }
?>
  <div class="bg-dark" >
    <div class="container col d-flex justify-content-center ">
    <div class="col-md-8 my-5">
        <div class="h-100 p-5 text-white bg-success rounded-3 my-2">
          <h2 class="text-dark my-4"><?php echo $threadtitle; ?></h2>
          <p><?php echo $threaddescription;?></p>
          <div class="d-flex">
          <p class="my-4 text-dark"><b>Posted By:-</b></p> <?php echo'<p class="my-4 mx-1 text-info"><b> '.$posted_by.'</b> </p>'; ?>
          </div>
          <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){ 
         echo '<p><button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
               Post comment !
             </button>
          </p>
<div class="collapse" id="collapseExample">
  <div class="bg-dark p-3">
  <!-- REQUEST_URI will submits the form at same page with full url -->
<form action="'. $_SERVER['REQUEST_URI'].'" method="POST" >
                  
                      <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Type your comment !</label>
                      <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                      <input type="hidden" name="sno" value=" '.$_SESSION['sno'].'  ">
                    </div>
                      
                       <button type="submit" class="btn btn-primary">Submit</button>
                           </form>
    </div>
</div>';
          }
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
    <h2 class="text-light container my-3 mt-4 h-100  text-white">COMMENTS</h2>
    <?php
  $id=$_GET['threadid'];
  $sql="SELECT * FROM `comments` WHERE thread_id=$id";
  $result=mysqli_query($conn,$sql);
  $nocomment=true;
while( $row=mysqli_fetch_assoc($result)){
    $nocomment=false;
    $id=$row["comment_id"];
    $commentdescription=$row["comment_description"];
    $commentby=$row['comment_by'];
    $sql2="SELECT user_name FROM `user` WHERE sno='$commentby'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    echo '<div class="container my-3 mt-4 h-100 p-2 text-white bg-secondary rounded-3">
    <div class="media">
    <img src="user.jpg" class="mr-3 rounded-3" width=50px alt="...">
    <p class="font-weight-bold my-0 text-info"><b>'.$row2['user_name'].'</b></p>
    <div class="media-body">
      <p class="text-dark">'.$commentdescription.'</p>
      
    </div>
    </div>
    </div>';}

          if ($nocomment) {
            echo '<div class="bg-dark mb-3" >
                    <div class="container col d-flex justify-content-center my-3">
                    <div class="col-md-8">
                        <div class="h-100 p-5 text-white bg-secondary rounded-3 my-2">
                          <h2 class="text-light"><b>Sorry !</h2>
                          <p><h3>No comments found !</h3></p>
                        </div>
                      </div>
                    </div>';
          }
  ?>

    <!-- <?php
    if ($noanswer) {
      echo '<div class="bg-dark mb-3" >
              <div class="container col d-flex justify-content-center my-3">
              <div class="col-md-8">
                  <div class="h-100 p-5 text-white bg-secondary rounded-3 my-2">
                    <h2 class="text-light"><b>Sorry !</h2>
                    <p><h3>No comments found !</h3></p>
                  </div>
                </div>
              </div>';
    }
    ?> -->

       
<footer>
    <?php include 'partials/footer.php';?>
</footer>
</div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
    
</html>

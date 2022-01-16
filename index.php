<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Vartalaab</title>
  </head>
  <body>
  <?php include 'partials/dbconnect.php';?>
  <?php include 'partials/nav.php';?>
  <!-- crousel starts from here -->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="photo-1634712037516-bde0f7cdb3d8 (1).jpg" class="d-block w-100" alt="image">
    </div>
    <div class="carousel-item">
      <img src="c2.jpg" class="d-block w-100" alt="image">
    </div>
    <div class="carousel-item">
      <img src="c3.jpg" class="d-block w-100" alt="image">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- card starts from here -->
    <div class="container my-3  ">
      <h2 class="text-center ">Categories</h2>
    
      <div class="row">
        <?php
        $sql="SELECT * FROM `categories`";
        $result= mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
          // echo $row['category_id'];
          // echo $row['category_name'];
          $categoryid=$row["category_id"];
          $categoryname=$row["category_name"];
          $categorydescription=$row["category_description"];
         echo '<div class="col-md-4 my-3 col d-flex justify-content-center">
          <div class="card" style="width: 18rem;">
          <img src="card.jpg" class="card-img-top" alt="...">
          <div class="card-body">
          <h5 class="card-title"><a href="threads.php?catid='.$categoryid.'">'.$categoryname.'</a></h5>
          <p class="card-text">'.substr($categorydescription,0,90).'...</p>
          <a href="threads.php?catid='.$categoryid.'" class="btn btn-primary">View Threads</a>
          </div>
          </div>
         </div>';
        }
        ?>
        </div> 
        </div>
        
       
<footer>
    <?php include 'partials/footer.php';?>
    </footer>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
    
</html>

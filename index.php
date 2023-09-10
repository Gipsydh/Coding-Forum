<?php if(isset($_GET['login'])&&$_GET['login']==true){
    session_start();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coding Clan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php include './partials/_dbconnect.php'?>
    <?php include './partials/_navbar.php'?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://source.unsplash.com/2400x700/?coding,google" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://source.unsplash.com/2400x700/?coding,microsoft" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://source.unsplash.com/2400x700/?coding,programming" class="d-block w-100" alt="...">
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
    <div class="container">
      <h2 class="text-center" style="margin: 20px 0;">Welcome to Code Clan</h2>
      <div class="container row">
        <?php
          $sql="SELECT * FROM `codingforum_categories`";
          $result=mysqli_query($con,$sql);
          while($row=mysqli_fetch_assoc($result)){
            $desc=$row['categories_description'];
            $catid=$row['categories_sno'];
            echo '
            <div class="col-md-4">
              <div class="card" style="width: 18rem; margin: 20px;">
                <img src="https://source.unsplash.com/500x500/?coding,'.$row['categories_title'].'" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">'.$row['categories_title'].'</h5>
                  <p class="card-text">'.substr($desc,0,90).'...</p>
                  <a href="thread_list.php?catid='.$catid.'" class="btn btn-primary">View group</a>
                </div>
              </div>
            </div>';
          }
        ?>
      </div>
    </div>
    <?php include './partials/_footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>


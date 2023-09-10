<?php session_start();?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coding Clan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body>
  <?php include './partials/_dbconnect.php'?>
  <?php include './partials/_navbar.php'?>
  <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `codingforum_categories`WHERE categories_sno=$id";
    $result=mysqli_query($con,$sql);
    while($row =mysqli_fetch_assoc($result)){
      $catname=$row['categories_title'];
      $catdesc=$row['categories_description'];

    }
  ?>
  <?php
    $isSubmit=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $thread_title=$_POST['thread_title'];
      $thread_desc=$_POST['thread_desc'];
      if(isset($_SESSION['userEmail'])){
          
      $userEmail=$_SESSION['userEmail'];
      $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$thread_title', '$thread_desc', '$id', '$userEmail', current_timestamp())";
      mysqli_query($con,$sql);
      $isSubmit=true;
      if($isSubmit){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your thread has been added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
      }
      else{
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error
        !</strong> Please login at first then you are able to add a thread.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }
  ?>
  <div class="container" style="margin: 20px auto;">
    <div class="jumbotron">
      <h1 class="display-4">Welcome to <?php echo $catname ?> forum</h1>
      <p class="lead"></p>
      <hr class="my-4">
      <p> <?php echo $catdesc ?> </p>
      <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
      </p>
    </div>
  </div>
  <div class="container">
    <h2 style="margin:20px 0;font-weight:bold;">Browse Questions</h2>
    <?php
    $isEmpty=true;
    $id=$_GET['catid'];
    $sql="SELECT * FROM `threads`WHERE thread_cat_id=$id";
    $result=mysqli_query($con,$sql);
    while($row =mysqli_fetch_assoc($result)){
      $isEmpty=false;
      $thread_title=$row['thread_title'];
      $thread_desc=$row['thread_desc'];
      $userEmail=$row['thread_user_id'];
      $thread_id=$row['thread_id']; 
      $sql1="SELECT * FROM `users_forum` WHERE user_email='$userEmail'";
      $result1=mysqli_query($con,$sql1);
      $row1=mysqli_fetch_assoc($result1);
      $userName=$row1['user_name'];
      
     echo  '<div class="media">
        <img class="mr-3" src="./resources/user_default.png" width="50px" alt="Generic placeholder image">
        <div class="media-body">
          <h5 class="mt-1" style="font-weight:bold;margin:0px 0;"><a href="thread.php?threadid='.$thread_id.'&username='.$userName.'">'.$thread_title.'</a></h5>
          '.$thread_desc.'<br>
          <p style="font-size:13px;color:gray;">'.$userName.'</p>
        </div>
        </div>
     ';

    }
    if($isEmpty){
      echo '<div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">No threads found</h1>
        <p class="lead">You are the first one to strat discussion</p>
      </div>
    </div>';
    }
    ?>

  </div>
  <div class="container">
    <h2 style="margin-top: 30px; font-weight: bold;">Your Discussion</h2>
    <form action="<?php echo $_SERVER['REQUEST_URI']?>" style="margin-bottom: 100px;" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Problem title</label>
      <input type="text" class="form-control" id="thread_title" name="thread_title" aria-describedby="emailHelp" placeholder="" required>
      <small id="emailHelp" class="form-text text-muted">you should write your problem as short and crisp as possible.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Description</label>
      <textarea class="form-control" id="thread_desc" name='thread_desc' rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
  
  <?php include './partials/_footer.php'?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
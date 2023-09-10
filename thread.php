<?php session_start();?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coding Clan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <?php include './partials/_dbconnect.php'?>
  <?php include './partials/_navbar.php'?>
  <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads`WHERE thread_id=$id";
    $result=mysqli_query($con,$sql);
    while($row =mysqli_fetch_assoc($result)){
      $thread_title=$row['thread_title'];
      $thread_desc=$row['thread_desc'];

    }
  ?>
  <?php
    $isSubmit=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_SESSION['userEmail'])){
            
      $comment=$_POST['comment'];
      $userEmail=$_SESSION['userEmail'];
      $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ( '$comment', '$id', current_timestamp(), '$userEmail')";
     mysqli_query($con,$sql);
      $isSubmit=true;
        }
        else{
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Please first log in to your profile then you can add a comment.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        }

      if($isSubmit){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your thread has been added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }
  ?>
  <div class="container" style="margin:20px auto;">
    <div class="jumbotron">
      <h1 class="display-4"><?php echo $thread_title?></h1>
      <p class="lead"></p>
      <hr class="my-4">
      <p> <?php echo $thread_desc?> </p>
      <p class="lead">
        <p>posted by <?php echo '<span style="font-weight:bold;">'.$_GET['username'].'</span>';?></p>
      </p>
    </div>
  </div>
  <div class="container">
  <h2 style="margin-top: 30px; font-weight: bold;">Your Discussion</h2>
    <form action="<?php echo $_SERVER['REQUEST_URI']?>" style="margin-bottom: 100px;" method="post">
   
    <div class="form-group">
      <label for="exampleInputPassword1">Type your comment</label>
      <textarea class="form-control" id="comment" name='comment' rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Post Comment</button>
  </form>
  </div>
  <div class="container">
    <h2 style="margin:20px 0;font-weight:bold;">Other's Discussion</h2>
    <?php
      $id=$_GET['threadid'];
      $sql="SELECT * FROM `comments` WHERE thread_id=$id";
      $result=mysqli_query($con,$sql);
      $noResult=true;
      while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id=$row['comment_id'];
        $comment=$row['comment_content'];
        $userName=$row['comment_by'];
        $sql1="SELECT * FROM `users_forum` WHERE user_email='$userName'";
        $result1=mysqli_query($con,$sql1);
        $row1=mysqli_fetch_assoc($result1);
        $name= $row1['user_name'];
        echo  '<div class="media" style="margin:10px 0;">
        <img class="mr-3" src="./resources/user_default.png" width="50px" alt="Generic placeholder image">
        <div class="media-body">
          <p class="font-weight-bold my-0">'.$name.'</p>
          '.$comment.'
        </div>
        </div>';
      }
      if($noResult==true){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No Comments found</h1>
        </div>
      </div>';
      }
    ?>
  </div>
  <div class="marginBtm" style="margin-bottom:100px">

  </div>
  <?php include './partials/_footer.php'?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
<?php


    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Coding clan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./partials/about.php">About</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Explore
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Contact</a>
            </li>
          </ul>
          <form class="d-flex my-0" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>';
         
          if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
            echo '<p class="text-white text-center my-0" style="margin:0 20px;">  '.$_SESSION['username']
            .'</p><button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#logoutModal">log Out</button>';
          }
          else{
            echo '
            <div class="mx-2">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signUpModal">sign Up</button>
                <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#loginModal">log in</button>
    
              </div>';}
            echo '</div>
          </div>
        </nav>';
        include 'loginModal.php';
        include 'signUpModal.php';
        include 'logoutModal.php';
        
    if(isset($_GET['successSignUp'])&&$_GET['successSignUp']=="true"){
      echo '<div class="alert my-0 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your accout is created successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    else if(isset($_GET['successSignUp'])&&$_GET['successSignUp']=="false"){
      echo '<div class="alert my-0 alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '.$_GET['error'].'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
?>
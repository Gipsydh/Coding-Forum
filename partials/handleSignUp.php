<?php
 $showError="true";
if($_SERVER['REQUEST_METHOD']=="POST"){
     include '_dbconnect.php';
    $username=$_POST['username'];
    $user_email=$_POST['user_email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
   
    $existsql="SELECT * FROM `users_forum` WHERE user_email='$user_email'";
    $result=mysqli_query($con, $existsql);
    $numRows=mysqli_num_rows($result);
    if($numRows==1){
        $showError="this email id is already exists";
    }
    else{
        if($password==$cpassword){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users_forum` (`user_name`, `user_email`, `user_password`, `timestamp`) VALUES ('$username', '$user_email', '$hash', CURRENT_TIME())";
            $result=mysqli_query($con,$sql);
            header("Location: ../index.php?successSignUp=true");
            exit();
        }
        else{
            $showError="password and confirm password should be same";
        }
    }
    header("Location: ../index.php?successSignUp=false&error=$showError");
}



?>
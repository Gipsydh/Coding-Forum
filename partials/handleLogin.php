<?php
 $showError="true";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
   $email=$_POST['loginEmail'];
   $password=$_POST['loginPassword'];
//    $pass=password_hash($password,PASSWORD_DEFAULT);
   $sql="SELECT * FROM `users_forum` WHERE user_email='$email'";
   $result=mysqli_query($con,$sql);
   $numRows=mysqli_num_rows($result);
   if($numRows==1){
       $row=mysqli_fetch_assoc($result);
       if(password_verify($password, $row['user_password'])){
           session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['userEmail']=$email;
                $_SESSION['username']=$row['user_name'];
           }
        }
       echo '<script> window.location.href = "../index.php?login=true" </script>';
}
?>
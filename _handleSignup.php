<?php
$showError=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $email=$_POST['signupEmail'];
    $password=$_POST['signupPassword'];
    $cpassword=$_POST['csignupPassword'];
    $existSql="select * from `users` where email='$email'";
    $result=mysqli_query($conn,$existSql);
    $numRows=mysqli_num_rows($result);
    if($numRows>0){
        $showError='email already in use';
    }
    else{
        if($password==$cpassword){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`email`, `password`, `tstamp`) VALUES ('$email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
                header('Location:/index.php?signupsuccess=true');
                exit();
            }
        }
        else{
            $showError="passwords do not match";
        }
    }
    header('Location:/index.php?signupsuccess=false&error=$showError');
}
?>
<?php
$showError=false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbconnect.php';
    $email=$_POST['loginEmail'];
    $password=$_POST['loginPassword'];
    $sql="SELECT * from `users` WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    if($numRows==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password,$row['password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['email']=$email;
            $_SESSION['sno']=$row['sno'];
            header('Location:/index.php');
        }
    }
    header('Location:/index.php');
}
?>
<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/">iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/about.php">About</a>
    </li>
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Top Categories
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
    include '_dbconnect.php';
    $sql="SELECT category_name,category_id FROM `categories` LIMIT 3";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
      echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
    }
    echo '</div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/contact.php">Contact Us</a>
    </li>
  </ul>';

  if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
    echo '  <form class="form-inline my-2 my-lg-0" method="get" action="/search.php">
    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    <p class="text-light my-0 mx-2">Welcome '.$_SESSION['email'].'</p>
    <a href="/partials/_logout.php" style="color:white; text-decoration:none;"><button class="btn btn-success mx-1" >Log Out</</button></a>
  </form>';
  }
  else{
    echo '<button class="btn btn-outline-success mx-1"  data-toggle="modal" data-target="#loginModal">Log In</button>
    <button class="btn btn-outline-success mx-1"  data-toggle="modal" data-target="#signupModal">Sign Up</button>';
  }
echo '</div>
</nav>';
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']==true){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> Your account has been created.You can now log in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>

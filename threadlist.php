<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>iDicuss - Coding Forum</title>
</head>
<body>
    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/_header.php' ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>
    <?php
    $showAlert=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$_POST['title'];
        $title=str_replace("<","&lt;",$title);
        $title=str_replace(">","&gt;",$title);
        $desc=$_POST['desc'];
        $desc=str_replace("<","&lt;",$desc);
        $desc=str_replace(">","&gt;",$desc);
        $sno=$_POST['sno'];
        $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `tstamp`) VALUES ('$title', '$desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your question has been posted successfully! Please wait for community to response.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }

    }
    ?>
    <!-- Category Container Starts Here -->
    <div class="container my-4">
        <div class="jumbotron" style="border-radius: 20px;">
            <h1 class="display-4">Welcome to <?php echo $catname; ?>!</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <ul class="forum-rules">
                <h1>Forum Rules</h1>
                <li>No Spam / Advertising / Self-promote in the forums. ...</li>
                <li>Do not post copyright-infringing material. ..</li>
                <li>Do not post “offensive” posts, links or images. ...</li>
                <li>Do not cross post questions. ...</li>
                <li>Do not PM users asking for help. ...</li>
                <li>Remain respectful of other members at all times.</li>
            </ul>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <div class="container my-3">
        <h1>Start a discussion</h1>
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group">
                <label for="title">Problem Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Make Your Title As Crisp As Possible.</small>
            </div>
            <input type="hidden" name="sno" value="<?php $_SESSION['sno']?>">
            <div class="form-group">
                <label for="concern">Elaborate Your Concern</label>
                <textarea class="form-control" name="desc" id="desc" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Question</button>
        </form>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time=$row['tstamp'];
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT email from `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        echo '<div class="media my-3">
            <img src="https://icon2.cleanpng.com/20180920/att/kisspng-user-logo-information-service-design-5ba34f886b6700.1362345615374293844399.jpg" width="50px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a href="/thread.php?thread_id=' . $id . '">' . $title . '</a></h5>
                <p class="float-right my-0">Asked by '.$row2['email'].' at '.$thread_time.'</p>
                <p>' . $desc . '</p>
            </div>
        </div>';
    }
    if ($noResult) {
        echo '<div class="jumbotron jumbotron-fluid my-3" style="border-radius:20px;">
            <div class="container" width="500px">
              <h1 class="display-4">No threads found!</h1>
              <p class="lead">Be the first person to ask a question.</p>
            </div>
          </div>';
    }
    ?>
    </div>
    <?php include 'partials/_footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
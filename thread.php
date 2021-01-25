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
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id=$row['thread_user_id']; 

        $sql2="SELECT email from `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $posted_by=$row2['email'];
    }
    ?>
    <?php
     $showAlert=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $comment=$_POST['comment'];
        $comment=str_replace("<","&lt;",$comment);
        $comment=str_replace(">","&gt;",$comment);
        $sno=$_POST['sno'];
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your question has been posted successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }

    }
    ?>
    <!-- Category Container Starts Here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?>!</h1>
            <p class="lead"><?php echo $desc; ?></p>
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
            <p>Posted By - <b><?php echo $posted_by?></b></p>
        </div>
    </div>

    <div class="container my-3">
        <h1>Post a Comment</h1>
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group">
                <label for="concern">Add Comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
                <input type="hidden" name="sno" value="<?php $_SESSION['sno'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>

    <div class="container my-3">
        <h1>Discussions</h1>
        <?php
        $noResult=true;
        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult=false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time=$row['comment_time'];
            $comment_by=$row['comment_by'];

            $sql2="SELECT email from `users` WHERE sno='$comment_by'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);

            echo '  <div class="media">
            <img src="https://icon2.cleanpng.com/20180920/att/kisspng-user-logo-information-service-design-5ba34f886b6700.1362345615374293844399.jpg" width="50px" class="mr-3" alt="...">
            <div class="media-body">
            <p class="font-weight-bold my-0">'.$row2['email'].' </p>
            <p class="float-right my-0">Posted at '.$comment_time.'</p>
                <p class="my-0">'.$content.'</p>
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
<?php

// If there is no id, redirect to index page
if(!isset($_GET['id']))
{
    Helper::redirect('index.php');
}

// If id value is empty or white space
if(empty($_GET['id']) || $_GET['id'] == " ")
{
    Helper::redirect('index.php');
}

// if there is id and if invalid redirect to index page
if($_GET['id'])
{
    $id = base64_decode($app->photo->clean_data($_GET['id']));
    if (!$app->photo->data_exists('photo_id', $id)) {
        Helper::redirect('index.php');

    }
}

// check if user is logged in or not
$signed = "";
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    $signed = true;
}else{
    $signed = false;
}

$photo = $app->photo->fetch_selected_column(["*"], "photo_id", "=", $id, 1);



// check if form have been submitted
$message="";
if(isset($_POST['submit']))
{
    // if not signed in show message and login link.
    if($signed != true)
    {
        $message = "<div class='alert alert-danger'>You are not logged in. Please <a href='admin/login.php'>Login</a> to Comment.</div>";
    }

    // if the comment section is blank
    if(empty($_POST['comm_body']))
    {
        $message = "<div class='alert alert-danger'>Please enter a comment. Don't leave blank space.</div>";
    }else
    {
        $comment_array =
            [
                'comm_image_id' => $id,
                'comm_author_id' => $_SESSION['user_id'],
                'comm_body' => strip_tags($app->photo->clean_data($_POST['comm_body']))
            ];

        if($app->comment->create_comment($comment_array))
        {
            Helper::redirect("photo.php?id=".base64_encode($id));
            $message = "<div class='alert alert-success'>thank you for commenting.</div>";
        }
    }
}

?>

    <?php echo $message; ?>
    <!-- Blog Post -->
    <!-- Title -->
    <h1><?php echo ucfirst($photo->photo_title); ?></h1>

    <!-- Author -->

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $photo->photo_date;  ?></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="images/<?php echo $photo->photo_filename ?>" alt="<?php echo $photo->photo_alt_text ?>">

    <hr>

    <!-- Post Content -->
    <p class="lead"><?php echo Helper::html_entity_decode($photo->photo_description); ?></p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->

    <div class="well">

        <?php echo (($signed == true)? "" :"Please Login in to comment"); ?>

        <h4>Leave a Comment:</h4>
        <form action="" method="post" role="form">
            <div class="form-group">
                <textarea name="comm_body" class="form-control" rows="3" <?php echo (($signed == true) ? "": "disabled"); ?>></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <hr>
    <!-- Posted Comments -->


<?php
$comments = $app->comment->find_comments($photo->photo_id);

foreach($comments as $comment){
    ?>
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><a href="<?php echo $comment->user_id; ?>"><?php echo ucfirst($comment->user_name); ?></a>
                <small><?php echo ($comment->comm_date); ?></small>
            </h4>
            <?php echo $comment->comm_body; ?>
        </div>
    </div>
    <!-- Comment -->
<?php } ?>
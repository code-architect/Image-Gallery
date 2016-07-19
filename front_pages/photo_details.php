<?php

if(isset($_POST['submit']))
{
    echo "you have submitted<br>";
}
if(!isset($_SESSION['user_id']))
{
    echo "you have to login to comment";
}

?>

<?php
$image = $app->photo->fetch_selected_column(["*"], "photo_id", "=", 5 , 1);
?>
    <!-- Blog Post -->
    http://startbootstrap.com/
    <!-- Title -->
    <h1><?php echo $image->photo_title ?></h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">Start Bootstrap</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $image->photo_date;  ?></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="images/<?php echo $image->photo_filename ?>" alt="<?php echo $image->photo_alt_text ?>">

    <hr>

    <!-- Post Content -->
    <p class="lead"><?php echo Helper::html_entity_decode($image->photo_description); ?></p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->

    <div class="well">
        <h4>Leave a Comment:</h4>
        <form action="" method="post" role="form">
            <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <hr>
    <!-- Posted Comments -->


<?php
$comments = $app->comment->find_comments($image->photo_id);

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
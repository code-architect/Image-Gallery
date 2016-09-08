<?php
// get all the images
try {
    $images = $app->photo->find_all_images('DESC');
}catch(Exception $e)
{
    include_once('404.php');
}
?>


<!-- Projects Row -->
<div class="row">
    <?php foreach($images as $image){ ?>


    <div class="col-md-4 portfolio-item">
        <a href="photo.php?id=<?php echo base64_encode($image->photo_id); ?>">
            <img class="img-responsive" src="images/<?php echo $image->photo_filename ?>" alt="<?php echo $image->photo_alt_text ?>">
        </a>
        <h3>
            <a href="photo.php?id=<?php echo base64_encode($image->photo_id); ?>"><?php echo $image->photo_title; ?></a>
        </h3>
    </div>


    <?php } ?>
</div>
<!-- /.row -->



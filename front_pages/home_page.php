<?php
// get all the images
try {
    $images = $app->photo->find_all_images('DESC');
}catch(Exception $e)
{
    include_once('404.php');
}
/*
?>
<!-- Blog Post Content Column -->
<div class="col-lg-12">
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

</div> <?php */ ?>
<!-- /.row -->



        <!-- Slider -->
        <div class="row">
            <div class="col-sm-12" id="slider-thumbs">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                    <div class="thumbnails row">

                    <?php foreach($images as $image){ ?>

                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <a class="thumbnail" href="photo.php?id=<?php echo base64_encode($image->photo_id); ?>">
                                <img class="img-responsive home_page_photo" src="images/<?php echo $image->photo_filename; ?>" alt="<?php echo $image->photo_alt_text; ?>">
                            </a>
                        </div>

                    <?php } ?>
                    </div>
                </ul>
            </div>

            <!--/Slider-->
        </div>





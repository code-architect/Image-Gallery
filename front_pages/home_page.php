<?php
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$pagination = new Pagination($page);

// get all the images
try {
    $images = $pagination->front_page_images_to_show('DESC');
}catch(Exception $e)
{
    include_once('404.php');
}


?>
<!-- /.row -->



        <!-- Slider -->
        <div class="row">
            <div class="col-sm-12" id="slider-thumbs">
                <!-- Bottom switcher of slider -->
                    <div class="thumbnails row">

                    <?php foreach($images as $image){ ?>

                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <a class="thumbnail" href="photo.php?id=<?php echo base64_encode($image->photo_id); ?>">
                                <img class="img-responsive home_page_photo" src="images/<?php echo $image->photo_filename; ?>" alt="<?php echo $image->photo_alt_text; ?>">
                            </a>
                        </div>

                    <?php } ?>

                    </div>
            </div>

            <ul class = "pager">
            <?php
            // show if there are results to be shown
            if($pagination->page_total() > 1){

                // if there is more data in the next page, show next button
                if($pagination->has_next())
                {
                    echo "<li class = 'next'><a href = 'index.php?page={$pagination->next()}'>Newer &rarr;</a></li>";
                }

                // if there is more data in previous page show button
                if($pagination->has_previous())
                {
                    echo "<li class = 'previous'><a href = 'index.php?page={$pagination->previous()}'>&larr; Older</a></li>";
                }
            }
            ?>
            </ul>





            <!--/Slider-->
        </div>







<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Photos
        </h1>
    </div>
</div>
<!-- /.row -->

<?php
$images = $app->photo->find_all();
?>

<div class="row">
    <div class="col-lg-12">

            <table  class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th><b>Edit</b></th>
                        <th><b>Delete</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($images as $image){

                    // setting the file delete paths
                    $file = "../../".$app->photo->upload_directory."/".$image->photo_filename;
                    ?>

                    <tr>
                        <?php $pic = "../".$app->photo->upload_directory."/".$image->photo_filename; ?>

                        <td><?php echo $image->photo_id; ?></td>
                        <td><img src="<?php echo $pic; ?>" height="100" width="200"></td>
                        <td><?php echo $image->photo_title; ?></td>
                        <td><?php echo substr($image->photo_description, 0, 100)."[<br><b>click edit to read more<b/>]"; ?></td>
                        <td><?php echo number_format((float)($image->photo_size/1024), 2, '.', '')." KB"; ?></td>

                        <td><a class="btn btn-primary">Edit</a></td>
                        <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure?');"
                               href="pages/delete_image.php?id=<?php echo Helper::encode($image->photo_id); ?>
                               &file=<?php echo Helper::encode($file); ?>">
                                delete
                            </a>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>

            </table> <!-- End of table -->
        
    </div>
</div>

<!-- /.row -->


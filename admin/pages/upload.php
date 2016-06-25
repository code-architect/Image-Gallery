<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Upload Images
        </h1>
    </div>
</div>
<!-- /.row -->


<?php
$message = '';
if(isset($_POST['upload']))
{
    $postArray = [
        'photo_title'        => Helper::html_entity($_POST['photo_title']),
        'photo_alt_text'     => Helper::html_entity($_POST['photo_alt_text']),
        'photo_description'  => Helper::html_entity($_POST['photo_description']),
    ];

    // Setting the values
    $app->photo->set_file($_FILES['file_upload'], $postArray);

    // saving the values
    if($app->photo->save())
    {
        $message = "<div class='alert alert-success'>".join("<br>", $app->photo->errors)."</div>";
    }
    else
    {
        $message = "<div class='alert alert-danger'>".join("<br>", $app->photo->errors)."</div>";
    }

}

?>

<?php
// displaying messages
echo $message ?>


<div class="row">
    <div class="col-lg-12">

        <!-- Upload form start -->
        <form role="form" action="" method="post" enctype="multipart/form-data" class="col-md-9 go-right">
            <br>
            <div class="form-group">
                <label for="photo_title">Image Title</label>
                <input id="photo_title" name="photo_title" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="photo_alt_text">Alternate Text</label>
                <input id="photo_alt_text" name="photo_alt_text" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="photo_description">Image Description</label>
                <textarea id="photo_description" name="photo_description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <input name="file_upload" type="file" required>
            </div>

            <div class="form-group">
                <input type="submit" name="upload"  class="btn btn-primary btn-lg">
            </div>
        </form>


        <!-- Upload form start -->


    </div>
</div>

<!-- /.row -->


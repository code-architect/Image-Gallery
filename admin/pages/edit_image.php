<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit Image
        </h1>
    </div>
</div>
<!-- /.row -->


<?php
$data = "";
// If there is no id, redirect to photos page
if(!isset($_GET['id']))
{
    Helper::redirect("index.php?p=photos");
}

// if there is id and if invalid redirect o photos page
if(isset($_GET['id']))
{
    $id = Helper::escape_string(Helper::decode($_GET['id']));
    if(!$app->photo->data_exists('photo_id', $id))
    {
        Helper::redirect("index.php?p=photos");
    }
}

// getting the values by id
$id = Helper::escape_string(Helper::decode($_GET['id']));
$data = $app->photo->fetch_selected_column(["*"], "photo_id", "=", $id, 1);

if(isset($_POST['submit']))
{

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}





?>



<div class="row">
    <div class="col-lg-12">

        <!-- Update form start -->
        <form role="form" action="" method="post" enctype="multipart/form-data" class="col-md-8 go-right">
            <br>
            <div class="form-group">
                <label for="photo_title">Image Title</label>
                <input id="photo_title" value="<?php echo $data->photo_title; ?>" name="photo_title" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="photo_alt_text">Alternate Text</label>
                <input id="photo_alt_text" value="<?php echo $data->photo_alt_text; ?>" name="photo_alt_text" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="photo_description">Image Description</label>
                <textarea id="photo_description" name="photo_description" class="form-control" required><?php echo $data->photo_description; ?></textarea>
            </div>

            <div class="form-group">
                <input name="file_upload" type="file" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg" name="submit" value="7">Update</button>
            </div>
        </form>
        <!-- Update form ends -->

        <div class="col-md-4">
            <div class="photo-info-box">
                <div class="info-box-header">
                    <b>Existing Image</b></br>
                </div>
                <div class="inside">
                    <div class="box-inner">
                        <p class="text">
                            <img style="
                                max-width: 100%;
                                height: auto;
                                width: auto\9;
                                "
                                src="../images/<?php echo $data->photo_filename; ?>">

                        </p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
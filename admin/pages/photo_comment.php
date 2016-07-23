<style>
    .modal .modal-header {
        border-bottom: none;
        position: relative;
    }
    .modal .modal-header .btn {
        position: absolute;
        top: 0;
        right: 0;
        margin-top: 0;
        border-top-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .modal .modal-footer {
        border-top: none;
        padding: 0;
    }
    .modal .modal-footer .btn-group > .btn:first-child {
        border-bottom-left-radius: 0;
    }
    .modal .modal-footer .btn-group > .btn:last-child {
        border-top-right-radius: 0;
    }
</style>


<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            List of Comments on Image
        </h1>
    </div>
</div>
<!-- /.row -->
<?php

if(!isset($_GET['image_id']))
{
Helper::redirect("index.php?p=comments");
}

// if there is id and if invalid redirect o users page
if(isset($_GET['image_id']))
{
    $id = Helper::escape_string(Helper::decode($_GET['image_id']));
    if(!$app->photo->data_exists('photo_id', $id))
    {
        Helper::redirect("index.php?p=comments");
    }
}

// getting the values by id
$message = '';
$id = Helper::escape_string(Helper::decode($_GET['image_id']));
$comments_data = $app->comment->find_comments($id);
$image = $app->photo->fetch_selected_column(['photo_filename'],'photo_id','=',$id,1);

?>

<div class="row">

<div class="row">
    <div class="col-lg-12">

        <!-- Update form start -->
        <div class="col-md-8 go-right">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($comments_data as $data) { ?>

                <tr>
                    <td><?php echo $data->user_fname.' '.$data->user_lname; ?></td>
                    <td><?php echo $data->user_name; ?></td>
                    <td>
                        <a data-toggle="modal" href="#myModal<?php echo $data->user_id; ?>" class="btn btn-primary">Details</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure?');"
                           href="pages/delete_comment.php?id=<?php echo Helper::encode($data->comm_id); ?>">
                            delete
                        </a>
                    </td>

                    <!-- model start -->
                    <div id="myModal<?php echo $data->user_id; ?>" class="modal fade in">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                                </div>
                                <div class="modal-body">
                                    <h4>Comment Details</h4>
                                    <p><b>Date: </b><?php echo $data->comm_date; ?></p>
                                    <p><b>Comment: </b><?php echo $data->comm_body; ?></p><hr/>
                                    <h4>User Details</h4>
                                    <p><b>Name: </b><?php echo $data->user_fname.' '.$data->user_lname; ?></p>
                                    <p>
                                        <b>User-Name: </b><?php echo $data->user_name; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="index.php?p=edit_user&id=<?php echo Helper::encode($data->comm_author_id); ?>">Edit User</a>
                                    </p>
                                    <p><b>User Email: </b><?php echo $data->user_email; ?></p>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-group">
                                        <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>

                                    </div>
                                </div>

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dalog -->
                    </div><!-- /.modal -->


                    <!-- model ends -->
                </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
        <!-- Update form ends -->

        <div class="col-md-4">
            <div class="photo-info-box">
                <div class="info-box-header">
                    <b>Image</b></br>
                </div>
                <div class="inside">
                    <div class="box-inner">

                        <p class="text">
                            <img class="admin-photo-thumbnail" name="old_image"
                                 src="../images/<?php echo $image->photo_filename; ?>">
                        </p>
                        <p>
                            <a href="index.php?p=edit_image&id=<?php echo Helper::encode($data->comm_image_id); ?>" class="btn btn-primary">Edit image</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
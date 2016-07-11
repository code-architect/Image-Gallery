<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit User
        </h1>
    </div>
</div>
<!-- /.row -->

<?php

// If there is no id, redirect to users page
if(!isset($_GET['id']))
{
Helper::redirect("index.php?p=users");
}

// if there is id and if invalid redirect o users page
if(isset($_GET['id']))
{
    $id = Helper::escape_string(Helper::decode($_GET['id']));
    if(!$app->user->data_exists('user_id', $id))
    {
        Helper::redirect("index.php?p=users");
    }
}

// getting the values by id
$message = '';
$id = Helper::escape_string(Helper::decode($_GET['id']));
$data = $app->user->fetch_selected_column(["*"], "user_id", "=", $id, 1);
//---------------------------------------------------//


if(isset($_POST['submit']))
{

    /* Validation Start */
    // email validation
    if (!filter_var($app->user->clean_data($_POST['user_email']), FILTER_VALIDATE_EMAIL))
    {
        $message[] = "<div class='alert alert-danger'>"."The Email address is not valid!"."</div>";
    }else{
    /* Validation Ends */

    //excluding unnecessary fields
    $user_data = Helper::excluding_fields($_POST, 'user_', ['user_id']);

        if($app->user->update($user_data, 'user_id', $id))
        {
            Helper::redirect("index.php?p=users");
        }
    }

}
if(!empty($message)) {
    foreach ($message as $msg) {
        echo $msg;
    }
}

?>



<div class="row">
    <div class="col-lg-12">

        <!-- Update form start -->
        <form role="form" action="" method="post" enctype="multipart/form-data" class="col-md-8 go-right">
            <br>

            <div class="form-group">
                <label for="user_fname">First Name</label>
                <input id="user_fname" value="<?php echo $data->user_fname; ?>" name="user_fname" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="user_lname">Last Name</label>
                <input id="user_lname" value="<?php echo $data->user_lname; ?>" name="user_lname" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="user_name">Username</label>
                <input id="user_name" value="<?php echo $data->user_name; ?>" name="user_name" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="user_email">Email</label>
                <input id="user_email" value="<?php echo $data->user_email; ?>" name="user_email" type="email" class="form-control" required>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg pull-right" name="submit" value="7">Update user</button>
            </div>
        </form>
        <!-- Update form ends -->


    </div>
</div>
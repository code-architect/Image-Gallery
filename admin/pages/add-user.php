<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Create User
        </h1>
    </div>
</div>

<!-- /.row -->


<?php

$message = '';
//$message = "<div class='alert alert-danger'>"."Hello World"."</div>";
//echo $message;


if(isset($_POST['submit']))
{

    /* Validation Start */
    // email validation
    if (!filter_var($app->user->clean_data($_POST['user_email']), FILTER_VALIDATE_EMAIL))
    {
        $message[] = "<div class='alert alert-danger'>"."The Email address is not valid!"."</div>";
    }

    // email already exists
    if($app->user->check_user_data_exists('user_email',$app->user->clean_data($_POST['user_email'])))
    {
        $message[] = "<div class='alert alert-danger'>"."The Email address all ready exists!"."</div>";
    }

    // password validation
    if($app->user->clean_data($_POST['user_password']) != $app->user->clean_data($_POST['retype_password']))
    {
        $message[] = "<div class='alert alert-danger'>"."Password is not matching!"."</div>";
    }

    // password length validation
    if (strlen($_POST['user_password']) < 5)
    {
        $message[] = "<div class='alert alert-danger'>"."Password must be at-least contains 6 words!"."</div>";
    }

    //username already exists
    if($app->user->check_user_data_exists('user_name',$app->user->clean_data($_POST['user_name'])))
    {
        $message[] = "<div class='alert alert-danger'>"."Username already exists!"."</div>";
    }
    /* Validation Ends */

    if(empty($message))
    {
        //excluding unnecessary fields
        $user_data = Helper::excluding_fields($_POST, 'user_', ['user_id']);

        if($app->user->create($user_data))
        {
            $message[] = "<div class='alert alert-success'>"."Created User!"."</div>";
            unset($_POST);
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
                <input id="user_fname" value="<?php echo $user_name = (isset($_POST['user_fname']))? htmlspecialchars($_POST['user_fname']):''; ?>" name="user_fname" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="user_lname">Last Name</label>
                <input id="user_lname" value="<?php echo $user_lname = (isset($_POST['user_lname']))? htmlspecialchars($_POST['user_lname']):''; ?>" name="user_lname" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="user_name">Username</label>
                <input id="user_name" value="<?php echo $user_name = (isset($_POST['user_name']))? htmlspecialchars($_POST['user_name']):''; ?>" name="user_name" type="text" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="user_password">Password</label>
                <input id="user_password" value="" name="user_password" type="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="retype_password">ReType-Password</label>
                <input id="retype_password" value="" name="retype_password" type="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="user_email">Email</label>
                <input id="user_email" value="<?php echo $user_email = (isset($_POST['user_email']))? htmlspecialchars($_POST['user_email']):''; ?>" name="user_email" type="email" class="form-control" required>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg pull-right" name="submit" value="7">Create user</button>
            </div>
        </form>
        <!-- Update form ends -->


    </div>
</div>
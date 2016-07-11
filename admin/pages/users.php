
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Users
        </h1>
    </div>
</div>
<!-- /.row -->

<?php
$users = $app->user->fetch_selected_column(['*'],'user_is_admin','!=','1');

?>

<div class="row">
    <div class="col-lg-12">

        <table  class="table table-hover">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>

                <th><b>Edit</b></th>
                <th><b>Delete</b></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($users as $user){ ?>


                <tr>

                    <td><?php echo $user->user_id; ?></td>
                    <td><?php echo $user->user_name; ?></td>
                    <td><?php echo $user->user_fname." ".$user->user_lname; ?></td>
                    <td><?php echo $user->user_email; ?></td>

                    <td><a href="index.php?p=edit_user&id=<?php echo Helper::encode($user->user_id); ?>" class="btn btn-primary">Edit</a></td>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure?');"
                           href="pages/delete_user.php?id=<?php echo Helper::encode($user->user_id); ?>">
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



<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Comments
        </h1>
    </div>
</div>
<!-- /.row -->

<?php
$comments = $app->comment->comments_on_admin_page();

?>

<div class="row">
    <div class="col-lg-12">

        <table  class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image Name</th>
                <th>Username</th>
                <th>Comment</th>
                <th>Date Posted</th>

                <th><b>Delete</b></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($comments as $comment){ ?>


                <tr>

                    <td><?php echo $comment->comm_id; ?></td>

                    <td><a href="index.php?p=edit_image&id=<?php echo Helper::encode($comment->comm_image_id); ?>"><?php echo $comment->image_name; ?></a></td>

                    <td><a href="index.php?p=edit_user&id=<?php echo Helper::encode($comment->comm_author_id); ?>"><?php echo $comment->username; ?></a></td>

                    <td><?php echo $comment->comm_body; ?></td>

                    <td><?php echo date( 'm/d/y g:i A', strtotime($comment->comm_date));; ?></td>


                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure?');"
                           href="pages/delete_comment.php?id=<?php echo Helper::encode($comment->comm_id); ?>">
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


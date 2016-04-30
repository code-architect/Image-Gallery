<?php include("init/autoload.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/top_nav.php"); ?>
<?php include("includes/side_nav.php") ?>

<?php
//if($_SERVER['REQUEST_URI'] == "/sand_box/image_gallery/admin/index.php" ||
//   $_SERVER['REQUEST_URI'] == "/sand_box/ecommerce_simple/public/admin/" )
//{
//    include("pages/main.php");                              // main page
//}
//elseif(isset($_GET['users']))                              // Users summery page
//{
//    include("pages/users.php");
//}
//elseif(isset($_GET['photos']))                              // Photos page
//{
//    include("pages/photos.php");
//}
//elseif(isset($_GET['upload']))                              // Upload page
//{
//    include("pages/upload.php");
//}
//elseif(isset($_GET['comments']))                            // Comments page
//{
//    include("pages/comments.php");
//}
//else
//{
//    include("pages/main.php");
//}
/*
foreach($site_pages as $page)
{
    if(isset($_GET['p'])) {
        if ($page == $_GET['p']) {
            include(PAGES_DIR . DS . $_GET['p'] . ".php");
            break;
        } else {
            include(PAGES_DIR . DS . "main.php");
        }
    }
}*/
if($_SERVER['REQUEST_URI'] == "/sand_box/image_gallery/admin/index.php" ||
   $_SERVER['REQUEST_URI'] == "/sand_box/image_gallery/admin/" )
{
    include("pages/main.php");                              // main page
}
else if(isset($_GET['p'])){
    if(in_array($_GET['p'], $site_pages))
    {
        include(PAGES_DIR.DS.$_GET['p'].".php");
    }
    else
    {
        include("pages/main.php");
    }
}
?>
<!-- /.row -->

<?php include("includes/footer.php"); ?>
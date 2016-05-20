<?php include("init/autoload.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/top_nav.php"); ?>
<?php include("includes/side_nav.php") ?>

<?php
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
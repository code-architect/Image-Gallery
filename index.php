<?php include('includes/header.php'); ?>
<?php include('includes/nav.php'); ?>

<?php include_once('front_pages/home_page.php'); ?>

<?php include('includes/sidebar.php'); ?>
<?php include('includes/footer.php'); ?>


<?php
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
// session_destroy(); ?>
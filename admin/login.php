<?php include("init/autoload.php"); ?>
<?php include("includes/header.php"); ?>
<?php
$session = new Session();
$user = new User();

// If signed in redirect it to index.php
if($session->is_signed_in()){
    Helper::redirect("index.php");
}
?>

<?php
if(isset($_POST['submit']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // check the database that if the user exists or not
    $user_found = $user->fetch_user_id($username, $password);

    if($user_found != false)
    {
        $session->login($user_found);
        Helper::redirect("index.php");
    } else
    {
        $the_message = "You password or username does not match";
    }


} else {
    $the_message = "";
    $username = "";
    $password = "";
}

?>
<div class="col-lg-12">
<div class="col-md-4 ">
   <img src="styles/logo/logo.jpg">
</div>

<div class="col-md-2 "></div>

<div class="col-md-4">
    <h4 class="bg-danger"><?php if(isset($the_message)){echo $the_message;} ?></h4>
    <form action="" method="post">

        <div class="form-group">
            <label style="color: #ffffff" for="username">Username</label>
            <input type="text" class="form-control" value="<?php echo htmlentities($username); ?>" name="username" required=""/>
        </div>

        <div class="form-group">
            <label style="color: #ffffff" for="password">Password</label>
            <input type="password" class="form-control" name="password" required=""/>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Login" class="btn btn-primary"/>
        </div>

    </form>

</div>

</div>







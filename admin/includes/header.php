
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
    // Changing the title by page
    if($_SERVER['REQUEST_URI'] == "/sand_box/image_gallery/admin/index.php" ||
        $_SERVER['REQUEST_URI'] == "/sand_box/image_gallery/admin/" )
    {
        echo "<title>Admin - Main</title>";
    }
    else if(isset($_GET['p'])){
        if(in_array($_GET['p'], $site_pages))
        {
            echo "<title>Admin - ".ucfirst($_GET['p'])."</title>";
        }
        else
        {
            echo "<title>Admin - Main</title>";
        }
    }
    ?>


    <!-- Bootstrap Core CSS -->
    <link href="styles/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="styles/css/sb-admin.css" rel="stylesheet">
    <link href="styles/css/admin-style.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="styles/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://tinymce.cachefly.net/4.3/tinymce.min.js"></script>


</head>

<body>

<div id="wrapper">
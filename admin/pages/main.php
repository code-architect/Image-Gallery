
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Main
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>

<?php
//echo "<pre>";
//print_r(get_included_files());
//
//$user = new User();
//$data = $user->user_exists('user_id',1);
//if($data == true) {
//    $data = $user->fetch_selected_column(['user_name,user_fname'],'user_id','=','12','1');
//}else{
//    $data = "Sorry.User Not Found!";
//}
////
//echo "<pre>";
//print_r($data);
//echo $data->user_name;
////Helper::redirect("login.php");


//if (session_status() == PHP_SESSION_NONE) {
//    session_start();
//}

//foreach($data as $ok){
//    echo $ok->user_name."<br>";
//}


//$data = $user->fetch_user_id('admin');
//$data = $user->user_exists($data->user_id);
//$username = "admin";
//$password = '123456';
//
//$username = $user->fetch_user_id($username, $password);
//if($username != false) {
//    $name = $user->user_exists($username->user_id);
//    if ($name == true) {
//        //$my_user = $_SESSION['user_id'] = $username->user_id;
//        echo $username->user_is_admin;
//    }
//} else{
//    echo "No value found";
//}

//var_dump($_SESSION);
//echo "<br>";
//echo "<pre>";
//print_r($username);

//echo "<br>";
//echo $data->user_name;

// Create user
//$arr = [
//    'user_name' => "Jonny",
//    'user_password' => "123456",
//    'user_email' => "abcx@xyz.com",
//    'user_fname' => "jenny",
//    'user_lname' => "doe",
//    'user_is_admin' => "0"
//];

//$st = $app->user->insert_into_table($arr);
//$st = $app->user->update_table($arr, 'user_id', 15);

//$st = $app->photo->find_all();
//echo "<pre>";
//print_r($st);
//echo "</pre>";
//foreach($st as $ok){
//    echo "<h2>".$ok->photo_title."</h2><br>";
//    echo "<p>".$ok->photo_description."</p>";
//}


//$arr3 = [
//    'user_name' => "jenny",
//    'user_password' => "",
//    'user_email' => "",
//    'user_fname' => "",
//    'user_lname' => "",
//    'user_is_admin' => ""
//];

//
//// Converting password
//foreach($arr as $key => $value){
//    if($key == 'user_password'){
//        $arr[$key] = md5($value);
//    }
//}
//

//
//echo "<pre>";
//print_r($val);
//if(Helper::isAssoc($arr3)){
//    print_r($app->user->create($arr3));
//}else{
//    echo "Fuck Off";
//}
//echo "<br>";

//print_r($app->user->create($arr));

/**
 * Numeric array convertion process
 */
/*
$arr2 = [
    "Jenny",
    "gslkg'nrs'",
    "",
    "",
    "",
    ""
];

$arr4 = (object) $arr2;

echo "<pre>";
print_r($arr4);


$obj = (object)$arr2;
$a = (array)$obj;

var_dump($a['0']); // OK!
echo "<br>";
print_r($arr4);
*/

/**
 * Getting select ted fields from array
 */
//$new_arr = [];
//$query = "";


//$arr = [
//    'user_id'   => "1",
//    'user_name' => "nico",
//    'user_password' => "123456",
//    'user_email' => "abcx@xyz.com",
//    'user_fname' => "nico",
//    'user_lname' => "Robin",
//    'user_is_admin' => "0",
//    'this_is'   => "Not wanted",
//    'also_not'  => "wanted ok"
//];
//
//
//$val = Helper::excluding_fields($arr, 'user_', ['user_id']);

//$arr2 = [
//    "Jenny",
//    "gslkg'nrs'",
//    "",
//    "",
//    "",
//    ""
//];

//$val = $app->user->update($arr, 'user_id', 14);


//foreach($arr as $key => $value){
//    if(strpos($key, 'user_') !== false)
//    {
//        unset($new_arr['user_id']);
//        $new_arr[$key] = $value;
//    }
//}
//
//echo "<pre>";
//print_r($new_arr);
//echo "</pre>";
//
//$string = [];
//
//$query = "UPDATE employees ";
//foreach($new_arr as $key => $value)
//{
//    $string[] = $key." = '".Helper::escape_string($value)."', ";
//}
//
//$query .= implode("", $string);
//echo "<pre>";
//echo $query;


//$arr4 = (object) $arr2;
//
//echo "<pre>";
//print_r($arr4);
//
//
//$obj = (object)$arr2;
//$a = (array)$obj;
//
//var_dump($a['0']); // OK!
//echo "<br>";
//print_r($arr4);

//$st = $app->user->create($arr);
//$st = $app->user->update($arr, 'user_id', 5);
//$st = $app->user->save($arr);
//$val = $app->user->find_all();
//$val = $app->user->delete('user_id', '14', '=');
//echo "<pre>";
//print_r($val);
//echo "</pre>";







?>







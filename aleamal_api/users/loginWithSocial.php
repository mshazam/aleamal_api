<?php 
header('Content-Type: application/json');
// include('connection.php');
//user login 
//04-4-2019
//created by shazam

// local db connection file
include('../connection.php');
$status = "1";
$code   = '400';
$result = 0;
$Successstatus = "0";
$successCode   = '200';
$errormsg = array();
$userData = array();
if($con){

if(!empty($_POST['social_media_id'])){
    $social_media_id = $_POST['social_media_id'];
    $query = "select * from users where social_media_id = '$social_media_id' limit 1";
    $query_excu = mysqli_query($con, $query);
    if(mysqli_num_rows($query_excu) ==1){
    $sqlres = $query_excu->fetch_assoc();
    $userData = $sqlres;
    echo json_encode(array('userData'=>$userData,'status'=>$Successstatus,'code'=>$successCode));
} else {
    
    $errormsg[]= "User not found";
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
}
else{
    $errormsg[]= "Social Media Id not found";
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
}
else{
 $errormsg = "Connection Prblem";
 echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
?>
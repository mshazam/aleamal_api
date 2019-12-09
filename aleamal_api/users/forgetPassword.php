<?php 
header('Content-Type: application/json');
include('connection.php');
//user login 
//04-4-2019
//created by shazam

// local db connection file
// include('../connection.php');
$status = "1";
$code   = '400';
$result = 0;
$Successstatus = "0";
$successCode   = '200';
$errormsg = array();
$userData = array();
if($con){
    if(!empty($_POST['phone'])){
        $phone = $_POST['phone'];
    } else {
        $errormsg[] = "Provide your Phone Number";
    }
if(!empty($_POST['secret_question'])){
    $secret_question = $_POST['secret_question'];
} else {
    $errormsg[]= "secret_question not found";
}
$countErrors = count($errormsg);
if($countErrors == 0){
    $query = "select first_name,password from users where secret_question = '$secret_question' && phone = '$phone' limit 1";
    $query_excu = mysqli_query($con, $query);
    if(mysqli_num_rows($query_excu) ==1){
    $sqlres = $query_excu->fetch_assoc();
    $userData = $sqlres;
    echo json_encode(array('userData'=>$userData,'status'=>$Successstatus,'code'=>$successCode));
} else {
    
    $errormsg[]= "User not found";
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
} else{
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
}
else{
 $errormsg = "Connection Prblem";
 echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
?>
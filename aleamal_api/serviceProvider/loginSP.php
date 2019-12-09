<?php 
header('Content-Type: application/json');
include('../users/connection.php');
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
    if(strlen($phone) < 11) {
         $errormsg[] = 'Phone number is invalid';
     }

}
else{
    $errormsg[] = "Provide Phone No";
}
if(!empty($_POST['password'])){
    $password = $_POST['password'];
    $query = "select * from service_providers where phone = '$phone' && password = '$password'";
    $query_excu = mysqli_query($con, $query);
    if(mysqli_num_rows($query_excu) ==1){
    $sqlres = $query_excu->fetch_assoc();
    $userData = $sqlres;
    echo json_encode(array('userData'=>$userData,'status'=>$Successstatus,'code'=>$successCode));
} else {
    
    $errormsg[]= "User not found againt Provided this phone number";
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
} else {
    $errormsg[]= "Enter Password";
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
}
else{
 $errormsg = "Connection Prblem";
 echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
?>
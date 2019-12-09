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

if($con){
if(!empty($_POST['phone'])){
    $phone = $_POST['phone'];

    $query = "delete from users where phone = '$phone'";
    // echo $query; die();
    $query_excu = mysqli_query($con, $query);
    if($query_excu){
    echo json_encode(array('msg'=>'User Deleted Successfuly','status'=>$Successstatus,'code'=>$successCode));
} else {
    $errormsg[] = "sorry something went wrong please try again";
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
} 

}
else{
    $errormsg[] = "sorry can not delete without phone number";
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
}

    else{
        $errormsg[] = "connection error";
        // echo json_encode($errormsg);
        echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
    }
?>
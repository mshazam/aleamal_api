<?php
header('Content-Type: application/json');
include('../users/connection.php');
//register api to insert data in db 
//04-4-2019
//created by shazam
// include('../connection.php');
$status = "1";
$code   = '400';
$result = 0;
$Successstatus = "0";
$successCode   = '200';
$errormsg = array();
$taskData = array();
$api_key = "wmcVjZoT4K";
if($con)
{
    if(!empty($_POST['api_key'])) 
    {
    $api_verify_key = $_POST['api_key'];

    if($api_key == $api_verify_key)
    {
        $q="SELECT * FROM users";
        
        // echo $q ; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            while($row = mysqli_fetch_assoc($queryExe)) {

                 $taskData[] = $row;
            }
            $errormsg[] = "Success";
            echo json_encode(array('userswsData'=>$taskData,'status'=>$Successstatus,'code'=>$successCode,'message'=>$errormsg));

        } else{
            $errormsg[] = "Something went wrong please try again";
            echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));

        }
    } else {
            $errormsg[] = "Access denied invalid Api key";
            echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
        }
    } else {
        $errormsg[] = "Access denied api key not provided";
        echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
    }
    } else {
    $errormsg[] = "connection error";
    // echo json_encode($errormsg);
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}

?>

<?php
header('Content-Type: application/json');
include('../users/connection.php');
//read profile data for a single provider
//04-4-2019
//created by shazam
// include('../connection.php');
$status = "1";
$code   = '400';
$result = 0;
$Successstatus = "0";
$successCode   = '200';
$errormsg = array();
$singleUserData = array();
if($con)
{
    if(!empty($_POST['cnic'])) {
         $cnic = $_POST['cnic'];
        $q="SELECT * FROM service_providers where cnic ='$cnic' limit 1";
        // echo $q ; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $singleUserData = mysqli_fetch_assoc($queryExe);
            $errormsg[] = "Success";
            echo json_encode(array('singleUserData'=>$singleUserData,'status'=>$Successstatus,'code'=>$successCode,'message'=>$errormsg));

        }
        else{
            $errormsg[] = "Something went wrong please try again";
            echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));

        }
} else {
    $errormsg[] = 'User Id is missing';
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));

}
}
else {
    $errormsg[] = "connection error";
    // echo json_encode($errormsg);
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}

?>

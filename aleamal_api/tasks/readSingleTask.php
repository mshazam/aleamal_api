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
$singleTaskData = array();
if($con)
{
    if(!empty($_POST['user_id'])) {
         $user_id = $_POST['user_id'];
        $q="SELECT * FROM tasks where user_id ='$user_id' limit 1";
        // echo $q ; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $singleTaskData = mysqli_fetch_assoc($queryExe);
            $errormsg[] = "Success";
            echo json_encode(array('singleTaskData'=>$singleTaskData,'status'=>$Successstatus,'code'=>$successCode,'message'=>$errormsg));

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

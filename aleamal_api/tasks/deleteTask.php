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
if($con)
{
    if(!empty($_POST['user_id'])) {
         $user_id = $_POST['user_id'];
        $q="DELETE FROM tasks where user_id ='$user_id'";
        // echo $q ; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $errormsg[] = "Successfuly deleted";
            echo json_encode(array('status'=>$Successstatus,'code'=>$successCode,'message'=>$errormsg));

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

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
$formData = array();
if($con)
{
    !empty($_POST['user_id']) ? $formData['user_id'] = $_POST['user_id'] : $errormsg[] = 'User Id is missing';

    !empty($_POST['status']) ? $formData['status'] = $_POST['status'] : $errormsg[] = 'Status is missing';

        
        $countError = count($errormsg);
        
        if($countError == 0){

        $q="UPDATE tasks set
                            status = '".$formData['status']."'
                            where user_id = '".$formData['user_id']."'";
        
        // echo $q ; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $errormsg[] = "Successfuly Updated";
            echo json_encode(array('status'=>$Successstatus,'code'=>$successCode,'message'=>$errormsg));

        }
        else{
            $errormsg[] = "Something went wrong please try again";
            echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));

        }
        }
    else{
        echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));

    }
}
else {
    $errormsg[] = "connection error";
    // echo json_encode($errormsg);
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}

?>

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
    
    !empty($_POST['service_title']) ? $formData['service_title'] = $_POST['service_title'] : $errormsg[] = 'Service Title is missing';
//  print_r($errormsg);die();
    !empty($_POST['service_details']) ? $formData['service_details'] = $_POST['service_details'] : $errormsg[] = 'Service Details is missing';
   
    if(!empty($_FILES['service_image']))
        {
        $file = $_FILES["service_image"]["name"];
        // echo $file; die();
        $filePath = "service_image/".$file;
        move_uploaded_file($_FILES["service_image"]["tmp_name"], $filePath);
        } else {
            $filePath =null;
        }
        
        $countError = count($errormsg);
        
        if($countError == 0){

        $q="insert into services (service_title,service_image,service_details)
         values ('".$formData['service_title']."','$filePath','".$formData['service_details']."')";
        // echo $q ; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $errormsg[] = "Successfuly Created";
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

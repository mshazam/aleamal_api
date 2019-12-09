<?php
header('Content-Type: application/json');
include('connection.php');
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
    !empty($_POST['first_name']) ? $formData['f_name'] = $_POST['first_name'] : $errormsg[] = 'First name is missing';
//  print_r($errormsg);die();
    !empty($_POST['last_name']) ? $formData['l_name'] = $_POST['last_name'] : $formData['l_name'] = null;
    if(!empty($_POST['password'])) { 
        $formData['password'] = $_POST['password'];
        
    } else {
        $formData['password'] = null;
            }

    if(!empty($_POST['conf_password'])) {

     $formData['conf_password'] = $_POST['conf_password'];

     if(isset($formData['password'])){
     if($formData['password'] !== $formData['conf_password']){
        $errormsg[] = 'passwords did not match';
    }
 }
    }
    else {
        $formData['conf_password'] = null;
   }
    if(!empty($_POST['email'])) {
            $formData['email'] = $_POST['email'];
            } else{
                $formData['email'] =null;
            }
    if(!empty($_POST['phone'])) {
        $formData['phone'] = $_POST['phone'];
        $error = validatePhone($con,$formData['phone']);
        if(empty($error)){
            $error = null;
        }
        else {
        $errormsg[]= $error;
        }
    } else {
        $errormsg[] = "Phone No is missing";
    }
    if(!empty($_POST['device_token'])) {
        $formData['device_token'] = $_POST['device_token'];
        }
        else{
            $errormsg[] = 'Device token is missing';
        }
    if(!empty($_POST['social_media_id'])) {
        $formData['social_media_id'] = $_POST['social_media_id'];
        $formData['user_type'] = 1;
        }
        else{
            $formData['social_media_id'] = NULL;
            $formData['user_type'] = 0;
        }
    if(!empty($_POST['state'])) {
        $formData['state'] = $_POST['state'];
        }
        else{
            $formData['state'] = NULL;
        } 
        if(!empty($_POST['secret_question'])) {
            $formData['secret_question'] = $_POST['secret_question'];
            }
            else{
                $errormsg[] = "Secret Should not be empty";
            } 
    if(!empty($_POST['country'])) {
            $formData['country']= $_POST['country'];
            }
            else{
                $formData['country'] = NULL;
            }
    if(!empty($_FILES['profile_image']))
        {
        $file = $_FILES["profile_image"]["name"];
        $filePath = base_url()."profile_images/".$file;
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filePath);
            echo $filePath; die();
        }  else {
            $filePath = null;
        }
        
        $countError = count($errormsg);
        
        if($countError == 0){

        $q="insert into users (first_name,last_name,password,conf_password,email ,phone,device_token,profile_image,social_media_id,state,country,user_type,secret_question)
         values ('".$formData['f_name']."','".$formData['l_name']."','".$formData['password']."','".$formData['conf_password']."','".$formData['email']."','".$formData['phone']."','".$formData['device_token']."','$filePath','".$formData['social_media_id']."','".$formData['state']."','".$formData['country']."','".$formData['user_type']."','".$formData['secret_question']."')";
        // echo $q; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $errormsg[] = "Successfuly registred";
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
else{
    $errormsg[] = "connection error";
    // echo json_encode($errormsg);
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
}
function validatePhone($con,$phone){
    $error = null;
    if(strlen($phone)<11){
        $error = 'This phone number is invalid';
    }
    $q = "select * from users where phone = '$phone'";
    $result = mysqli_query($con,$q);
    if(mysqli_num_rows($result) !== 0)
    {
        $error = 'This phone number is already registred';
    }
    return $error;
}
?>

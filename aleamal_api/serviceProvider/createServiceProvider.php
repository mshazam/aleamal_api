<?php
header('Content-Type: application/json');
// include('../users/connection.php');
//register api to insert data in db 
//04-4-2019
//created by shazam
include('../connection.php');
$status = "1";
$code   = '400';
$result = 0;
$Successstatus = "0";
$successCode   = '200';
$errormsg = array();
$formData = array();
if($con)
{
    !empty($_POST['name']) ? $formData['name'] = $_POST['name'] : $errormsg[] = 'name is missing';
    if(!empty($_POST['password'])) { 
        $formData['password'] = $_POST['password'];
        
    } else {
        $errormsg[] = "password is missing";
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
        $errormsg[] = "confirm password is missing";
        }
        if(!empty($_POST['email'])) {
        $formData['email'] = $_POST['email'];
        }
        else {
        $formData['email'] = null;
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
    }
    else {
        $errormsg[] = "Phone No is missing";
    }
    if(!empty($_POST['cnic'])) {
        $formData['cnic'] = $_POST['cnic'];
        $error = validateCNIC($con,$formData['cnic']);
        if(empty($error)){
            $error = null;
        // echo $error; die();
        }
        else {
        $errormsg[]= $error;
        

        }
    }
    else {
        $errormsg[] = "CNIC is missing";
    }
    if(!empty($_POST['job_title'])) {
        $formData['job_title'] = $_POST['job_title'];
        }
        else{
            $errormsg[] = 'Job Title is missing';
        }
        if(!empty($_POST['work_experience'])) {
            $formData['work_experience'] = $_POST['work_experience'];
            }
            else{
                $errormsg[] = 'Work Experience is Missing';
            }
    if(!empty($_POST['device_token'])) {
        $formData['device_token'] = $_POST['device_token'];
        }
        else{
            $formData['device_token'] = NULL;
        }
    if(!empty($_POST['address'])) {
        $formData['address'] = $_POST['address'];
        }
        else{
            $errormsg[] = 'Address is missing';
        } 
    
    if(!empty($_FILES['profile_image']))
        {
        $file = $_FILES["profile_image"]["name"];
        $filePath = "profile_images/".$file;
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filePath);
        // $sql = "insert into service_providers (profile_image) values('$filePath')";
        // echo $sql; die();
        // mysqli_query($con,$sql);
        } else {
            $filePath = null;
        }
        
        $countError = count($errormsg);
        // print_r($formData); die();
        if($countError == 0){

        $q="insert into service_providers (name,password,conf_password,email ,phone,cnic,job_title,work_experience,
                                device_token,address,profile_image)
         values ('".$formData['name']."','".$formData['password']."','".$formData['conf_password']."',
         '".$formData['email']."','".$formData['phone']."','".$formData['cnic']."','".$formData['job_title']."',
         '".$formData['work_experience']."','".$formData['device_token']."','".$formData['address']."','$filePath')";
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
    $q = "select * from service_providers where phone = '$phone'";
    // echo $q; die();
    $result = mysqli_query($con,$q);
    // $d = mysqli_fetch_assoc($result);
    // print_r($d);die();
    if(mysqli_num_rows($result) !== 0)
    {
        // $con   = mysqli_num_rows($result);
        // echo $con; die();
        $error = 'This phone number is already registred';
    }
    // echo $error; die();

    return $error;
}
function validateCNIC($con,$cnic){
    $error = null;
    if(strlen($cnic)<13){
        $error = 'This CNIC is invalid';
    }
    $q = "select * from service_providers where cnic = '$cnic'";
    $result = mysqli_query($con,$q);
    if(mysqli_num_rows($result)!== 0)
    {
        $error = 'This CNIC is already registred';
    }
    return $error;
}
?>

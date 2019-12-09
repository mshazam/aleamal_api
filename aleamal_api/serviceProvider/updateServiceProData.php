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
    if(!empty($_POST['cnic']))
    {
        $formData['cnic'] = $_POST['cnic'];
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
    
    if(isset($_FILES['profile_image']))
        {
        $file = $_FILES["profile_image"]["name"];
        $filePath = "profile_images/".$file;
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filePath);

        } else {
        $filePath = null;
    }
        
        $countError = count($errormsg);
        
        if($countError == 0){

        $q="Update service_providers  set name = '".$formData['name']."',
        password = '".$formData['password']."',
        conf_password  = '".$formData['conf_password']."',
        email  = '".$formData['email']."',
        phone = '".$formData['phone']."',
        job_title = '".$formData['job_title']."',
        work_experience = '".$formData['work_experience']."',
        device_token = '".$formData['device_token']."',
        address = '".$formData['address']."',
        profile_image = '$filePath'
        where cnic = '".$formData['cnic']."'";
        
        // echo $q; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $errormsg[] = "Successfuly UPDATED";
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
    } else {
        $errormsg[] = "CNIC is missing , Can't update without cnic";
    // echo json_encode($errormsg);
    echo json_encode(array('status'=>$status,'code'=>$code,'message'=>$errormsg));
    }

} else{
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

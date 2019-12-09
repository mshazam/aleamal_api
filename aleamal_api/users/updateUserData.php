<?php
header('Content-Type: application/json');
include('connection.php');
//to update user data 
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
if(!empty($_POST['phone']))
{
    $formData['phone']= $_POST['phone'];
    !empty($_POST['first_name']) ? $formData['f_name'] = $_POST['first_name'] : $errormsg[] = 'First name is missing';
//  print_r($errormsg);die();
    !empty($_POST['last_name']) ? $formData['l_name'] = $_POST['last_name'] : $errormsg[] = 'last name is missing';
    if(!empty($_POST['password'])) { 
        $formData['password'] = $_POST['password'];
        if(strlen($formData['password']) < 8){
        $errormsg[]= 'Password must be atleast 8 digits';
            }
    } else {
    $errormsg[] = 'password is missing';
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
        $errormsg[] = 'confirm password is missing';
   }
    if(isset($_POST['email'])) {
            $formData['email'] = $_POST['email'];
            }
    if(!empty($_POST['social_media_id'])) {
        $formData['social_media_id'] = $_POST['social_media_id'];
        }
        else{
            $formData['social_media_id'] = NULL;
        }
    if(!empty($_POST['state'])) {
        $formData['state'] = $_POST['state'];
        }
        else{
            $formData['state'] = NULL;
        } 
    if(!empty($_POST['country'])) {
            $formData['country']= $_POST['country'];
            }
            else{
                $formData['country'] = NULL;
            }
    if(!empty($_POST['status'])) {
        $formData['status']= $_POST['status'];
        }
        else{
            $formData['status'] = 0;
        }
    if(!empty($_FILES['profile_image']))
        {
        $file = $_FILES["profile_image"]["name"];
        $filePath = "profile_images/".$file;
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $filePath);
        } else {
            $filePath = null;
        }
        
        $countError = count($errormsg);
        
        if($countError == 0){

        $q="Update users set first_name= '".$formData['f_name']."',
        last_name = '".$formData['l_name']."',
        password = '".$formData['password']."',
        conf_password = '".$formData['conf_password']."',
        email = '".$formData['email']."',
        social_media_id = '".$formData['social_media_id']."',
        state = '".$formData['state']."',
        country = '".$formData['country']."',
        profile_image = '$filePath',
        status = '".$formData['status']."'
        where phone = '".$formData['phone']."'";
            // echo $q; die();
         $queryExe = mysqli_query($con,$q);
         if($queryExe){
            $errormsg[] = "Successfuly updated";
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

?>

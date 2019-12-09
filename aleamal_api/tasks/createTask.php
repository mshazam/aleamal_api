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

    !empty($_POST['service_title']) ? $formData['service_title'] = $_POST['service_title'] : $errormsg[] = 'Service Title is missing';
//  print_r($errormsg);die();
    !empty($_POST['service_details']) ? $formData['service_details'] = $_POST['service_details'] : $errormsg[] = 'Service Details is missing';
    if(!empty($_POST['service_type'])) { 
        $formData['service_type'] = $_POST['service_type'];
    } else {
    $errormsg[] = 'Service Type is missing';
            }

    if(!empty($_POST['pick_up_latitude'])) {

     $formData['pick_up_latitude'] = $_POST['pick_up_latitude'];
 }
    else {
        $formData['pick_up_latitude'] = null;
   }
    if(!empty($_POST['pick_up_longnitude'])) {
            $formData['pick_up_longnitude'] = $_POST['pick_up_longnitude'];
            }
            else {
                $formData['pick_up_longnitude']= null;
                }
    if(!empty($_POST['due_date'])) {
        $formData['due_date'] = $_POST['due_date'];
        }
        else {
        $errormsg[]= 'Due date is missing';
        }
        if(!empty($_POST['drop_up_latitude'])) {
            $formData['drop_up_latitude'] = $_POST['drop_up_latitude'];
            }
            else {
                $formData['drop_up_latitude'] =null;
            }
        if(!empty($_POST['drop_up_longnitude'])) {
            $formData['drop_up_longnitude'] = $_POST['drop_up_longnitude'];
            }
            else {
                $formData['drop_up_longnitude'] =null;
            }
    // if(isset($_FILES['profile_image']))
    //     {
    //     $file = $_FILES["file"]["profile_image"];
    //     $filePath = "profile_images/".$file;
    //     move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
    //     $sql = "insert into users ('profile_image') values('$filePath') where phone = '$phone'";
    //     mysqli_query($con,$sql);
    //     }
        
        $countError = count($errormsg);
        
        if($countError == 0){

        $q="insert into tasks (user_id,service_title,service_details,service_type,
        pick_up_latitude,pick_up_longnitude,drop_up_latitude,drop_up_longnitude ,due_date)
         values ('".$formData['user_id']."','".$formData['service_title']."','".$formData['service_details']."',
         '".$formData['service_type']."','".$formData['pick_up_latitude']."',
         '".$formData['pick_up_longnitude']."','".$formData['drop_up_latitude']."',
         '".$formData['drop_up_longnitude']."','".$formData['due_date']."')";
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

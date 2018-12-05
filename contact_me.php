<?php



if($_POST)
{
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        
        $output = json_encode(array( //create JSON data
            'type'=>'error', 
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    } 
//     'joinLabs'       : $('textarea[name=joinLabs]').val(), 
//                'freeTime'       : $('textarea[name=freeTime]').val(), 
//                'usedApps'       : $('textarea[name=usedApps]').val(), 
//                'news'  
    //Sanitize input data using PHP filter_var().
    $joinLabs     = filter_var($_POST["joinLabs"], FILTER_SANITIZE_STRING);
    $freeTime        = filter_var($_POST["freeTime"], FILTER_SANITIZE_STRING);
    $usedApps        = filter_var($_POST["usedApps"], FILTER_SANITIZE_STRING);
    $news           = filter_var($_POST["news"], FILTER_SANITIZE_STRING);
    
    //additional php validation
  
    if(strlen($joinLabs)<3){ //check emtpy message
        $output = json_encode(array('type'=>'error', 'text' => 'Too short message! Please enter something.'));
        die($output);
    }
    
    //email body
    
    //proceed with PHP email.
    
function checkUserPass($user, $sap, $mail) {
    require_once "include/conexion.php";

    $query = sprintf("SELECT sAMAccountName, Mail, telephoneNumber, givenName, SapEmployeeBirthDate FROM `validusers` 
				WHERE sAMAccountName ='%s' AND extensionAttribute9='%s' AND Mail ='%s' ", mysqli_real_escape_string($link, $user), mysqli_real_escape_string($link, $sap), mysqli_real_escape_string($link, $mail));

    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($result)) {
        $validate = $row['SapEmployeeBirthDate'];

        if (!$validate) {
            //   echo "<script type='text/javascript'>alert('Usuario o password invalido'); window.history.back();</script>";
            echo "<script type='text/javascript'>alert('Usuario o password invalido - $validate - $user - $sap - $mail'); </script>";
        } else {
            $_SESSION['user'] = $row['sAMAccountName'];
            $_SESSION['sap'] = $row['extensionAttribute9'];
            $_SESSION['birth'] = $row['SapEmployeeBirthDate'];
            echo "<script type='text/javascript'>alert('Usuario logueado con exito');</script>";
        }
    }
}
    
    if(!checkUserPass)
    {
        //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send data! Please check your PHP configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi, Thank you for your time'));
        die($output);
    }
}
?>
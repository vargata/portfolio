<?php

require_once './src/required.php';
require_once 'db.php';

    $return = array();
    
    $name=$_POST['name'];
    $company=$_POST['company'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    
    if(!preg_match("/^(?![\\- ])(?!.*  )[ \\-'\\p{L}]+(?<![\\- ])$/u", $name)){
        array_push($return, 'Invalid name!');
        $return["success"] = false;
    }
    
    if($company != ""){
        if(!preg_match("/^(?! )(?!.*  )[ \\d\\p{P}\\p{S}\\p{L}]+(?<![\\- ])$/u", $company)){
            array_push($return, 'Invalid company!');
            $return["success"] = false;
        }
    }
    
    if(!preg_match("/^(?! )(?!.*  )[ \\d\\p{P}\\p{S}\\p{L}]+(?<![\\- ])$/u", $subject)){
        array_push($return, 'Invalid subject!');
        $return["success"] = false;
    }
    
    if(!preg_match("/^(?!\\s)(?!.*  )(?!.*\\s\\s\\s)[\\s\\d\\p{P}\\p{S}\\p{L}]+(?<![\\s\\-])$/u", $message)){
        array_push($return, 'Invalid message!');
        $return["success"] = false;
    }
    
    $domain=explode("@",$email.".");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($return, 'Need a valid email address.');
        $return["success"] = false;
    }else if(!checkdnsrr(end($domain), 'MX')){
        array_push($return, 'Not existing email provider.');
        $return["success"] = false;
    }
    
    $regex_digitonly = "/[^0-9+]/";
    $regex_short_phone = "/^0[0-9]{10}$/";
    $regex_long_phone = "/^\\+44[0-9]{10}$/";
    $phone = preg_replace($regex_digitonly, "", $phone);
    if (!preg_match($regex_short_phone, $phone) && !preg_match($regex_long_phone, $phone)){
        array_push($return, 'Not a valid phone number');
        array_push($return, 'has to have a format of 0xxxxxxxxxx');
        array_push($return, 'or +44xxxxxxxxxx');
        $return["success"] = false;
    }

    foreach ($_POST as $param){
        if(strip_tags($param) != $param){
            array_push($return, 'Caught you redhanded!!!');
            array_push($return, htmlentities($param));
            $return['success'] = false;
        }
    }

?>

<?php

    if (!isset($return["success"])){
    
        foreach($_POST as $name => $param){           
            $params[$name] = htmlentities($param);
        }
        
        if(isset($_POST["submit"])){
            $trash = array_pop($params);
            unset($trash);
        }
        
        if($_SERVER["HTTP_HOST"] == "localhost")
            $db = new db("localhost", "contact_user", "contactpwd", "db_portfolio");
        else
            $db = new db("138.68.136.139", "tamasvar_contact_user", "dU91Sc&Y0E5J", "tamasvar_db_portfolio");
                
        if($db->connect_db()){
            
            $db->add_query("saveEnquiry", "CALL saveEnquiry(?, ?, ?, ?, ?, ?, @cId)");
            $db->add_params("saveEnquiry", "ssssis", $params);
            if($db->save_Data("saveEnquiry")){
                array_push($return, 'Message sent successfully.');
                $return["success"] = true;
            } else{
                array_push($return, 'Database error! Please try again later');
                $return["success"] = false;
            }
            
            $db->close_db();
        } else {
            array_push($return, "Connection error! Please try again later");
            $return["success"] = false;
        }
    }
    
    foreach($return as $key =>$value){
        if($key != "success")
            echo "<label class='msglabel'>".$value."</label>".PHP_EOL;
    }
    
?>
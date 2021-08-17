<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        function str_openssl_enc($str,$iv){
            $key='1234567890vishal%$%^%$$#$#';
            $chiper="AES-128-CTR";
            $options=0;
            $str=openssl_encrypt($str,$chiper,$key,$options,$iv);
            return $str;
        }
        $iv=openssl_random_pseudo_bytes(16);
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        
        $message=str_openssl_enc($message,$iv);
        $iv=bin2hex($iv);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,iv)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}','{$iv}')") or die();
        }
    }else{
        header("location: ../login.php");
    }

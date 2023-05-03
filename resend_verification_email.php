<?php
session_start();

    require_once 'connection.php';
    
    require 'phpmailer/includes/PHPMailer.php';
    require 'phpmailer/includes/SMTP.php';
    require 'phpmailer/includes/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    function send_email_verify($email, $verify_token){
        $mail = new PHPMailer(true);
    
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host = "smtp.gmail.com";
        $mail->Username   = "grccinema@gmail.com";                  //SMTP username
        $mail->Password   = "pednlnnxjuicxatn";                     //SMTP password
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        // 配置 SSL/TLS 上下文选项
        $context = stream_context_get_default([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ]);

        // 设置 SMTP 选项
        $mail->SMTPOptions = [
            'ssl' => $context,
            'tls' => $context,
        ];

        //Recipients
        $mail->setFrom('grccinema@gmail.com');
        $mail->addAddress($email);                                 //Name is optional

        $mail->isHTML(true);
        $mail->Subject = "Resend - Email Verification from GRC Cinema";
        
        $email_template = "
            <h2>You have Registered with GRC Cinema</h2>
            <h5>Verify your email address to Login with the below given link</h5>
            <br/><br/>
            <a href='http://localhost/GRC/verify_email.php?token=$verify_token'>Activate</a>
        ";
        
        $mail->Body = $email_template;
        $mail->send();
        $mail->smtpClose();
    }
    
    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        
        $check_email = $con->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $run = $check_email->get_result();
        
        if($run && $run->num_rows > 0){
            $row = $run->fetch_array();
            $get_email = $row['email'];
            $verify_token = $row['verify_token'];
            
            if($row['verify_status'] == "0"){
                send_email_verify($get_email, $verify_token);
                $_SESSION['status'] = "Verification Email Link has been sent to your email address!";
                header("Location: sign_in.php");
                exit(0);
            }
            else{
                $_SESSION['status'] = "The Email has already been Activated. Please Login!";
                header("Location: sign_in.php");
                exit(0);
            }
        }
        else{
            $_SESSION['status'] = "No Email Found!";
            header("Location: resend_verification_email.php");
            exit(0);
        }
    }
    
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="css/forget_password.css" rel="stylesheet" type="text/css"/>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&family=Tilt+Neon&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700;900&display=swap');
        </style>
        <title>GRC Cinema</title>
    </head>
    <body>
        <?php    
            if(isset($_SESSION['status'])){
                echo "<script>";
                echo "alert('" . $_SESSION['status'] . "')";
                echo "</script>";
                unset($_SESSION['status']);
            }
        ?>
        <div class="container">
            <form action="resend_verification_email.php" method="post" id="form-1">
                <div class="heading">
                    <button class="back-btn"><a href="sign_in.php">&larr;</a></button>
                    <h1>Resend Email Verification</h1>
                </div>
                <p>Please enter your registered email address and we will resend you a verification email</p>
                <div class="psd-reset">
                    <input type="text" id="email" name="email" required />
                    <label for="email">Email Address<span class="star">*</span></label>
                    <div id="error-message-1"></div>
                </div>
                
                <div class="submit-btn">
                    <a href="sign_in.php">BACK</a>
                    <input type="submit" name="submit" value="RESEND EMAIL">
                </div>
            </form>
        </div>
    </body>
</html>

<?php
session_start();

    require_once 'connection.php';
    
    if(isset($_POST['submit'])){
        if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];
        }
        else{
            echo "Cannot get the email";
        }
        
        $otp = $_POST['otp'];
        
        if(strlen($otp) == 6){
            $stmt = $con->prepare("SELECT OTP FROM users WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['OTP'] == $otp){
                    $otp = "";
                    $run = $con->prepare("UPDATE users SET OTP = ? WHERE email = ? LIMIT 1");
                    $run->bind_param("ss", $otp, $email);
                    $run->execute();
                    echo "<script>alert('OTP verification success'); window.location.href='password_reset.php'</script>";
                }
                else{
                    $otp = "";
                    $run = $con->prepare("UPDATE users SET OTP = ? WHERE email = ? LIMIT 1");
                    $run->bind_param("ss", $otp, $email);
                    $run->execute();
                    echo "<script>alert('OTP verification failed'); window.location.href='forget_password.php'</script>";
                }
            }
        }
        else{
            echo "<script>alert('Please fill in the OTP field.');</script>";
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
        <link href="css/OTP.css" rel="stylesheet" type="text/css"/>
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
        <h1>OTP Verification</h1>
        <p>code has been send to the email</p>
        <form action="OTP.php" method="POST" id="otp-submit">
            <div class="otp-box">
                <input type="text" maxlength="1" />
                <input type="text" maxlength="1" />
                <input type="text" maxlength="1" class="space" />
                <input type="text" maxlength="1" />
                <input type="text" maxlength="1" />
                <input type="text" maxlength="1" />
            </div>
            <input type="hidden" name="otp" id="otp" />
            <input class="submit-btn" type="submit" name="submit" value="Verify" />
        </form>
        
        <script type="text/javascript">
            const inputs = document.querySelectorAll(".otp-box input");
            
            inputs.forEach((input, index) => {
               input.dataset.index = index; // 为每个 input 设置自定义属性 ‘data-index’ 
               input.addEventListener("paste", handleOtppaste);
               input.addEventListener("keyup", handleOtp);
            });
            
            // copy and paste
            function handleOtppaste(e){
                const data = e.clipboardData.getData("text"); // clipboardData - containing the currently copied or cut data | text - only text type data is obtained
                const value = data.split(""); // split the copied or cut data
                if(value.length === inputs.length){
                    inputs.forEach((input, index) => (input.value = value[index]));
                    submit();
                }
            }
            
            // key in
            function handleOtp(e){
                const input = e.target; // e.target - target element of the event
                let value = input.value;
                input.value = ""; // clear the entered value in the box
                input.value = value ? value[0] : ""; // conditional-if
                
                let fieldIndex = input.dataset.index; // 读取索引
                if(value.length > 0 && fieldIndex < inputs.length - 1){ // determine if there is already a value entered in the input box and the current 
                    input.nextElementSibling.focus();                   // input box is not the last input box                
                }
                if(e.key === "Backspace" && fieldIndex > 0){
                    input.previousElementSibling.focus();
                }
                if(fieldIndex == inputs.length - 1){
                    submit();
                }
            }
            
            function submit(){
                //let otp = "";
                var otp = document.getElementById("otp").value;
                inputs.forEach((input) => {
                    otp += input.value;
                });                
                document.getElementById("otp").value = otp; // 赋值
            }
        </script>
    </body>
</html>


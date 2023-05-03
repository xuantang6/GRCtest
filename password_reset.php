<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="css/sign_up.css" rel="stylesheet" type="text/css"/>
        <script src="js/sign_up.js" type="text/javascript"></script>
        
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&family=Tilt+Neon&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;900&display=swap');
            
            html::-webkit-scrollbar{
                width: 0.5rem;
                background-color: #020307;
            }

            html::-webkit-scrollbar-thumb{
                background-color: #38FFFC;
                border-radius: 5rem;
            }
            
            body{
                overflow: auto;
            }
            
            #container{
                margin-top: 130px;
                width: 50%;
            }
            
            .info{
                margin-bottom: 80px;
            }
            
            @media screen and (max-width: 1246px) {
                body{
                    height: 800px;
                }
                
                #container{
                    margin-top: 50px;
                }
            }
            
            @media screen and (max-width: 842px){
                body{
                    height: 840px;
                }
                
                #container{
                    margin-top: 0px;
                }
                
                .form-title{
                    font-size: 30px;
                }
            }
        </style>
        
        <title>GRC Cinema</title>
    </head>
    
    <body>
        <div id="container">
            <h1 class="form-title">Reset Your Password</h1>
            <div class="row">
                <div class="info">
                    <input type="password" id="psd" name="psd" required />
                    <label for="psd">Enter new password<span class="star">*</span></label>
                    <div id="error_message_3"></div>
                </div>
                
                <div class="info">
                    <input type="password" id="confirm-psd" name="confirm-psd" required />
                    <label for="confirm-psd">Confirm new password<span class="star">*</span></label>
                    <div id="error_message_4"></div>
                </div>
            </div>
                
            <div id="psd-requirements" >
                <p>Password must contain the following:</p>
                <div id="letter" class="invalid">A <span class="requirement">lowercase</span> letter</div>
                <div id="capital" class="invalid">A <span class="requirement">capital (uppercase)</span> letter</div>
                <div id="number" class="invalid">A <span class="requirement">number</span> and a <span class="requirement">symbol</span></div>
                <div id="length" class="invalid">Minimum <span class="requirement">8 characters</span></div>
            </div>
            
            <div class="form-submit" style="margin-bottom: 70px;">
                <input type="submit" name="submit" id="btnSubmit" value="RESET PASSWORD" style="width: 100%;" />
            </div>
        </div>
        
        <script type="text/javascript">
            document.getElementById("psd").addEventListener("blur", checkPsd);
            document.getElementById("psd").addEventListener("input", checkPsd);
            document.getElementById("psd").addEventListener("keyup", display);
            document.getElementById("confirm-psd").addEventListener("blur", checkConfirmPsd);    
            document.getElementById("confirm-psd").addEventListener("input", checkConfirmPsd);    
        </script>
    </body>
</html>



<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    
    <head>
        <meta charset="UTF-8">
       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="css/admin_seat.css" rel="stylesheet" type="text/css"/>
        <title>GRC Cinema</title>
    </head>
    <body>
        <?php
      include'C:\xampp\htdocs\GRC\sidebar_detail.php'
      ?>
        
        <div id="main">
        <div class="head"> 
          <div class="col-div-6"></div>
            <span class="dashboard nav" onclick="dashboard()" >&#9776; Seats</span>
            <span class="dashboard nav2" onclick="dashboard2()" >&#9776; Seats</span>
            

          <div class="col-div-6"></div>
          
          <div class="profile">
              
              <img src="img/baby.jpg" class="pro-img"  alt="">
            <p >Baby Boss <span>President</span></p>
          </div>

          <div class="clearfix"></div>


          <div class="col-div-8">
            <div class="box-8">
              <div class="content-box">
                  <p>Seats </p>
                 
                   
                    <?php
                    echo'<div class="container">';
                    echo'<div class="screen"></div>';
                    for ($i=0;$i<12;$i++){
                        echo'<div class="row">';
                         for($j=0;$j<18;$j++){
                              echo'<div id="seat" class="seat fa-solid fa-couch fa-2xs"></i></div>';
                         }
                         echo'</div>';
                      }
                         
      ?>
                <table>
                    <tr>
                      <div class="container2">
	
			<div class="form-group">
                            <span class="text-light">Time</span><input type="date" class="form-control" id="date">
			</div>
			<div class="form-group">
                            <span class="text-light">Hall</span><select class="form-control" id="theater">
					<option value="">Choose Hall</option>
					<option value="1">Hall 1</option>
					<option value="2">Hall 2</option>
					<option value="3">Hall 3</option>
                                        <option value="4">Hall 4</option>
                                        <option value="5">Hall 5</option>
				</select>
			</div>
			<div class="form-group">
				
				<input type="hidden" class="form-control" id="seat" name="seat">
			</div>
                          <br><br><br><br>
			<button type="submit" class="btn btn-success">Confirm</button>
	
	</div>
                    </tr>
                    
                </table>
                        
                         </div>
                   </div>
                
              </div>
            </div>
          </div>
          
          

       
       <script src="js/admin_seat.js"></script>
    </body>
   
</html>

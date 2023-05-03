<!DOCTYPE html>
<?php error_reporting(0);?>
<html>
    <head>
       <title>GRC Cinema</title>
        <link rel="icon" type="image/x-icon" href="img/GRC.ico">
        <link href="css/seat.css" rel="stylesheet" type="text/css"/>
        <link href="Booking/booking.css" rel="stylesheet" type="text/css"/>

        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
       
        <title>Movie and Seat</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,200,1,200" />
    </head>
    
    <body>
        <?php 
        date_default_timezone_set('Asia/Kuala_Lumpur'); 
        include './timetable.php';
        ?>
            <form name="date" action="seatsel.php" method="POST"  >
                <label id="ld"for="bookdate">Date: </label>
                <input type="date" id="theDate" name="bookdate" value="<?php echo $_POST['bookdate']; ?>" onchange="this.form.submit()">
                <label id="lh"for="hall">Hall: </label>
                <select id="hall_select" name="hall" onchange="this.form.submit()">
                    <option value="1"<?php if(isset($_POST['hall']) && $_POST['hall'] == "1") echo " selected"; ?>>1</option>
                    <option value="2"<?php if(isset($_POST['hall']) && $_POST['hall'] == "2") echo " selected"; ?>>2</option>
                    <option value="3"<?php if(isset($_POST['hall']) && $_POST['hall'] == "3") echo " selected"; ?>>3</option>
                    <option value="4"<?php if(isset($_POST['hall']) && $_POST['hall'] == "4") echo " selected"; ?>>4</option>
                    <option value="5"<?php if(isset($_POST['hall']) && $_POST['hall'] == "5") echo " selected"; ?>>5</option>
                </select>
                <select class="select3" name="time" onchange="this.form.submit()">
                    <option value="10:00:00"<?php if(isset($_POST['time']) && $_POST['time'] == "10:00:00") echo " selected"; ?>>10.00 AM</option>
                    <option value="13:00:00"<?php if(isset($_POST['time']) && $_POST['time'] == "13:00:00") echo " selected"; ?>>13.00 PM</option>
                    <option value="16:00:00"<?php if(isset($_POST['time']) && $_POST['time'] == "16:00:00") echo " selected"; ?>>16.00 PM</option>
                    <option value="19:00:00"<?php if(isset($_POST['time']) && $_POST['time'] == "19:00:00") echo " selected"; ?>>19.00 PM</option>
                    <option value="22:00:00"<?php if(isset($_POST['time']) && $_POST['time'] == "22:00:00") echo " selected"; ?>>22.00 PM</option>
                </select>
            </form>
        <table class="seatbar">
            <tr>
                <td>
                    <figure>
                        <span class="material-symbols-rounded guide available" style="cursor:default;filter: brightness(100%);position:relative;top:5px;">weekend</span>
                        <figcaption style="text-align: center;color:yellow;" >Available</figcaption>
                    </figure>
                </td>
                <td>
                    <figure >
                        <span class="material-symbols-rounded selected" style="cursor:default;position:relative;top:5px;">weekend</span>
                        <figcaption style="color:#38FFFC;text-align: center;" >Selected</figcaption>
                    </figure>
                </td>
                <td>
                    <figure>
                        <span class="material-symbols-rounded disavailable" style="cursor:default;position:relative;top:5px;" >weekend</span>
                        <figcaption style="text-align: center;color:red;" >Sold</figcaption>
                    </figure>
                </td>
            </tr>
        </table>
        <!-- The Modal -->
        <div id="modalBox" class="modal">

            <!-- Modal content -->
            <span class="close">&times;</span>
            <div class="flex-container">                
                <div class="classic" onclick="toggleArrow(); dropdownActive()">
                    Classic <span class="arrow"></span>
                </div>       
                <form id="booking" name="booking" action="Payment/payment-method.php" method="POST"> 
                    <div class="dropdown">                        
                        <div class="content">                                                
                            <div class="flex1 pos1">                    
                                Adult<br/><span id="adultPrice" data-value="19.00" style="color: red; font-size: 15px;">RM 19.00</span>
                            </div>

                            <div class="flex2 pos2">
                                <div class="ticketQty">
                                    <div class="flex3"><input type="button" class="button1" value="-" onclick="adultDecrementQty()" /></div>
                                    <div class="flex4"><input type="text" id="adultQty" name="adultQty" value="0" size="1" disabled /></div>
                                    <div class="flex5"><input type="button" class="button2" value="+" onclick="adultIncrementQty()" /></div>
                                </div>
                            </div>                                     
                        </div> 

                        <div class="content">
                            <div class="flex1 pos1">   
                                Child<br/><span id="childPrice" data-value="13.00" style="color: red; font-size: 15px;">RM 13.00</span>  
                            </div>

                            <div class="flex2 pos2">
                                <div class="ticketQty">
                                    <div class="flex3"><input type="button" class="button1" value="-" onclick="childDecrementQty()" /></div>
                                    <div class="flex4"><input type="text" id="childQty" name="childQty" value="0" size="1" disabled /></div>
                                    <div class="flex5"><input type="button" class="button2" value="+" onclick="childIncrementQty()" /></div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="foot-container">
                        <div class="totalPrice">Total <b>RM</b><input type="text" id="total" name="total" value="0.00" size="2" disabled onchange="calculateTotal()" /></div>
                        <div><input type="button" value="CONTINUE" id="continue" name="continue" onclick="location='Payment/payment-method.php'" /></div>
                    </div>
                </form>                     
            </div>        
        </div>
        
        <?php
// 连接到数据库
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("connection fail: " . $conn->connect_error);
}

$movieId = $_SESSION['movieId'];

$timeseat=$_POST['time'];
if(empty($timeseat)){
    $timeseat='13:00:00';
}
$hall_id=$_POST['hall'];
if(empty($hall_id)){
    $hall_id=1;
}
$date=$_POST['bookdate'];
if(empty($date)){
    $date=date("Y-m-d");
}


$sqlbook="SELECT seat_id FROM booking";
$sql = "SELECT seatRow, seatCol,seat_id,status FROM seat where hall_id =" . (string)$hall_id;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // 输出数据 
  echo '<form action="C:\xampp\htdocs\GRC\Payment\stripe-payment.php" method="POST" onsubmit="return validateForm()" >';
  echo '<div id="seat_area">';
  echo '<div id="screen"></div>';
 
  for($i = 1; $i <= 12; $i++) {
    for($j = 1; $j <= 18; $j++) {
      $status = "disavailable";
      $checkbox= "disabled";
      while($row = $result->fetch_assoc()) {
        if (($row['seatRow'] == $i && $row['seatCol'] == $j) && $row['status'] == "AVAILABLE") {
          $status = "available";
          $checkbox="";
          //
            $sid=$row['seat_id'];
            //echo $sid;
            $sqlb="SELECT * FROM booking WHERE seat_id ='$sid' AND date='$date' AND hall_id=$hall_id AND time='$timeseat' ";
            if($bk=$conn->query($sqlb)){
                if($bk->num_rows>0){
                    $status="disavailable";
                   
                }
                 
            }

          break;
        }
        
      }
      if($j == 5 || $j == 15){
          $leftmargin=20;
      }
      else{
           $leftmargin=0;
      } 
      $symbol = "weekend";
      $letter = chr(65 + $i - 1);
      $colnum = sprintf('%02s', $j); 
      $seatValue=(string)$hall_id . $letter . (string)$colnum;
      echo '<label>';
      echo "<input type=\"checkbox\" class=\"seat $status\" name=\"seat[]\" value=\"$seatValue\" $checkbox>";
      echo "<span class=\"material-symbols-rounded seat $status\" style=\"margin-left: ". $leftmargin . "px\">$symbol</span>";
      echo '</label>';
   
      $result->data_seek(0); 
    }
    echo '<br>';
  }
  echo '<br>';
  echo '</div>';
  echo '<input type="hidden" name="date" value="' . $date . '"/>';
  echo '<input type="hidden" name="hall" value="' . $hall_id . '"/>';
  echo '<input type="hidden" name="time" value="' . $timeseat . '"/>';
  echo '<input type="hidden" name="movie_id" value="' . $movieId . '"/>';
  echo '<input type="hidden" name="movie_name" value="' . $movie_name . '"/>';
  //<!-- Trigger/Open The Modal -->
  
  echo "<center><input id='cbtn' onclick='jumpout()' class='btnContinue' type='submit' disabled value='CONTINUE' /></center>";


  echo '</form>';
} else {
  echo "0";
}


$conn->close();
?>

        <script>
function myFunction() {
  alert("Hello World!");
}
            
            function validateForm() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checked = Array.prototype.slice.call(checkboxes).some(x => x.checked);
        document.querySelector('input[type="submit"]').disabled = !checked;
    }
            
            
        const radios = document.querySelectorAll('input[type=checkbox]');
        const submitBtn = document.querySelector('input[type=submit]');
        radios.forEach(radio => {
            var cbtn = document.getElementById('cbtn');
            radio.addEventListener('click', () => { 
                submitBtn.disabled = false;
                cbtn.style.filter='brightness(100%)';
            });
            radio.addEventListener('change', () => {
                if (!radio.checked) {
                    submitBtn.disabled = true;
                    cbtn.style.filter='brightness(50%)';
                }
            });
        });
         
$(document).ready(function() {
    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month ="0" + month;
    if (day < 10) day ="0" + day;

    var today = year +"-" + month +"-" + day;      
    $("#theDate").attr("value", today);
});




        </script>
        <script>
        var modal = document.getElementById("modalBox");
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        function jumpout() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
        
        function toggleArrow(){
            var arrow = document.querySelector(".arrow");
            arrow.classList.toggle("active");          
        }
        
        function dropdownActive(){
            var dropdown = document.querySelector(".dropdown");
            dropdown.classList.toggle("dropdown-active");          
        }  
        
        function calculateTotal() {
            var adultPrice = parseFloat(document.getElementById("adultPrice").getAttribute("data-value"));
            var adultQty = parseInt(document.getElementById("adultQty").value);
            var childPrice = parseFloat(document.getElementById("childPrice").getAttribute("data-value"));
            var childQty = parseInt(document.getElementById("childQty").value);
            var total = (adultPrice * adultQty) + (childPrice * childQty);
            document.getElementById("total").value = total.toFixed(2);
	}

        function adultIncrementQty() {
            var adultQty = parseInt(document.getElementById("adultQty").value);          
            document.getElementById("adultQty").value = adultQty + 1;           
            calculateTotal();
	}

	function adultDecrementQty() {
            var adultQty = parseInt(document.getElementById("adultQty").value);          
            if (adultQty > 0) {
		document.getElementById("adultQty").value = adultQty - 1;
		calculateTotal();
            }
	}
        
        function childIncrementQty(){
            var childQty = parseInt(document.getElementById("childQty").value);
            document.getElementById("childQty").value = childQty + 1;
            calculateTotal();
        }
        
        function childDecrementQty(){
            var childQty = parseInt(document.getElementById("childQty").value);
            if(childQty > 0){
                document.getElementById("childQty").value = childQty - 1;
                calculateTotal();
            }
        }
        

        
        $(document).ready(function(){
            $('#continue').click(function(){
                $('#total').removeAttr('disabled');
            });
        });
        </script>
        
    </body>
</html>

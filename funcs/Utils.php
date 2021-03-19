<?php


function verifyUser(){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $user= getFetchArray("select * from users where username=".cheSNull($username))[0];
    $result = password_verify($password, $user['password']);    
    //$id = getSingleValue("select id from users where username=".cheSNull($username)." and password = ".cheSNull($password));
    if($result==1){
        //print(" username ".$username." and password ".$password." and id is ".$id);
        //$role = getSingleValue("select role from users where id=".$id);
        $_SESSION['uid']=$user['id'];
        $_SESSION['user']=$user['username'];
        $_SESSION['role']=$user['role'];
        header('Location: index.php');
    }else{
        include_once 'funcs/login.php';
        displayLoginPage("Invalid entry");
    }
}


function sendMail(){
    
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $mobile_no=$_POST['mobile_no'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    
    ini_set("SMTP", SMTP_HOST);
    ini_set("smtp_port", SMTP_PORT);
    ini_set("sendmail_from", MAIL_FROM_ADDRESS);
    
    $toAddress=MAIL_TO_ADDRESS; 
    $today = date("d-m-Y H:i:s");
    $subject="[Enquiry]:: ".$first_name." ".$last_name;
    $content="<html><head><style>
table {
  border-collapse: collapse;
}
        
table, th, td {
  border-bottom: 1px solid #ddd;
}
th{
    background-color: #4CAF50;
    color: white;
    border-right: 1px solid white;
    font-weight: bold;
}
th, td {
  padding: 15px;
  text-align: left;
  font-size:14px;
  font-family: 'Lucida Console', Courier, monospace;
}
</style></head><body>
<table>
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Date</th>
		<th>Mobile Number</th>
		<th>Email</th>
        <th>Message</th>
	</tr>
	<tr>
		<td>".$first_name."</td>
		<td>".$last_name."</td>
		<td>".$today."</td>
        <td>".$mobile_no."</td>
		<td>".$email."</td>
		<td>".$message."</td>
	</tr>
</table></body></html>";
    
    $headers = "From: ";
    $headers = "From: " . strip_tags(MAIL_FROM_ADDRESS) . "\r\n";
    $headers .= "Reply-To: ". strip_tags(MAIL_FROM_ADDRESS) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    mail($toAddress, $subject, $content, $headers);
    //echo "Check your email now....&lt;BR/>";
    
}


function showFormToUpdateHouse($id)
{
    $tenants = getFetchArray("select * from houses where id = " . $id);
    return '<form method="post" action="house.php">
    <input type="hidden" name="action" value="update_house">
    <input type="hidden" name="id" value="' . $tenants[0]['id'] . '">
        
Name <input type="text" value="' . $tenants[0]['house_name'].'" class="form-control" name="house_name">
<br>
Address <input type="text" value="' . $tenants[0]['address'] . '" class="form-control" name="address">
<br>
No Of Apartments <input type="text" value="' . $tenants[0]['no_of_apartments'] . '" class="form-control" name="no_of_apartments">
<br>

Ward Number <input type="text" value="' . $tenants[0]['ward_no'] . '" class="form-control" name="ward_no">
<br>

Google Map Src <textarea class="form-control" name="google_map_src">' . $tenants[0]['google_map_src'] . '</textarea>
<br>

EB Service No <input type="text" value="' . $tenants[0]['eb_service_no'] . '" class="form-control" name="eb_service_no">
<br>
    
</form>';
}

function scriptForShowFormToNewCustomer(){
    ?>
    <script>
$(document).ready(function() {
    $("[id=showFormToAddCustomer]").click(function () {
        var url1 = $(this).data("url");
        $.ajax({
            dataType: "html",
            type: "GET",
            url: url1,
            success: function(msg){                
                $(".modal-body").html(msg);
                $("#formToAddCustomer").modal("show");
            }
        });
    });
});
</script>
    <?php
}

function modalToAddCustomer(){
    ?> 
    <!-- Modal for add customer -->
		<div class="modal fade" id="formToAddCustomer" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form action="customers.php" method="POST" name="add_customer">
						<input type="hidden" name="action" value="add_customer">
						<div class="modal-header" style='border: none;'>
							<h5 class="modal-title">
								Add New Customer <i class="fa fa-check-square" aria-hidden="true"></i>
							</h5>
							<button aria-hidden="true" class="close" data-dismiss="modal"
								type="button">×</button>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button class="btn btn-secondary" style='' data-dismiss="modal">Close</button>
							<button class="btn btn-primary" type="submit" id="atc" style=''>Proceed</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Modal - show atc response -->
		<?php 
}

function addNewCustomerButton(){
    ?>
    	<button class="btn btn-primary btn-sm btn-action1" title="Add New Customer" data-url="customers.php?action=showFormToAddCustomer" id="showFormToAddCustomer" type="button">Add New Customer</button>
    <?php 
}

function modalToAddReceiver(){
    ?>
    	<!-- Modal for add customer -->
		<div class="modal fade" id="formToAddReceiver" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form action="receivers.php" method="POST" name="add_customer">
						<input type="hidden" name="action" value="add_receiver">
						<div class="modal-header" style='border: none;'>
							<h5 class="modal-title">
								Add New Receiver <i class="fa fa-check-square" aria-hidden="true"></i>
							</h5>
							<button aria-hidden="true" class="close" data-dismiss="modal"
								type="button">×</button>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button class="btn btn-secondary" style='' data-dismiss="modal">Close</button>
							<button class="btn btn-primary" type="submit" id="addReceiver" style=''>Proceed</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Modal - show atc response -->
    
    
		<?php 
}

function scriptForShowFormToNewReceiver(){
    ?>
    <script>

$(document).on('click','#showFormToAddReceiver',function(){
	var url1 = $(this).data("url");        	  
	  
	  $.ajax({
          dataType: "html",
          type: "GET",
          url: url1,
          success: function(msg){                
              $(".modal-body").html(msg);
              $("#formToAddReceiver").modal("show");
          }
      });
 });
</script>
    <?php
}




?>
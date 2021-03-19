<!doctype html>
<html lang="en">
<?php
include 'funcs/Utils.php';
$rate=getSingleValue("select transfer from  xchange where scur='CHF' and rcur='LKR' ");
$sql="select id,card_no,first_name,last_name, visa_expiry from customer order by card_no desc";
$senders = getFetchArray($sql);
$options="<option value=''></option>";
$date = date('Y-m-d');
foreach ($senders as $row) {
    if($date<$row['visa_expiry']){
        $options.="<option value='".$row['id']."'>".$row['card_no']." - ".$row['first_name']." ".$row['last_name']."</option>";
    }else{
        $options.="<option value='".$row['id']."'>Expired - ".$row['card_no']." - ".$row['first_name']." ".$row['last_name']."</option>";
    }
}

$sql="select id,first_name, last_name, city from agents where dc_currency is not null order by id";
$agents = getFetchArray($sql);
$agentOptions="<option value=''></option>";
foreach ($agents as $row) {
    $agentOptions.="<option value='".$row['id']."'>".$row['first_name']." ".$row['last_name']." - ".$row['city']."</option>";
}

?>
<head>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php echo getHead("Send Money","", "");?>
</head>
<body>
	<?php echo getNavigationMenu();?>
	<main role="main">
		<div class="container marketing">
			<div class="blog-post">
				<p class="h1">Send Money</p>
				<form method="POST" action="index.php">
				<input type="hidden" name="action" value="sendMoney">
				<table class="table table-sm table-hover">
					<tbody>
						<tr><th scope="col">Sending Currency</th><td>
						<select name="scurrency" id="scurrency">
							<option value="CHF">CHF</option>
							<option value="EUR">EUR</option>
						</select>
						</td></tr>
						<tr><th scope="col">Receiving Currency</th><td>
						<select name="rcurrency" id="rcurrency">
							<option value="LKR">LKR</option>
							<option value="INR">INR</option>
						</select>
						</td></tr>
						<tr><th scope="col">Exchange Rate</th><td><input name="rate" style="width: 75px;" type="text" id="rate" value="<?php echo $rate;?>"></td></tr>
						<tr><th scope="col" colspan="2" style='background-color: #f2f2f2'>Sender Details</th></tr>
						<tr><th scope="col">Sending Customer</th><td>
						<select style='width: 450px;' class="js-example-basic-single" id="sender" name="sender">
							<?php echo $options;?>
						</select>
						<?php addNewCustomerButton();?>
						
						</td></tr>
						<tr><td scope="col" colspan="2">
							<div id="fill"></div>
													
						</td></tr>
						
						<tr><th scope="col" colspan="2" style='background-color: #f2f2f2'>Receiver Details</th></tr>
						<tr><th scope="col">Receving Customer</th><td><input id="rxr" name="receiver" style="width: 250px;" type="text" required readonly></td></tr>
						
						<tr><th scope="col">Sending Amount *</th><td><input required  style="width: 175px;" type="number" value="" id="samount" name="samount"> <button type="button" onclick="calcRamount()">=</button></td></tr>
						<tr><th scope="col">Receiving Amount</th><td><input style="width: 175px;" type="number" value="" id="ramount" name="ramount"> <button type="button" onclick="calcSamount()">=</button></td></tr>
						<tr><th scope="col">Order Type</th><td><select name="orderType" id="orderType"><option value='normal'>Normal</option><option value='express'>Express</option></select></td></tr>
						<tr><th scope="col">Service Charge</th><td><input style="width: 75px;" type="text" value="" id="scharge" name="scharge"> <button type="button" onclick="calcTotal()">=</button> </td></tr>
						<tr><th scope="col">Total Amount</th><td><input style="width: 75px;" type="text" value="" id="total" name="total"></td></tr>						
						<tr><th scope="col">Receiving Agent</th><td><select name="ragent_id"><?php echo $agentOptions;?></select></td></tr>
						<tr>
							<th scope="col">Comments</th>
							<td><textarea class="form-control form-control-sm"
								id="comments" name="comments"></textarea></td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="order.php" role="button" class="btn btn-secondary btn-sm">Cancel</a>
								<button type="reset" class="btn btn-warning btn-sm">Reset</button>
								<button style="float: right;" type="submit" class="btn btn-primary btn-sm">Submit</button>
							</td>
						</tr>
					</tbody>
				</table>
				</form>
			</div>
		</div>
		<!-- /.container -->

		<!-- FOOTER -->
		<footer class="container">
			<p class="float-right">
				<a href="#">Back to top</a>
			</p>
			<p>
				&copy; Saran Solutions CH. &middot; <a href="#">Privacy</a> &middot;
				<a href="#">Terms</a>
			</p>
		</footer>
	</main>

	<?php 
	   modalToAddCustomer();
	   modalToAddReceiver();
	?>
  	
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/typeahead.bundle.js" type="text/javascript"></script>
	<script src="js/jquery.cookie.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	    $('.js-example-basic-single').select2();
	});
	</script>

	<script>
    $(document).on('change', '#pmode', function(){
    	var pmode=$('#pmode').val();
    	if(pmode!='rent'){
    		$('#ramount').val("0");
    		$('#comments').text("Explain the cost...");	
        }else{
            var origional_rent=$('#original_rent').val();
        	$('#ramount').val(origional_rent);
        	$('#comments').text("");
        }
    });
        </script>

<script type="text/javascript">
    $(document).ready(function()
    {
    	$("#scurrency").change(function()
    	{
    		var scurrency = $(this).val();
    		var rcurrency = $("#rcurrency").val();
    		var data = {'scur': scurrency, 'rcur':rcurrency};
    		$.ajax
    	    ({
    	      dataType: 'json',
    	      type: "POST",
    	      data: data,   
    	      cache: false,
    	      url : "exchange.php",
    	      success: function(data)
    	      {
    	        $("#rate").val(data);
    	      }
    	      });

		});	    

      });
</script>

<script type="text/javascript">
    $(document).ready(function()
    {
    	$("#rcurrency").change(function()
    	{
    		var rcurrency = $(this).val();
    		var scurrency = $("#scurrency").val();
    		var data = {'scur': scurrency, 'rcur':rcurrency};
    		$.ajax
    	    ({
    	      dataType: 'json',
    	      type: "POST",
    	      data: data,   
    	      cache: false,
    	      url : "exchange.php",
    	      success: function(data)
    	      {
    	        $("#rate").val(data);
    	      }
    	      });

		});	    

      });
</script>



<script type="text/javascript">
    $(document).ready(function()
    {
      $("#sender").change(function()
    {
    	  var cid = $(this).val(); 
    	  var data = {'action':'getAllOrders', 'id':cid};
    $.ajax
    ({
      type: "POST",
      data: data,
      cache: false,
      url : "index.php",
      success: function(data)
      {
        $("#fill").html(data);
      }
      });

      });

      });
</script>

<script type="text/javascript">
	$(document).on('click','#ex_receiver',function(){
		var rid = $(this).val();        	  
  	  var data = {'action':'getReceiverName', 'id':rid};
  $.ajax
  ({
    type: "POST",
    data: data,
    cache: false,
    url : "receivers.php",
    success: function(data)
    {
      $("#rxr").val(data);
    }
    });
	 });
</script>

<script type="text/javascript">
    $(document).ready(function()
    {
      $("#orderType").change(function()
    {
    	
		var orderType = $(this).val();		
		if(orderType.localeCompare('express') == 0){
			$("#scharge").val("15");
		}else{
			$("#scharge").val("5");
			}
      });

      });
</script>


<script>
function calcRamount()
{
	
		var rate=$("#rate").val();
		var samount=$("#samount").val();
		if (samount>0){
			var ramount=rate * samount; 
			$("#ramount").val(ramount);
		}
}
function calcSamount()
{
	
		var rate=$("#rate").val();
		var ramount=$("#ramount").val();
		if (ramount>rate){
			var samount=ramount/rate; 
			samount=samount.toFixed(2)
			$("#samount").val(samount);
		}else{
			$("#samount").val(0);
			}
}
function calcTotal()
{
	var samount=$("#samount").val();
	var scharge=$("#scharge").val();
	var total = +samount + +scharge;
	$("#total").val(total);
}
</script>

<?php 
    scriptForShowFormToNewCustomer();
    scriptForShowFormToNewReceiver();
 ?>


</html>
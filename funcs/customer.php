<?php

function showFormToAddCustomer(){?>
<table class="table table-sm">
	
	<tr><td>First Name *</td><td><input type="text" name="first_name" required id="first_name"></td></tr>
	<tr><td>Last Name</td><td><input type="text" name="last_name" id="last_name"></td></tr>
	
	<tr><td>DOB *</td><td><input type="date" name="dob" required id="dob"></td></tr>
	<tr><td>Street and No *</td><td><input type="text" name="no_street" required id="no_street"></td></tr>
	<tr><td>City *</td><td><input type="text" name="city" required id="city"></td></tr>
	<tr><td>Zip *</td><td><input type="number" name="zip" required id="zip"></td></tr>
	<tr><th scope="col" colspan="2" style='background-color: #f2f2f2'>Contact Details</th></tr>
	<!-- <tr><td>Phone</td><td><input type="text" name="phone"  id="phone"></td></tr> -->
	<tr><td>Handy *</td><td><input type="tel" placeholder="0795680636" name="handy" required id="handy"></td></tr>
	<!-- <tr><td>Email</td><td><input type="text" name="email" id="email"></td></tr> -->
	<tr><th scope="col" colspan="2" style='background-color: #f2f2f2'>Visa Details</th></tr>
	<tr><td>Visa Number</td><td><input type="text" name="visa_no"  id="visa_no"></td></tr>
	<tr><td>Visa Expiry Date</td><td><input type="date" name="visa_expiry" id="visa_expiry"></td></tr>
	<tr><td>Visa File</td><td><input type="file" name="visa_file" id="visa_file"></td></tr>
	
</table>
<?php }

function addCustomer(){
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $dob=$_POST["dob"];
    $no_street=$_POST["no_street"];
    $city=$_POST["city"];
    $zip=$_POST["zip"];
    $handy=$_POST["handy"];
    $visa_no=$_POST["visa_no"];
    $visa_expiry=$_POST["visa_expiry"];
    $visa_file=$_POST["visa_file"];
    $card_no=getSingleValue("select max(card_no) from customer");
    $card_no+=1;
    $date = date('Y-m-d');
    $visa_status="INVALID";
    if($visa_expiry>$date){
        $visa_status="VALID";
    }
    $sql="INSERT INTO customer(prefix, first_name, last_name, DOB, no_street, city, zip, phone, handy, email,  card_no, country, visa_no, visa_expiry, visa_status, file_name) 
                        VALUES ('Mr','$first_name','$last_name','$dob','$no_street','$city','$zip',NULL,'$handy','email',$card_no,'1','$visa_no','$visa_expiry','$visa_status','$visa_file')";
    return insertSQL($sql);
    
}


function showFormToAddReceiver($id){
    $name=getSingleValue("select first_name from customer where id=".$id);
    ?>
    <input type="hidden" name="id" value="<?php echo $id?>">
<table class="table table-sm">
	<tr style='background-color: #f2f2f2'><th scope="col">Sender</th><td><?php echo $name;?></td></tr>
	<tr><td>First Name *</td><td><input type="text" name="first_name" required id="first_name"></td></tr>
	<tr><td>Last Name</td><td><input type="text" name="last_name" id="last_name"></td></tr>
	<tr><td>Handy *</td><td><input type="tel" placeholder="0795680636" name="handy" required id="handy"></td></tr>
	<tr><td>Address *</td><td><input type="text" name="address" required id="address"></td></tr>
	<tr><td>Country</td><td><select name="country"><option value="Srilanka">Srilanka</option><option value="India">India</option></select></td></tr>
	
	<!-- <tr><td>Email</td><td><input type="text" name="email" id="email"></td></tr> -->
	<tr><th scope="col" colspan="2" style='background-color: #f2f2f2'>Bank Details</th></tr>
	<tr><td>Bank Account No</td><td><input type="text" name="bank_ac_no"  id="bank_ac_no"></td></tr>
	<tr><td>Bank Name</td><td><input type="text" name="bank_name" id="bank_name"></td></tr>
	<tr><td>Bank Branch</td><td><input type="text" name="bank_branch" id="bank_branch"></td></tr>
	
	
</table>
<?php }

function addReceiver(){
    $first_name=$_POST["first_name"];
    $last_name=$_POST["last_name"];
    $handy=$_POST["handy"];
    $address=$_POST["address"];
    
    $bank_ac_no=$_POST["bank_ac_no"];
    $bank_name=$_POST["bank_name"];
    $bank_branch=$_POST["bank_branch"];
    $sender_id=$_POST["id"];
    $country=$_POST["country"];
    
    
    $sql="INSERT INTO rxr_customer(sender_id, is_agent, rxr_first_name, rxr_last_name, rxr_mobile_no, rxr_address, rxr_bank_ac_no, rxr_bank_name, rxr_bank_branch, rxr_reg_no, rxr_country) 
                            VALUES ($sender_id,1,'$first_name','$last_name','$handy','$address','$bank_ac_no','$bank_name','$bank_branch',NULL,'$country')";
    //print($sql);
    return insertSQL($sql);
    
}

?>


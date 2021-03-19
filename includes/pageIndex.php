<!doctype html>
<html lang="en">
	<?php
	$sql="select t1.* from ( select i.inv_id, i.mdate, (select cname from customer where cust_id=i.cust_id)cname, cust_id, 
t.total_price,t.discount, t.net_amount, t.deposit, t.balance, t.status 
 from invoices i, transactions t where t.inv_id=i.inv_id and 1=1 )t1 where 1=1 order by inv_id desc";
	$orders = getFetchArray($sql);
	echo getHead("Home", "", "")?>
	<body>
		<?php echo getNavigationMenu()?>
		<main role="main">
			<div class="container">
				<div class="blog-post">
					<p class="h1">Customer Orders</p>
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  						
  						<button 
									class="btn btn-success btn-sm btn-action1" 
									title="Add new Order" 
									data-id="" 
									id="showFormNewOrder" type="button"> <i class="fa fa-plus-circle" aria-hidden="true"></i> New Order</button>                        
					</div>
					<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Id</th>
								<th>Date</th>
								<th>Customer Name</th>
								<th>Total price</th>
                                <th>Discount</th>
                                <th>Net Amount</th>
                                <th>Deposit</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php
							 foreach ($orders as $row) {
                            ?>					 
							<tr>
								<td>
									<a href='index.php?id=<?php echo $row['inv_id'];?>'>
										<?php echo $row['inv_id'];?>
									</a>
								</td>
								<td>
									<a href='index.php?id=<?php echo $row['inv_id'];?>'>
										<?php echo $row['mdate'];?>
									</a>
								</td>
								<td>
									<a href='customer.php?id=<?php echo $row['cust_id'];?>'>
										<?php echo $row['cname'];?>
									</a>
								</td>
								<td>
									<?php echo $row['total_price'];?>
								</td>
								<td>
									<?php echo $row['discount'];?>
								</td>
								<td>
									<?php echo $row['net_amount'];?>
								</td>
								<td>
									<?php echo $row['deposit'];?>
								</td>
								<td>
									<?php echo $row['balance'];?>
								</td>
								
								<td>
									<?php if($row['status']=='ORDERED'){
									    echo '<span class="badge bg-info text-light">'.$row['status'].'</span>';
									}else if($row['status']=='PAID'){
									    echo '<span class="badge bg-success text-light">'.$row['status'].'</span>';
									}else if($row['status']=='UNPAID'){
									    echo '<span class="badge bg-danger text-light">'.$row['status'].'</span>';
									}?>
								</td>
								<td>
									<a href="" title="Print Invoice" target="_blank" style="margin-lef:10px;text-decoration:none;color:#000000 !important;"><i class="fa fa-print" aria-hidden="true"></i></a> 
									<a href="" title="Edit Invoice" target="_blank" style="margin-lef:10px;text-decoration:none;color:#000000 !important;"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
									<a href="" title="Delete Invoice" target="_blank" style="margin-lef:10px;text-decoration:none;color:#000000 !important;"><i class="fa fa-times" aria-hidden="true"></i></a> 
									<a href="" title="Export Invoice" target="_blank" style="margin-lef:10px;text-decoration:none;color:#000000 !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> 
									
								</td>
							</tr>
							<?php
                            }
                            ?>								
						</tbody>
					</table>
					
					</div>
				</div>
			</div>
			<!-- /.container -->
			
			  <!-- Modal for edit tenant-->
		<div class="modal fade" id="newOrderForm" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form action="index.php" method="POST" name="newOrder">
						<input type="hidden" name="action" value="addNewOrder" />						
						<div class="modal-header" style='border: none;'>
							<h5 class="modal-title">
								New Order <i class="fa fa-check-square" aria-hidden="true"></i>
							</h5>
							<button aria-hidden="true" class="close" data-dismiss="modal"
								type="button">×</button>
						</div>
						<div class="modal-body">
						<table class="table table-sm table-hover" id="orderTable">
					<tbody>
						<tr>
							<th scope="col">S.No</th><th scope="col">Product *</th><th scope="col">Size *</th><th scope="col">Quantity *</th><th scope="col">Weight *</th><th scope="col">Price *</th><th scope="col">#</th>
						</tr>
						<tr>
							<td>1</td>
							<td>
								<select name="product1" required style="width: 300px;" >
									<option value="necklace">Necklace</option><option value="chain">Chain</option><option value="bangels">Bangels</option><option value="bangels">Bangels</option><option value="pendonts">Pendonts</option><option value="bracelets">Bracelets</option><option value="ear_rings">Ear Rings</option><option value="rings">Rings</option>
								</select>
							</td>
							<td><select name="size1" required><option value="large">Large</option><option value="medium">Medium</option><option value="Small">Small</option><option value="extraSmall">Extra Small</option></select></td>
							<td><select name="quantity1" required><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></td>
							<td><input type="text" name="weight1" required style="width: 70px;" /></td>
							<td><input type="text" name="price1" required style="width: 70px;" /></td>
							<td><input type="hidden" name="totalNoOfProducts" id="totalNoOfProducts" value="1" /></td>
							<td></td>
						</tr>						
					</tbody>
				</table>
				<div style="margin-top: 100px;">
					<button class="btn btn-warning btn-sm" title="Add New Product" data-url="" id="addNewProduct" type="button">Add New Product</button>
				</div>
				
						</div>
						<div class="modal-footer">
							<button class="btn btn-secondary" style='' data-dismiss="modal">Close</button>
							<button class="btn btn-primary" type="submit" id="atc" style=''>Proceed</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Modal - show atc response -->
			
			<!-- FOOTER -->
			<?php echo getFooter();?>
			
			
			
		</main>
		<?php echo getJavaScript();?>
		
		
		
		
	<script>
$(document).ready(function() {
    $("[id=showFormNewOrder]").click(function () {
    	$("#newOrderForm").modal("show");
    });
});
</script>	

<script>
$(document).ready(function() {
    $("[id=addNewProduct]").click(function () {
        var l="";
        var no=parseInt($('#totalNoOfProducts').val());
        var newNo=no+1;
        var data='<tr id="tableRow'+newNo+'"><td>'+newNo+'</td><td>'+l
        +'<select name="product'+newNo+'" required style="width: 300px;"><option value="necklace">Necklace</option>'+l
        +'<option value="chain">Chain</option><option value="bangels">Bangels</option><option value="bangels">Bangels</option>'+l
        +'<option value="pendonts">Pendonts</option><option value="bracelets">Bracelets</option><option value="ear_rings">'+l
        +'Ear Rings</option><option value="rings">Rings</option></select></td>'+l
        +'<td><select name="size'+newNo+'" required><option value="large">Large</option><option value="medium">Medium</option>'+l
        +'<option value="Small">Small</option><option value="extraSmall">Extra Small</option></select></td><td><select name="quantity1" required>'+l
        +'<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>'+l
        +'<option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option>'+l
        +'<option value="10">10</option><option value="11">11</option><option value="12">12</option></select></td><td>'+l
        +'<input type="text" name="weight'+newNo+'" required style="width: 70px;" /></td><td><input type="text" name="price'+newNo+'" required style="width: 70px;" />'+l
        +'</td><td><input type="hidden" name="totalNoOfProducts" id="totalNoOfProducts" value="'+newNo+'" /><a href="#" id="'+newNo+'" onclick="myfunction(this.id)" >'+l
        +'<i class="fa fa-times" aria-hidden="true"></i></a></td></tr>';
    	$('#orderTable tr:last').after(data);
    	$('#totalNoOfProducts').val(newNo);
    });
});
</script>

<script>
function myfunction(clicked_id) {
	var value = confirm('delete ?');
	if (value === true){
		var no=parseInt($('#totalNoOfProducts').val());
		var newNo=no-1;
		$('#tableRow'+clicked_id).remove();
		$('#totalNoOfProducts').val(newNo);
	}
    
  }
</script>			
		
		
		
	</html>
	
	
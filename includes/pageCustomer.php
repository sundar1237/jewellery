<!doctype html>
<html lang="en">
	<?php
	include 'funcs/Utils.php';
	$sql="select * from customer order by id desc";
	$customers = getFetchArray($sql);
	echo getHead("Customers", "", "")?>
	<body>
		<?php echo getNavigationMenu()?>
		<main role="main">
			<div class="container-fluid">
				<div class="blog-post">
					<p class="h1">Customers</p>
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  						<?php addNewCustomerButton();?>
                        <!-- <button class="btn btn-primary" type="button">Button</button> -->
					</div>
					<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Street</th>
								<th scope="col">City</th>								
								<th scope="col">Phone</th>
								<th scope="col">Handy</th>
								<th scope="col">Card Number</th>
								<th scope="col">Visa Expiry</th>								
								<th scope="col">Visa Status</th>
								<th scope="col">#</th>
							</tr>
						</thead>
						<tbody>
							<?php
							 $count=1;
							 $date = date('Y-m-d');
							 
							 
							 foreach ($customers as $row) {
							     $visaStatus="INVALID";
							     if($row['visa_expiry']>$date){
							         $visaStatus="VALID";
							     }
                            ?>					 
							<tr>
								<td>
									<a href='customer.php?id=<?php echo $row['id'];?>'>
										<?php echo $count.". ".$row['first_name']." ".$row['last_name'];?>
									</a>
								</td>
								<td>
									<?php echo $row['no_street'];?>
								</td>
								<td>
									<?php echo $row['city'];?>
								</td>
								<td>
									<?php echo $row['phone'];?>
								</td>
								<td>
									<?php echo $row['handy'];?>
								</td>
								<td>
									<?php echo $row['card_no'];?>
								</td>
								<td>
									<?php echo $row['visa_expiry'];?>
								</td>
								<td>
									<?php if($visaStatus=='VALID'){
									    echo '<span class="badge bg-success text-light">Ok</span>';
									}else{
									    echo '<span class="badge bg-danger text-light">Nok</span>';
									}?>
								</td>
								<td>
									<?php if($visaStatus=='VALID'){?>
										<button class="btn btn-warning btn-sm float-right" title="Add New Receiver" 
											data-url="receivers.php?id=<?php echo $row['id']?>&action=showFormToAddReceiver" 
											id="showFormToAddReceiver" type="button"><i class="fa fa-address-card-o" aria-hidden="true"></i></button>
										
									<?php } ?>
								</td>
							</tr>
							<?php
							     $count+=1;
    }
                                
                            ?>								
						</tbody>
					</table>
					</div>
				</div>
			</div>
			<!-- /.container -->
			<!-- FOOTER -->
			<?php echo getFooter();?>
		</main>
		
		<?php modalToAddCustomer();
		modalToAddReceiver();
		?>
		
		<?php echo getJavaScript();?>
		
		<?php scriptForShowFormToNewCustomer();
		scriptForShowFormToNewReceiver();
		
		?>
	</html>
<!doctype html>
<html lang="en">
	<?php
	$sql="select * from rxr_customer";
	$customers = getFetchArray($sql);
	echo getHead("Receivers", "", "")?>
	<body>
		<?php echo getNavigationMenu()?>
		<main role="main">
			<div class="container-fluid">
				<div class="blog-post">
					<p class="h1">Receivers</p>
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  						
                        <!-- <button class="btn btn-primary" type="button">Button</button> -->
					</div>
					<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Address</th>
								<th scope="col">Phone</th>
								<th scope="col">Bank</th>
								<th scope="col">Account</th>
								<th scope="col">Branch</th>	
							</tr>
						</thead>
						<tbody>
							<?php
							 $count=1;
							 foreach ($customers as $row) {
                            ?>					 
							<tr>
								<td>
									<a href='customer.php?id=<?php echo $row['id'];?>'>
										<?php echo $count.". ".$row['rxr_first_name']." ".$row['rxr_last_name'];?>
									</a>
								</td>
								<td>
									<?php echo $row['rxr_address'];?>
								</td>
								<td>
									<?php echo $row['rxr_mobile_no'];?>
								</td>
								<td>
									<?php echo $row['rxr_bank_name'];?>
								</td>
								<td>
									<?php echo $row['rxr_bank_ac_no'];?>
								</td>
								<td>
									<?php echo $row['rxr_bank_branch'];?>
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
		<?php echo getJavaScript();?>
	</html>
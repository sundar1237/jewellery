<!doctype html>
<html lang="en">
	<?php
	$sql="select * from agents order by id desc";
	$customers = getFetchArray($sql);
	echo getHead("Agents", "", "")?>
	<body>
		<?php echo getNavigationMenu()?>
		<main role="main">
			<div class="container">
				<div class="blog-post">
					<p class="h1">Customers</p>
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  						<a class="btn btn-primary btn-sm text-light" type="button" href="customer.php?action=addCustomer">Add New Agent</a>
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
								<th scope="col">Commission</th>
								<th scope="col">Currency</th>	
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
									<?php echo $row['d_commi'];?>
								</td>
								<td>
									<?php echo $row['dc_currency'];?>
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
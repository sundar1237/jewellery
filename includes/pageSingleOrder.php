<!doctype html>
<html lang="en">
<?php
$id=$_GET['id'];
$sql="select o.*, (select first_name from customer where id = o.sender_id )first_name, 
(select last_name from customer where id = o.sender_id )last_name from orders o  where id=".$id;
$orders = getFetchArray($sql);
echo getHead("Home", "", "")?>
	<body>
		<?php echo getNavigationMenu()?>
		<main role="main">
			<div class="container">
				<div class="blog-post">
					<p>Customer Order > <?php echo $id;?></p>
					<div class="table-responsive">
					<table class="table table-hover">						
						<tbody>
							<?php
							 
							 foreach ($orders as $row) {
                            ?>					 
							<tr>
								<th scope="col">Name</th>
								<td>
									<a href='customer.php?id=<?php echo $row['id'];?>'>
										<?php echo $row['first_name']." ".$row['last_name'];?>
									</a>
								</td>
							</tr>
							<tr>
								<th scope="col">Sending Amount</th>
								<td>
									<?php echo round($row['samount'])." ".$row['scur'];?>
								</td>
							</tr>
							<tr>
								<th scope="col">Exchange Rate</th>
								<td>
									<?php echo $row['er'];?>
								</td>
							</tr>
							<tr>
								<th scope="col">Receiving Amount</th>	
								<td>
									<?php echo round($row['ramount'])." ".$row['rcur'];?>
								</td>
							</tr>
							<tr>
								<th scope="col">Service Charge</th>
								<td>
									<?php if($row['scharge']>0){echo $row['scharge'];}?>
								</td>
							</tr>
							<tr>
								<th scope="col">Status</th>	
								<td>
									<?php if($row['status']=='Started'){
									    echo '<span class="badge bg-info text-light">'.$row['status'].'</span>';
									}else if($row['status']=='Done'){
									    echo '<span class="badge bg-success text-light">'.$row['status'].'</span>';
									}else if($row['status']=='Failed'){
									    echo '<span class="badge bg-danger text-light">'.$row['status'].'</span>';
									}?>
								</td>
							</tr>
							<tr>	
								<th scope="col">Date</th>	
								<td>
									<?php echo $row['cdate'];?>
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
			<!-- FOOTER -->
			<?php echo getFooter();?>
		</main>
		<?php echo getJavaScript();?>
	</html>
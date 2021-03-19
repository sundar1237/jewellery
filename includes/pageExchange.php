<!doctype html>
<html lang="en">
	<head>
	<?php
	$sql="select * from xchange";
	$rates = getFetchArray($sql);
	echo getHead("Exchange Rate", '', "");
?>
	</head>
	<body>
		<?php echo getNavigationMenu()?>
		<main role="main">
			<div class="container">
				<div class="blog-post">
					<p class="h1">Exchange Rate</p>
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  						<button style="float: right;"
							class="btn btn-info btn-sm btn-action1" title="Update Rates"
							data-url="exchange.php?action=showRate"
							id="update_rate" type="button">Update</button>
                        
					</div>
					
					<div class="table-responsive">
					
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Sending Currency</th>								
								<th scope="col">Amount</th>
								<th scope="col">Receiving Currency</th>
								<th scope="col">Date</th>									
							</tr>
						</thead>
						<tbody>
							<?php
							 
							 foreach ($rates as $row) {
                            ?>					 
							<tr>
								<td>
									<?php echo $row['scur'];?>
								</td>
								<td>
									 <?php echo $row['transfer'];?></a>
								</td>
								<td>
									<?php echo $row['rcur'];?>
								</td>
								<td>
									<?php echo $row['mdate'];?>
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
				<!-- Modal for change photo-->
		<div class="modal fade" id="myModal1" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form action="exchange.php" method="POST" name="update_rates"
						enctype="multipart/form-data">
						<div class="modal-header" style='border: none;'>
							<h5 class="modal-title">
								Update Rates <i class="fa fa-check-square" aria-hidden="true"></i>
							</h5>
							<button aria-hidden="true" class="close" data-dismiss="modal"
								type="button">×</button>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button class="btn btn-secondary" style='' data-dismiss="modal">Close</button>
							<button class="btn btn-primary" type="submit" id="add_document1"
								style=''>Proceed</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Modal - show atc response -->
		
			<script>
$(document).ready(function() {
    $("[id=update_rate]").click(function () {
        var url1 = $(this).data("url");
        $.ajax({
            dataType: "html",
            type: "GET",
            url: url1,
            success: function(msg){                
                $(".modal-body").html(msg);
                $("#myModal1").modal("show");
            }
        });
    });
});
</script>
		
		
	</html>
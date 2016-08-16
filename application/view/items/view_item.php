<div class="container-fluid">
    <div class="box">
<!--        <h3>Item's Page (here go the item title) </h3> -->
		<div class="row view-item-back-row-styles">
			<div class="col-sm-12">
				<form id="back-to-search-form" action="<?php echo $filter_data->back_url; ?>" method="post">
					<?php if (isset($filter_data)) foreach ($filter_data as $name => $value) {?>
						<input type="hidden" name="<?php echo $name;?>" value="<?php echo $value;?>">
					<?php } ?>
					<input type="submit" value="Return" class="view-item-back-button-styles">
				</form>
			</div>
		</div>

		<h3><?php echo $item->name; ?></h3>
<!--		--><?php //print_r($item); ?>
		<?php $seller =  $this->model->getUserName($item->user_id);
			//($seller);
			foreach ($seller as $sellerInfo) 
			{?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3">
					<img class="img-rounded mb-7 hero-image" src="<?php echo IMG_ITEMS_FOLDER_URL . $item->image;?>" width="200" height="200">
				</div>
				<div class="col-sm-2">
					<a class="btn btn-success"
						<?php if (!isset($_SESSION["user"])) { ?>
							onclick="callLogin();"
						<?php } else { ?>
							onclick="addToWishList(<?php echo $_SESSION['user']->id; ?> ,<?php echo $item->id; ?>);"
						<?php } ?>
					>
						Add to wish list
					</a>
				</div>		
				<div class="col-sm-7">
<!--			  		<h3><?php echo $item->name;?></h3> -->
					<h4>
						<p><?php echo $item->description; ?></p>
						<p>$<?php echo $item->price; ?></p>
					</h4>
<!--			  <p>Brian is tall and smart that can also do all of your house works. </p>-->
<!--			  <p>Buy me to get more knowledge.</p>-->
				</div>
			</div> 
			<div class="row">
				<div class="col-md-12">
					<h3></h3>
					<div class="panel panel-info">
						<div class="panel-heading"> 
							<div class="row">
								<div class="col-sm-3">
									<h4>Seller: <?php echo $sellerInfo->username; ?> </h4>
								</div>
								<div class="col-sm-9">
									
									<!-- BEGGIN of contact-seller modal-->
									<!-- Trigger the modal with a button -->
								<!--	<button type="button" class="buy-button btn btn-success btn-lg " aria-hidden="true" data-toggle="modal" data-target="#buyer-modal">Buy</button> -->
									
									<button type="button" class="button-contact-seller btn btn-success btn-lg " aria-hidden="true" 
										<?php if (!isset($_SESSION["user"])) { ?>
											onclick="callLogin()" 
										<?php } else { ?>
											onclick="callBuyModal();"
										<?php } ?>
									> Buy Item</button>
						
									<!-- Modal -->
									<div id="buyer-modal" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header seller-buyer-dialog-header-style">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Message to the Seller</h4>
												</div>
												<div class="modal-body seller-buyer-dialog-body-style">
													<p>Hi this is <?php echo !isset($_SESSION['user']) ? "" : $_SESSION['user']->username; ?>
													, and I would like to buy your item "<?php echo $item->name; ?>".
													</p>	
												</div>
												<div class="modal-footer seller-buyer-dialog-footer-style">
													<button type="button" class="btn btn-success seller-buyer-dialog-button-style" data-dismiss="modal" data-toggle="modal" data-target="#seller-answer-modal">Send</button>
												</div>
											</div>
										</div>
									</div>
				
									<!-- Trigger the modal with a button -->
									<!-- Modal -->
									<div id="seller-answer-modal" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header seller-buyer-dialog-header-style">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Message to the Buyer</h4>
												</div>
												<div class="modal-body seller-buyer-dialog-body-style">
													<p>Hi <?php echo !isset($_SESSION['user']) ? "" : $_SESSION['user']->username; ?>
													, nice to meet you. The final price is $<?php echo $item->price; ?>. I will see you on campus.
													Thanks for buying my "<?php echo $item->name; ?>"
													</p>
												</div>
												<div class="modal-footer seller-buyer-dialog-footer-style">
													<button type="button" class="btn btn-success seller-buyer-dialog-button-style" data-dismiss="modal" data-toggle="modal" data-target="#congrats-modal"
													>Send</button>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal -->
									<div id="congrats-modal" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header seller-buyer-dialog-congrats-style">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Congrats</h4>
												</div>
												<div class="modal-body seller-buyer-dialog-body-style">
													<p>Thanks <?php echo !isset($_SESSION['user']) ? "" : $_SESSION['user']->username; ?>
													, you have successfully bought the item "<?php echo $item->name; ?>". Thanks for your shopping.
													</p>
												</div>
												<div class="modal-footer seller-buyer-dialog-footer-style">
													<button type="button" class="btn btn-success seller-buyer-dialog-button-style" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- END of contact-seller modal-->
								</div>
							</div>
						</div>
						<div class="panel-body">
							<p>Hi, I am <?php echo $sellerInfo->username; ?></p>
							<p>I am selling stuff here. </p>
							<p>Contact me by email <?php echo $sellerInfo->email; ?></p>	
	  <?php } ?>
						</div>
					</div>	  
				</div>
			</div> <!-- row -->
			
			
		</div>
    </div>
</div>

<!--Created By: Amrita Singh
    Page: Wish List
    wishListOriginal.html
    This page contains a thumbnail (on the left) which is the item that the user is interested in. On
    the right of the image is some information about the item along with 2 buttons: More Info, and Contact
    Seller, that takes the user to the respective pages.-->

<div class="container-fluid main">
    <h3>Wish List</h3>
    <p>The following contains items that you wish to attain (on your left) and information about the item (on 	your right). Press the eGator logo to return to the home page.</p>
    <?php $wishList =  $this->model->getUserWishlist($_SESSION['user']->id);
//        print_r($wishList);
        foreach ($wishList as $item) {
            ?>
            <div class="row">
                <!--Adding the 1st item to the page-->
                <div class="col-sm-3 thumbnail" style="height: 210px;">
                    <!--Add an image of the item-->
                        <img
                            src="<?php echo IMG_ITEMS_FOLDER_URL . $item->image; ?>"
                            class="img-thumbnail" alt="Cinque Terre" style="height: 200px;">
                </div>
                <!--Add some info about the item-->
                <div class="col-sm-4">
                    <h3><?php echo $item->name; ?></h3>
                    <!-- Below the info about the item, there will be 2 buttons: More Info, and Contact User. When clicked on, it will take the user to
                      the respective pages-->
                    <div id="<?php echo $item->id; ?>">
						<h4><p>$<?php echo $item->price; ?></p></h4>
                        <a href="#" type="button" class="btn btn-default view-item">More Info</a>
                        <a type="button" class="btn btn-danger"
                           onclick="removeFromList(
                                API_REMOVE_FROM_WISH_LIST,
                                <?php echo $_SESSION['user']->id; ?>,
                                <?php echo $item->id; ?>)">
                            Remove
                        </a>
                        <!-- <a type="button" class="btn btn-success">Contact Seller</a>-->
						
						<button type="button" class="buy-button btn btn-success btn-lg " aria-hidden="true" data-toggle="modal"
                                data-target="#buyer-modal<?php echo $item->id; ?>">Buy Item</button>
						<!-- Modal -->
						<div id="buyer-modal<?php echo $item->id; ?>" class="modal fade" role="dialog">
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
										<button type="button"
                                                class="btn btn-success seller-buyer-dialog-button-style"
                                                data-dismiss="modal" data-toggle="modal"
                                                data-target="#seller-answer-modal<?php echo $item->id; ?>">Send</button>
									</div>
								</div>
							</div>
						</div>
	
						<!-- Trigger the modal with a button -->
						<!-- Modal -->
						<div id="seller-answer-modal<?php echo $item->id; ?>" class="modal fade" role="dialog">
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
										<button type="button"
                                                class="btn btn-success seller-buyer-dialog-button-style"
                                                data-dismiss="modal" data-toggle="modal"
                                                data-target="#congrats-modal<?php echo $item->id; ?>">Send</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal -->
						<div id="congrats-modal<?php echo $item->id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header label-success">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Congrats</h4>
									</div>
									<div class="modal-body seller-buyer-dialog-body-style">
										<p>Thanks <?php echo !isset($_SESSION['user']) ? "" : $_SESSION['user']->username; ?>
										, you have successfully bought the item "<?php echo $item->name; ?>". The item will be removed from your wishlist.
										Thanks for your shopping.
										</p>
									</div>
									<div class="modal-footer seller-buyer-dialog-footer-style">
										<button type="button" class="btn btn-success seller-buyer-dialog-button-style" data-dismiss="modal"
										onclick="removeFromList(
										API_REMOVE_FROM_WISH_LIST,
										<?php echo $_SESSION['user']->id; ?>,
										<?php echo $item->id; ?>)">Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- END of contact-seller modal-->
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
    <!---- New Item---->
<!--    <div class="row">-->
<!--        <div class="col-sm-4">-->
<!--            <img src="http://www.1staidsupplies.com/sc_images/products/economy-vented-goggles_427_large_image.jpg" class="img-thumbnail" width="304" height="236">-->
<!--        </div>-->
<!--        <div class="col-sm-4"> Goggles great for Biology for $18-->
<!--            <div><button type="button" class="btn btn-default">More Info</button>-->
<!--                <button type="button" class="btn btn-default">Contact User</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <!----- 3rd Item ----->
<!--    <div class="row">-->
<!--        <div class="col-sm-4">-->
<!--            <img src="https://static.pexels.com/photos/2242/wall-sport-green-bike.jpg" class="img-thumbnail" width="304" height="236">-->
<!--        </div>-->
<!--        <div class="col-sm-4"> Screw a car, Get a Bike that gets you places && an Exercise ALL IN ONE!!  $75-->
<!--            <div><button type="button" class="btn btn-default">More Info</button>-->
<!--                <button type="button" class="btn btn-default">Contact User</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
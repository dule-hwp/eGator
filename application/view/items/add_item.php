<div class="container-fluid">
    <div class="box">
        <h3>ADD ITEM PAGE</h3>
		<p>Welcome to add item page. In this page, you can add your item for sell.
		Please fill in all the empty that has a * on it.</p>
        <div class="container-fluid">
            <form method="post" action="<?php echo URL . "items/addItem" ?>" enctype="multipart/form-data"
                  id="form_add_item">
                <input type="hidden" name="user_id" value="<?php print_r($_SESSION['user']->id);?>" />

                <div class="row additem-topborder-style"> <!-- Row for general information -->
                    <div class="row">
                        <div class="col-md-12 additem-label-info-style">
                            <h4>General Information</h4>
                        </div>
                    </div> <!--row-->
                    <div class="row">
                        <div class="col-md-1 additem-label2-info-style">
                            Title: *
                        </div>
                        <div class="col-md-11">
                            <input type="text" class="additem-text-input-style" name="Title" placeholder="Put your item title here." maxlength=50/>
                        </div>
                    </div>
                </div> <!--row-->

                <div class="row additem-topborder-style"> <!-- Row for price and category -->
                    <div class="row">
                        <div class="col-md-12 additem-label-info-style">
                            <h4>Price and Category</h4>
                        </div>
                    </div> <!--row-->
                    <div class="row">
                        <div class="col-md-1 additem-label2-info-style">
                            Price:*
                        </div>
                        <div class="col-md-11">
                            <input type="number" class="additem-price-text-input-style" name="Price" placeholder="0.99" maxlength=15  min="0.00" step="0.01"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 additem-label2-info-style">
                            Category:*
                        </div>
                        <div class="col-md-11">
                            <!--<input type="text" class="additem-text-input-style" name="Category" maxlength=20 />	-->
							<span class="input-group-btn additem-textarea-input-style">
			<!--					<div class="col-lg-4"> -->
								<a class="btn btn-default btn-select">
									<input type="hidden" class="btn-select-input"
										   id="search-category-id" name="Category" value="-1"/>
									<span class="btn-select-value">Default</span>
									<span class='btn-select-arrow glyphicon glyphicon-chevron-down'></span>

									<?php
									$categories = $this->model->getCategories();
									?>
									<ul style="display: none;" class="additem-category-dropdown-option-style">
			<!--                            <li class="selected" id="-1">All</li>-->
										<?php foreach ($categories as $category) { ?>
											<li id="<?php echo $category->id; ?>">
												<?php echo $category->name; ?>
											</li>
										<?php } ?>
									</ul>
								</a>
			<!--					</div> -->
							</span>
                        </div>
                    </div>
                </div> <!--row-->

                <div class="row additem-topborder-style"> <!-- Row for images -->
                    <div class="row">
                        <div class="col-md-12 additem-label-info-style">
                            <h4>Images</h4>
                        </div>
                    </div> <!-- row-->
                    <div class="row">
                        <div class="col-md-12">
                            Please upload a image of the item in png or jpg format. Maxium file size is 500kb.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="size" value="5000000">
                            <input type="file" name="photo">
                        </div>
                    </div>

                </div> <!-- row-->

                <div class="row additem-topborder-style"> <!-- Row for Description -->
                    <div class="row">
                        <div class="col-md-12 additem-label-info-style">
                            <h4>Description</h4>
                        </div>
                    </div> <!-- row-->
                    <div class="row">
                        <div class="col-md-12">
                            Describes your item here. The better the description, the better the chance to sell.
                        </div>
                        <!--						<div class="col-md-11">-->
                        <!--<input type="text" class="additem-text-input-style" name="Description" maxlength=50/>-->
                        <!--						</div>-->
                    </div>

                    <div class="row">
                        <div class="col-md-12 additem-label2-info-style">
                            <textarea rows="5" name="Description"
                                      class="form-control additem-textarea-input-style" placeholder="Put your item description here."></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!--<button type="button" class="btn btn-success additem-button-styles">Submit</button> -->
                        <input TYPE="submit" name="upload" title="Add data to the Database" value="Submit"
                               class="btn btn-lg btn-success additem-button-styles"/>
                    </div>
                </div>
            </form>
        </div>
    </div>  <!-- box div -->
</div>

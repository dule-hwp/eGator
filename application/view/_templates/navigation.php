<div class="container-fluid">
    <div class="row">
<!--        <div class="col-sm-3 col-md-2 sidebar">-->
		<div class="col-sm-3 sidebar">
<!--            <ul class="nav nav-sidebar">-->
<!--                <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>-->
<!--                <li><a href="#">Reports</a></li>-->
<!--                <li><a href="#">Analytics</a></li>-->
<!--                <li><a href="#">Export</a></li>-->
<!--            </ul>-->
            <?php
            //fetch categories from database
            $categories = $this->model->getCategories();
            ?>
            <ul class="nav nav-sidebar">
                <input type="hidden" class="btn-select-input" id="side-filter-category-id" name="" value="-1"/>
                <li id="-1"><a href="#">All</a></li>
<!--                <li id="-1"><a href="#">--><?php //print_r($filter_data); ?><!--</a></li>-->
<!--                display all the categories in the sidebar-->
                <?php foreach ($categories as $category) { ?>
                    <li id="<?php echo $category->id; ?>"
						class="<?php if (isset($filter_data) && isset($filter_data->category_id))
							echo $filter_data->category_id == $category->id ? "active":"";?>">
                        <a href=""><?php echo ucfirst($category->name); ?></a>
                    </li>
                <?php } ?>

                <hr/>
            </ul>
            <div id="" class="nav nav-sidebar price-filter-stype">
                <form class="navbar-form navbar-left" id="frm-price-range">
					<div class="row filtering-style">
						<div class="row">
							<div class="col-md-12">
                                <h4>Filter by price range:</h4>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="number" class="form-control" placeholder="from" id="price_from"  min="0" step="0.01"
										   value="<?php if (isset($filter_data)
                                               && isset($filter_data->price_from)
                                               && $filter_data->price_from != "-1")
											   echo $filter_data->price_from;?>"
									>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="number" class="form-control" placeholder="to" id="price_to"  min="0" step="0.01"
										   value="<?php if (isset($filter_data) && isset($filter_data->price_to)
                                               && $filter_data->price_to != "-1")
											   echo $filter_data->price_to;?>"
									>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-default" onclick="filterItems()">Apply</button>
							</div>
						</div>
					</div>
                </form>
            </div>
        </div>
<!--        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">-->
		<div class="col-sm-9 main">
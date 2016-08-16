<?php if (!isset($filter_data->searchTerm)) { ?>
<div class="container-full" id="welcome-message">

    <div class="row">

        <div class="col-lg-12 text-center v-center">
            <!-- Edited By: Amrita Singh
         Date: 8/5/16
         This is the Welcome / Greeting the user gets when he/she comes across the home page. It displays our eGator logo, 1 on each side.
         along with a short description and the search bar. If the user decides to scroll down, he/she will see a few of the items that
         other users are selling on our website. -->
            <h1>
                Welcome to eGator!
                <p>
                    <img src="http://sfsuswe.com/~dcvetkov/eGator//public/img/static/eGator_Flipped.png" width="100"
                         height="100">
                </p>
                <!--<img src="http://sweng.education/su16g05/eGator/raw/master/public/img/static/eGator.jpg" width="100" height="100">-->
            </h1>
            <p class="lead">
                Created <b>
                    <i> BY </i>
                </b> SFSU Students <b>
                    <i> FOR </i>
                </b> SFSU Students
            </p>
        </div>
    </div>
    <br>
    <br>
</div>
<?php } ?>
<!-- /container full -->

<!--END OF MY TESTING-->


<div class="container-fluid">
    <div class="well well-sm" id="display-items-num">
        <strong>
            <!--            this is gonna be filled with number of items-->
            Displaying <?php echo count($items); ?>
            <?php if (isset($filter_data->searchTerm)) { ?>
                
            <?php } else { ?>
                most recently added
            <?php } ?>
            item<?php echo count($items) > 1 ? "s" : "" ?>.
        </strong>
    </div>
    <div id="items" class="row list-group">
        <?php foreach ($items as $item) { ?>
        <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail" id="<?php echo $item->item_id; ?>">
                <a href="#" class="view-item">
                    <img class="group list-group-image img-thumbnail"
                         src="<?php if (isset($item->thumbnail)) echo IMG_ITEMS_FOLDER_URL . htmlspecialchars($item->thumbnail, ENT_QUOTES, 'UTF-8'); ?>"
                         alt="" style="height: 200px;"/>
                </a>
                <div class="caption">
                    <a href="#" class="view-item">
                        <h4 class="group inner list-group-item-heading">
                            <?php if (isset($item->item_name)) echo htmlspecialchars($item->item_name, ENT_QUOTES, 'UTF-8'); ?></h4>
                    </a>
                    <p class="group inner list-group-item-text">
                        <!--                            -->
                        <?php //if (isset($item->description)) echo htmlspecialchars($item->description, ENT_QUOTES, 'UTF-8'); ?><!--</p>-->
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                    <p class="lead">
                        $<?php if (isset($item->price)) echo htmlspecialchars($item->price, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="col-xs-12 col-md-6">
                    <a class="btn btn-success" id="<?php echo $item->item_id; ?>"
                        <?php if (!isset($_SESSION["user"])) { ?>
                            onclick="callLogin();"
                        <?php } else { ?>
                            onclick="addToWishList(<?php echo $_SESSION['user']->id; ?> ,this.id);"
                        <?php } ?>
                    >
                        Add to wish list
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
<?php require APP . 'view/home/hidden_product.php'; ?>
</div>
</div>
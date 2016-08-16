

<div class="container-fluid main">
    <h3>Welcome page</h3>
    
    <strong>Should show recently added items</strong>
    <a href="<?php echo URL; ?>">
        <i class="glyphicon glyphicon-arrow-right"></i> Show Items For Sale
    </a>

    <div class="well well-sm" id="display-items-num">
        <strong>
            <!--            this is gonna be filled with number of items-->
        </strong>
    </div>
    <div id="featured_items" class="row list-group">
        <!--   this is where all the items are added via JS     -->
    </div>
    <div id="hidden_product" class="hidden">
        <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
                <a class="view-item" href="">
                    <img class="group list-group-image img-thumbnail"
                         src=""
                         alt="" style="height: 200px;"/>
                    <div class="caption">
                </a>
                <a class="view-item" href="">
                    <h4 class="group inner list-group-item-heading"></h4>
                </a>
                <p class="group inner list-group-item-text">
                </p>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <p class="lead">
                        </p>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <a class="btn btn-success"
                            <?php if (!isset($_SESSION["user"])) { ?>
                                onclick="callLogin();"
                            <?php } else { ?>
                                onclick="addToWishList(<?php echo $_SESSION['user']->id; ?> ,this.id);"
                            <?php } ?>
                        >
                            Add to wish list
                        </a>
                        <!--                        <a class="btn btn-success" -->
                        <?php //echo !isset($_SESSION["user"]) ? 'onclick="callLogin();"' : 'onclick="addToWishList();"' ?><!-->
                        <!--                            Add to wish list-->
                        <!--                        </a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
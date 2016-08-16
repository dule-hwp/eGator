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
            <!--                <p class="group inner list-group-item-text">-->
            <!--                </p>-->
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
                </div>
            </div>
        </div>
    </div>
</div>
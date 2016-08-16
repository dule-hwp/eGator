<div class="container-fluid main">
    <h3>Items you are selling</h3>
    <p>The following contains items that you wish to attain (on your left) and information about the item (on 	your right). Press the eGator logo to return to the home page.</p>
    <?php $itemsForSell =  $this->model->getUserItems($_SESSION['user']->id);
//        print_r($itemsForSell);
        foreach ($itemsForSell as $item) {
            ?>
            <div class="row">
                <!--Adding the 1st item to the page-->
                <div class="col-sm-4">
                    <!--Add an image of the item-->
                    <img
                        src="<?php echo IMG_ITEMS_FOLDER_URL . $item->thumbnail;?>"
                        class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
                </div>
                <!--Add some info about the item-->
                <div class="col-sm-4">
                    <?php echo $item->name; ?>
                    <!-- Below the info about the item, there will be 2 buttons: More Info, and Contact User. When clicked on, it will take the user to
                      the respective pages-->
                    <div id="<?php echo $item->id; ?>">
                        <a type="button" class="btn btn-default view-item">More Info</a>
                        <a type="button" class="btn btn-danger"
                           onclick="removeFromList(API_REMOVE_FROM_ITEMS,
                           <?php echo $_SESSION['user']->id; ?>, 
                           <?php echo $item->id; ?>)">
                            Remove
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>

</div>
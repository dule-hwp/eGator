<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Wishlist extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        require APP . 'view/_templates/header.php';
//        require APP . 'view/_templates/navigation.php';
        require APP . 'view/wishlist/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function add($userId, $itemId)
    {
        $result = $this->model->addToWishList($userId, $itemId);

        $return = array();
        if ($result==1)
            $return["success"] = "Successfully added to wish list!";
        else {
            $return["error"] = "You already added this item to your wish list!";
            $return["error_details"] = $result;
        }
        echo json_encode($return);
    }

    public function remove($userId, $itemId)
    {
        $result = $this->model->deleteItemFromWishList($userId, $itemId);
        $return = array();
        if ($result>0)
            $return["success"] = "Successfully removed from wish list!";
        else {
            $return["error"] = "Error while removing from wish list!";
        }
        echo json_encode($return);
    }
}

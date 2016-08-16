<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Itempage extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $items = $this->model->getAllItems();
        // load views
        require APP . 'view/_templates/header.php';
//        require APP . 'view/_templates/navigation.php';
        require APP . 'view/items/view_item.php';
        require APP . 'view/_templates/footer.php';
    }

    public function searchItems($value='')
    {
        $items = $this->model->searchItemByName($value);
        $array = array();
        foreach ($items as $item)
        {
            $array[] = get_object_vars($item);
        }
        echo json_encode($array);
    }
}

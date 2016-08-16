<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Items extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
//        $items = $this->model->getAllItems();
        // load views
        require APP . 'view/_templates/header.php';
//        require APP . 'view/_templates/navigation.php';
        require APP . 'view/items/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addItemPage()
    {
        $categories = $this->model->getCategories();
        // load views
        require APP . 'view/_templates/header.php';
//        require APP . 'view/_templates/navigation.php';
        require APP . 'view/items/add_item.php';
        require APP . 'view/_templates/footer.php';
    }

    public function home()
    {
        $filter_data = (object)$_POST;
        $items = $this->model->homeSearch($filter_data);

//        print_r($items);
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }


/** sample result
*
 *
 * @method POST
 * @_POST data is json {"searchTerm":"ca","category_id":"-1","price_from":"12","price_to":"20"}
 * @result
 * [
    {
        "item_name": "Calculus for Dummies",
        "description": "An easy calculus book",
        "item_id": "1",
        "image": "calculus.png",
        "price": "15.99",
        "thumbnail": "calc_thumb.jpg",
        "first_name": "Dusan",
        "last_name": "Cvetkovic",
        "sfsu_id": "123123",
        "username": "dusan",
        "category_name": "books"
    },
    {
        "item_name": "Hellblazer: Critical Mass",
        "description": "Graphic novel, good condition",
        "item_id": "18",
        "image": "hellblazer.jpg",
        "price": "15.00",
        "thumbnail": "hellblazer_thumb.jpg",
        "first_name": "Dusan",
        "last_name": "Cvetkovic",
        "sfsu_id": "123123",
        "username": "dusan",
        "category_name": "books"
     }
]
*/
    public function searchItems()
    {
        $str_json = file_get_contents('php://input');
        $filter_data = json_decode($str_json);
        $items = $this->model->searchItemByFilter($filter_data);
        $array = array();
        foreach ($items as $item)
        {
            $array[] = get_object_vars($item);
        }
        echo json_encode($array);
    }

    public function viewItem()
    {
        if (isset($_POST['item_id'])) {
            $item = $this->model->getItem($_POST['item_id'])[0];
            $filter_data = (object)$_POST;

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
//            require APP . 'view/_templates/navigation.php';
            require APP . 'view/items/view_item.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            header('location: ' . URL . 'items/index');
        }
    }

    public function additem()
    {
        // This is the directory where images will be saved
        $targetFolder = ROOT . IMG_ITEMS_FOLDER_RELATIVE_PATH;
        if (!isset($_FILES['photo']))
        {
            $return["error"] = "No image to upload!";
            echo json_encode($return);
            return;
        }

        $imageFileName = $_FILES['photo']['name'];
        //get base name - filename
        //filename should have timestamp so that when we remove it it affects just that item
        $baseName = basename($imageFileName);
        date_default_timezone_set('America/Los_Angeles');
        $date = date_create();
        $baseName = date_timestamp_get($date) . "_" . $baseName;
        $target_path = $targetFolder . $baseName;

        $po = (object)$_POST;
//        print_r($po);
//        return;
//        header(URL . 'items/home');
        // Writes the photo to the server
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
        //print_r($target_path);
        // Tells you if its all ok
//            echo "The file " . basename($_FILES['photo']['name']) .
//                " has been uploaded, and your information has been added to the directory";
            $thumb_name =Helper::createThumbnail($baseName);
            $po->image = $baseName;
            $po->image_thumb = $thumb_name;
            $result = $this->model->addItem($po, date_timestamp_get($date));
            if ($result==1)
                $return["success"] = "Successfully added sell item!";
            else {
                $return["error"] = "Error while inserting item!";
            }
        } else {
            // Gives and error if its not
            $return["error"] = "Sorry, there was a problem uploading your file.";
        }
        echo json_encode($return);
    }

    public function remove($userId, $itemId)
    {
        $result = $this->model->deleteUserItem($userId, $itemId);
        $return = array();
        if ($result>0)
            $return["success"] = "Successfully removed sell item!";
        else {
            $return["error"] = "Error while removing your sell item!";
        }
        echo json_encode($return);
    }

    public function getRecentItems($hours)
    {
        date_default_timezone_set("America/Los_Angeles");
        $date = new DateTime();
        $now = $date->format('Y-m-d H:i:s');
        // P to specify year values Y M(onths) D(ays) W(eeks) T to specify day values H M S
        $date->sub(new DateInterval('PT'.$hours.'H'));
//        echo $date->format('Y-m-d H:i:s') . "\n";
        $from = $date->format('Y-m-d H:i:s');
        $items = $this->model->getItemsByDate($from, $now);
        echo json_encode($items);
    }

    public function getRecentlyAdded($numOfItems)
    {
//        date_default_timezone_set("America/Los_Angeles");
//        echo $numOfItems;
        $items = $this->model->getRecentlyAdded($numOfItems);
//        print_r($items);
        echo json_encode($items);
    }

    
}

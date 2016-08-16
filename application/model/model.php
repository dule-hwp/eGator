<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getAllItems()
    {
        $sql = "SELECT * FROM items";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getItem($item_id)
    {
        $sql = "SELECT * FROM items WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $item_id);
        $query->execute($parameters);
        $result = $query->execute($parameters);

//         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        if (!$result)
            return $query->errorInfo();
        else
            return $query->fetchAll();

    }

    public function addUser($user_data)
    {
//        INSERT INTO user (id, username, password, last_name, first_name, email, sfsu_id)
//        VALUES (NULL, 'dusan', 'dule', 'Cvetkovic', 'Dusan', 'cvdusan@yahoo.com', '123123');
        $sql = "INSERT INTO user (id, username, password, last_name, first_name, email, sfsu_id)
                VALUES (NULL, :username, :password,:last_name,:first_name, :email, :sfsu_id)";
        $query = $this->db->prepare($sql);
        $hashPass = password_hash($user_data->register_password, PASSWORD_DEFAULT);
        $parameters = array(':username' => $user_data->register_username
        , ':password' => $hashPass
        , ':last_name' => $user_data->register_last_name
        , ':first_name' => $user_data->register_first_name
        , ':email' => $user_data->register_email
        , ':sfsu_id' => $user_data->register_sfsu_id);

//         useful for debugging: you can see the SQL behind above construction by using:
//         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $result = $query->execute($parameters);
//        echo $result ? "Successfully added." : "Error in sql statement: ";
//        print_r( $query->errorInfo()[2]);
        if (!$result)
            return $query->errorInfo();
        else
            return 1;
    }

    public function getUser($user_data)
    {
        $sql = "SELECT * FROM user WHERE username=:username";
        $query = $this->db->prepare($sql);
//        $hashPass = password_hash($user_data->login_password, PASSWORD_DEFAULT);
//        echo $hashPass;
        $parameters = array(':username' => $user_data->login_username);
//        echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        $result = $query->execute($parameters);

        if (!$result)
            return $query->errorInfo();
        else
            return $query->fetchAll();

    }

    public function searchItemByFilter($filterData)
    {
//        $sql = "SELECT * FROM `items` WHERE `name` LIKE '%$searchTerm%'";
//        print_r($filterData);
        $sql = "SELECT items.name as item_name, items.description, items.id as item_id, items.image, items.price, items.thumbnail,
                        user.first_name, user.last_name, user.sfsu_id, user.username, category.name as category_name
                FROM items, category, user WHERE items.cataegory_id = category.id
                                                and items.user_id = user.id
                                                and items.name LIKE :search_term";
        $parameters = array();
        $parameters[':search_term'] = '%' . $filterData->searchTerm . '%';
        if (isset($filterData->category_id) && $filterData->category_id != -1) {
            $sql.=' and category.id = :cat_id';
            $parameters[':cat_id'] = $filterData->category_id;
        }
        if (isset($filterData->price_from) && isset($filterData->price_to) && 
            $filterData->price_from != -1 && $filterData->price_to != -1) 
        {
            $sql.=' and items.price >= :price_from and items.price <= :price_to';
            $parameters[':price_from'] = $filterData->price_from;
            $parameters[':price_to'] = $filterData->price_to;
        }
//        echo "$sql";
        $query = $this->db->prepare($sql);
//        echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function homeSearch($filter_data)
    {
//        print_r($filter_data); return;
        if (!isset($filter_data->searchTerm))
            return $this->getRecentlyAdded(9);
        else
        {
            return $this->searchItemByFilter($filter_data);
        }
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM category";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function addToWishList($userId, $itemId)
    {
//        INSERT INTO `wishlist` (`user_id`, `item_id`) VALUES ('2', '21');

        $sql = "INSERT INTO wishlist (user_id, item_id)
                VALUES (:userID, :itemID)";
        $query = $this->db->prepare($sql);
        $parameters = array(':userID' => $userId
        , ':itemID' => $itemId);

//         useful for debugging: you can see the SQL behind above construction by using:
//         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $result = $query->execute($parameters);
//        echo $result ? "Successfully added." : "Error in sql statement: ";
//        print_r( $query->errorInfo()[2]);
        if (!$result)
            return $query->errorInfo();
        else
            return 1;
    }
    
    public function addItem($itemFormData, $timestamp)
    {
//        INSERT INTO `items` (`id`, `name`, `description`, `image`, `thumbnail`, `price`, `user_id`, `cataegory_id`)
//        VALUES (NULL, 'test', 'test desc', 'android', 'android_thumb', '120', '76', '3');

        $insert = "INSERT INTO `items` 
                  (`id`, `name`, `description`, `image`, `thumbnail`, `price`, `user_id`, `cataegory_id`, `date_added`)
        VALUES (NULL, :name, :description, :image, :imageThumb, :price, :userID, :categoryID, :date_added)";

        date_default_timezone_set('America/Los_Angeles');
        $date = date('Y-m-d H:i:s', $timestamp);
        $query = $this->db->prepare($insert);
//        print_r($itemFormData);
        $parameters = array(':userID' => $itemFormData->user_id
        , ':categoryID' => $itemFormData->Category == -1 ? 1 : $itemFormData->Category
        , ':name' => $itemFormData->Title
        , ':description' => $itemFormData->Description
        , ':image' => $itemFormData->image
        , ':imageThumb' => $itemFormData->image_thumb
        , ':price' => $itemFormData->Price == '' ? 0 : $itemFormData->Price
        , ':date_added' => $date
        );

//         useful for debugging: you can see the SQL behind above construction by using:
//         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($insert, $parameters);  exit();

        $result = $query->execute($parameters);
//        echo $result ? "Successfully added." : "Error in sql statement: ";
//        print_r( $query->errorInfo()[2]);
        if (!$result)
            return $query->errorInfo();
        else
            return 1;
    }
    
    public function getUserWishlist($userID)
    {
        $sql = "SELECT * FROM wishlist, user, items 
                WHERE wishlist.user_id=user.id 
                and wishlist.item_id = items.id 
                and user.id=:userID";
        $query = $this->db->prepare($sql);
        $parameters = array(':userID' => $userID);
        $query->execute($parameters);
        return $query->fetchAll();
    }
    
    public function getUserItems($userID)
    {
        $sql = "SELECT * FROM user, items
                WHERE user.id= items.user_id 
                and user.id=:userID";
        $query = $this->db->prepare($sql);
        $parameters = array(':userID' => $userID);
//                 echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return $query->fetchAll();
    }
	
	public function getUserName($userID)
    {
        $sql = "SELECT * FROM user
                WHERE user.id=:userID";
        $query = $this->db->prepare($sql);
        $parameters = array(':userID' => $userID);
//                 echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function deleteItemFromWishList($user_id, $item_id)
    {
//        "DELETE FROM `wishlist` WHERE `wishlist`.`user_id` = 76 AND `wishlist`.`item_id` = 2"
        $sql = "DELETE FROM `wishlist` WHERE `wishlist`.`user_id` = :user_id AND `wishlist`.`item_id` = :item_id";
        $delete = $this->db->prepare($sql);
        $parameters = array(':item_id' => $item_id,
            ':user_id' => $user_id
        );

        // useful for debugging: you can see the SQL behind above construction by using:
//         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $delete->execute($parameters);
        return $delete->rowCount();
    }

    public function deleteUserItem($user_id, $item_id)
    {
//        "DELETE FROM `wishlist` WHERE `wishlist`.`user_id` = 76 AND `wishlist`.`item_id` = 2"
        $deleteSql = "DELETE FROM items WHERE items.user_id = :user_id AND items.id = :item_id";
        $selectSql = "SELECT * FROM items WHERE items.user_id = :user_id AND items.id = :item_id";

        $parameters = array(':item_id' => $item_id,
            ':user_id' => $user_id
        );
        // useful for debugging: you can see the SQL behind above construction by using:

        $select = $this->db->prepare($selectSql);
//        echo '[ PDO DEBUG ]: ' . Helper::debugPDO($selectSql, $parameters);  exit();
        $select->execute($parameters);
        $row = $select->fetch();
        try{
            $imgsPath = ROOT . IMG_ITEMS_FOLDER_RELATIVE_PATH ;
            unlink($imgsPath . $row -> image);
            unlink($imgsPath . $row->thumbnail);

            $delete = $this->db->prepare($deleteSql);
            $delete->execute($parameters);
        }
        catch (Exception $ex){
            echo "Exception ". $ex;
        }

        return $delete->rowCount();
    }

//SELECT * FROM items WHERE `date_added` BETWEEN "2016-08-02 01:00:00" AND "2016-08-02 03:00:00"
    public function getItemsByDate ($from, $to)
    {
        $selectSql = "SELECT * FROM items WHERE `date_added` BETWEEN :from AND :to";
        $parameters = array(':from' => $from,
            ':to' => $to
        );

        $query = $this->db->prepare($selectSql);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getRecentlyAdded ($numberOfRecentlyAdded)
    {
//        $selectSql = "SELECT * FROM items ORDER BY items.date_added DESC LIMIT "
//            . intval($numberOfRecentlyAdded);
        $selectSql = "SELECT  items.name as item_name, items.description, 
                        items.id as item_id, items.image, items.price, items.thumbnail,
                        user.first_name, user.last_name, user.sfsu_id, 
                        user.username, category.name as category_name
                FROM    items, category, user 
                WHERE   items.cataegory_id = category.id
                        and items.user_id = user.id
                ORDER BY items.date_added DESC, items.name ASC LIMIT "
                . intval($numberOfRecentlyAdded);
//        $parameters = array(':limitItems' => intval ($numberOfRecentlyAdded));

//        echo '[ PDO DEBUG ]: ' . Helper::debugPDO($selectSql, array());  exit();

        $query = $this->db->prepare($selectSql);
        $query->execute();
        return $query->fetchAll();
    }

}

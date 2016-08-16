<?php
/**
 * Created by PhpStorm.
 * User: dusan_cvetkovic
 * Date: 7/31/16
 * Time: 3:06 AM
 */


class Welcome extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
//        require APP . 'view/_templates/navigation.php';
        require APP . 'view/welcome/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
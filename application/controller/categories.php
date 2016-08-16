<?php
/**
 * Created by PhpStorm.
 * User: dusan_cvetkovic
 * Date: 7/21/16
 * Time: 11:14 PM
 */

class Categories extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/vsahjda
     */
    public function index()
    {
        // getting all songs and amount of songs
        return $this->model->getCategories();

    }
}
<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Users extends Controller
{
    public function profile()
    {
//        // load views
        require APP . 'view/_templates/header.php';
        $user = $_SESSION['user'];
        /*require APP . 'view/_templates/navigation.php'; */
        require APP . 'view/userpage/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function items()
    {
//        // load views
        require APP . 'view/_templates/header.php';
//        $user = $_SESSION['user'];
        require APP . 'view/_templates/navigation.php';
        require APP . 'view/items/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addUser()
    {
        $str_json = file_get_contents('php://input');
        $user_data = json_decode($str_json);
        $result = $this->model->addUser($user_data);

        $return = array();
        if ($result==1)
            $return["success"] = "Successfully added user!";
        else {
            $return["error"] = $result[2];
            $return["error_details"] = $result;
        }
        echo json_encode($return);

    }

    public function login()
    {
        $str_json = file_get_contents('php://input');
        $user_data = json_decode($str_json);
        $result = $this->model->getUser($user_data);

        $return = array();
        if (!empty($result)) {
            if (password_verify($user_data->login_password ,$result[0]->password))
            {
                $return["success"] = "User found: " . $result[0]->username;
                $return["data"] = $result;
                session_start();
                $_SESSION['user'] = $result[0];
            }
            else{
                $return["error"] = "User found but password invalid";
            }
        }
        else
            $return["error"] = "No user found!!!";
//        print_r($_SESSION);
        echo json_encode($return);
    }

    public function logout()
    {
        session_start();
//        print_r($_SESSION);
        unset($_SESSION['user']);
        header('location: ' . URL);
//        print_r($_SESSION);
    }
}

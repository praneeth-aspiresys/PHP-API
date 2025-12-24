<?php


require_once './user.php';
//use Models\User;

class routeController
{
   public static   function   route(){
   echo 'inside phpp route';
   $request = $_SERVER['REQUEST_URI'];
   print_r( $_SERVER['REQUEST_URI']);
switch ($request) {
     case '/etc/php-api/user':
        $user = new user();

       
}
     }
    public function createUser($name, $email)
    {
        $user = new User();
        return $user->create($name, $email);
    }

    public function getUsers()
    {
        echo 'inside getuser';

        $user = new User();
        return $user->read();
    }

    public function updateUser($id, $name, $email)
    {
        $user = new User();
        return $user->update($id, $name, $email);
    }

    public function deleteUser($id)
    {
        $user = new User();
        return $user->delete($id);
    }
}
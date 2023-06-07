<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class UserController extends Controller
{

    abstract function doLogin(Request $request) : JsonResponse;

    public static $ACTIVE = 1;
    
    /**
     * Function to recover data from user by email.
     * @param $email
     * @return object
     */
    public function recoverUserDataByEmail($email) : object
    {
        $user = User::where('email', $email)->get();
        return $user;
    }

    /**
     * Function to valid user login.
     * @param $email - email
     * @param $password - password
     * @return bool - return true if there is user.
     */
    protected function validateEmailAndPasswordLogin($email, $password) : bool
    {
        $value = User::where('email','=',$email)
                        ->where('password','=', md5($password))->get();

        return isset($value[0]->id) ? true : false;
    }

    /**
     * Function to validade if user is active
     * @param $email
     * @return bool
     */
    protected function validateActiveUser($email): bool
    {
        $valor = User::where('email',$email)->get();
        return $valor[0]->active == UserController::$ACTIVE ? true : false;
    }
}

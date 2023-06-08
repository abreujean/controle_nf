<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class UserController extends Controller
{

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
     * Function to recover data from user by codhash.
     * @param $codhash
     * @return object
     */
    public function recoverUserDataByCodhash($codhash) : object
    {
        $user = User::where('codhash', $codhash)->get();
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


     /**
     * Function to validate if email belongs to another company.
     * @param $email
     * @param $codhash
     */
    public function validateIfEmailbelongsToAnotherUser($email, $codhash) : bool {
        $value = User::where('email', $email)->where('codhash', '!=', $codhash)->get();
        return isset($value[0]->email) ? true : false;
    }

       /**
     * Function to validate if phone belongs to another company.
     * @param $phone
     * @param $codhash
     */
    public function validateIfPhonebelongsToAnotherUser($phone, $codhash) : bool {
        $value = User::where('phone', $phone)->where('codhash', '!=', $codhash)->get();
        return isset($value[0]->phone) ? true : false;
    }



    /**
     * Function to update user data.
     */
    public function updateUser($codhash, $id_profile, $name, $email, $current_password, $password, $phone, $alert, $active ) : void
    {
        User::where('codhash', $codhash)
                ->update([
                          'id_profile' => $id_profile,
                          'name' => $name,
                          'email' => $email,
                          'password' => $current_password == $password ? $current_password : md5($password),
                          'phone' => $phone,
                          'alert' => $alert,
                          'active' => $active,
                        ]);
    }
}

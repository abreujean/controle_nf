<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public static $PROFILE_COLLABORATOR = 1;
    public static $PROFILE_ADMINISTRATOR = 2;

    /**
     * Functio to check user id_profile by email
     * @param $request
     * @return int
     */
    public function recoveProfileIdByEmail(Request $request) : int {
        $value = User::where('email', $request->email)->get();
        return isset($value[0]->id_profile) ? $value[0]->id_profile : 0;
    }

    /**
     * Function to recover profile of logged user in session
     */

     public function recoverUserProfileLogin() : array {
        return session()->get('user')[0]->profile->profile;
     }

    /**
     * Function to list profile in system
     * @return JsonResponse
     */
    public function listProfile(): object
    {
        $profile = Profile::all();
        return $profile;
    }
    
}

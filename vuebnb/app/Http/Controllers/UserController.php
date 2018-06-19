<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UserController
{
    public function saved()
    {
        $id = Input::get('id');
        $user = Auth::user();
        $saved = $user->saved;
        if ($key = array_search($id, $saved)) {
            array_splice($saved, $key, 1);
        } else {
            array_push($saved, $id);
        }
        $user->saved = $saved;
        $user->save();

        return response()->json();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pemerintah;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if(!$this->checkRole("admin")){
            return response()->json(['error' => 'You are not authorized!'], 401);
        }
        
        $pemerintah = Pemerintah::paginate(10);

        foreach ($pemerintah as $pemerintahData) {
            $pemerintahData->username =  $pemerintahData->user->username;
            $pemerintahData->name =  $pemerintahData->user->name;
            $pemerintahData->institusiName =  $pemerintahData->institusi->name;
        }
        

        return response()->json(
            $pemerintah,
        );
    }
}

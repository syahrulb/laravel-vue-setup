<?php
namespace App\Http\Controllers\Api;

use Response;
use App\Models\User;
use App\Models\Hobby;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function signUp(Request $request){
        $data = $request->all();
        if (User::whereEmail($data['email'])->count()) {
            return Response::json([
                                    'status'=>'Error',     
                                    'results'=>[
                                        'message'=> 'Email telah digunakan.'
                                    ]
                                  ],406);
        }
        $user= User::create($data);
        if (!empty($data['hobbies'])) {
            foreach ($data['hobbies'] as $key => $value) {
                Hobby::create([
                    'nama' => $value,
                    'user_id'=> $user->id
                ]);
            }   
            unset($data['hobbies']);
        }
        return Response::json([
                        'status'=>'Success',
                        'results'=>[
                            'user'=> $user,
                            'message'=> 'Data user berhasil disimpan.'
                        ]
                    ],200);
    }
}

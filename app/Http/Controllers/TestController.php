<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $data = [
            'message' => 'Hello from Laravel API!',
            'status' => true,
            'users' => [
                ['id' => 1, 'name' => 'Awais'],
                ['id' => 2, 'name' => 'Ali'],
            ]
        ];
        return response()->json($data,200);
    }
}

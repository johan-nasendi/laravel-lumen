<?php

namespace App\Http\Controllers;

use App\Models\User;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    /**
     * @OA\Get(
     *     path="/",
     *     description="Home page",
     *     @OA\Response(response="default", description="Welcome page")
     * )
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }
}

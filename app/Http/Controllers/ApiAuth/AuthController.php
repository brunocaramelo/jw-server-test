<?php

namespace App\Http\Controllers\ApiAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jwt\Autenticate\Autenticate;

class AuthController extends Controller
{
    
    public function __construct()
    {
    }

    public function authenticate( Request $request ) 
    {
        $all = $request->all();
        $autenticate = new Autenticate( $all['email'] , $all['password'] );
        if( $autenticate->check() === false )
           return response()->json( ['error' => $autenticate->getError() ] , 400 );
        return response()->json( ['token' => $autenticate->getToken() ] );
    }

    public function getToken( Request $request ) 
    {   
        $all = $request->all()[0];
        $autenticate = new Autenticate( $all['email'] , $all['password'] );
        if( $autenticate->check( $request->all() ) === false )
           return response()->json( [ 'token' => $autenticate->getError() ] , 400 );
        return response()->json( [ 'token' => $autenticate->getToken() ] );
    }
}

<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User as UserModel;
use App\Exceptions\UserException;

class UsersController extends Controller
{
    
    public function __construct()
    {
    }

    public function index( Request $request ) 
    {
        $user = new UserModel();
        return response()->json( $user->listFilter( $request->filters ) );
    }

    public function edit( Request $request ) 
    {   
        $user = new UserModel();
        return response()->json( $user->getById( $request->id ) );
    }
    
    public function update( Request $request ) 
    {   
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{
            \DB::beginTransaction();
            $user = new UserModel();
            $return['message'] = 'Usuario alterado com Sucesso';
            $user->update( $request->all()[0][0] );
            \DB::commit();
            return response()->json( $return );
        }catch( UserException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = 'Erro ao alterar usuario: '.$error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }
    
    public function insert( Request $request ) 
    {   
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{
            \DB::beginTransaction();
            $user = new UserModel();
            $return['message'] = 'Usuario inserido com Sucesso';
            $user->insert( $request->all()[0][0] );
            \DB::commit();
            return response()->json( $return );
        }catch( UserException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = 'Erro ao inserir usuario: '.$error->getMessage();
            return response()->json( $return , $return['status'] );
        }
    }

    public function exclude( Request $request ) 
    {   
        $return = ['status' => '200','message'=> null,'data'=> null];
        try{
            \DB::beginTransaction();
            $user = new UserModel();
            $return['message'] = 'Usuario removido com Sucesso';
            $user->exclude( $request->all()[0][0] );
            \DB::commit();
            return response()->json( $return );
        }catch( UserException $error ){
            \DB::rollback();
            $return['status'] = 400;
            $return['message'] = 'Erro ao remover usuario: '.$error->getMessage();
            return response()->json( $return , $return['status'] );
        }  
    }

}

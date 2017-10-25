<?php

namespace App\Repositories;

use App\Entities\User as UserEntitie;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    private $user = null;

    public function __construct( UserEntitie $user )
    {
        $this->user = $user;
    }

    public function getByEmailAndPassword( $email , $password )
    {
        return $this->user->where( 'email' , '=' , $email )
                          ->where('password' , '=' , $password );
    }
    
    public function getListFilter( $filtersP=[] )
    {
        return $this->user->where('exclude','=','0')
        // ->where('password' , '=' , $password );
        ;
    }
    
    public function update( $fields )
    {
        $userSave = $this->user->find( $fields['id'] );
        return $userSave->fill( $fields )->save();
    }
    
    public function exclude( $id )
    {
        $userSave = $this->user->find( $id );
        $userSave->exclude = 1;
        return $userSave->save();
    }

    public function insert( $fields )
    {
        $fields['password'] = Hash::make( sha1( mt_rand( 1, 900000 ) . 'SALT') );
        $fields['api_token'] = sha1( mt_rand( 1, 900000 ) . 'SALT');
        return $this->user->create( $fields );
    }
    
    public function getById( $id )
    {
        return $this->user->where('id' , '=' , $id );
        ;
    }

}
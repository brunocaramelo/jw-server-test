<?php

namespace App\Models\Users;

use App\Entities\User as UserEntitie;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Exceptions\UserException;

class User
{
    private $userRep;
    
    public function __construct()
    {
        $this->userRep = new UserRepository( new UserEntitie() );
    }

    public function listFilter( $filter = [] )
    {
        return $this->userRep->getListFilter( $filter )->get();
    }

    public function getById( $id )
    {
        return $this->userRep->getById( $id )->first();
    }

    public function update( $params )
    {
        $validate = new UserValidator();
        $validation = $validate->validateUpdate( $params );
        if( $validation->fails() ){
            throw new UserException( implode( "\n" , $validation->errors()->all() ) );
        }
        return $this->userRep->update( $params );
    }

    public function insert( $params )
    {
        $validate = new UserValidator();
        $validation = $validate->validateCreate( $params );
        if( $validation->fails() ){
            throw new UserException( implode( "\n" , $validation->errors()->all() ) );
        }
        return $this->userRep->insert( $params );
    }

    public function exclude( $params )
    {
        return $this->userRep->exclude( $params['id'] );
    }
}
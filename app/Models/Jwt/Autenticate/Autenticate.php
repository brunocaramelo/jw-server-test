<?php

namespace App\Models\Jwt\Autenticate;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\UserRepository;
use App\Entities\User;

class Autenticate
{
    private $email = null;
    private $password = null;
    private $token  = null;
    private $error = null;

    public function __construct( $email , $password )
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function check()
    {
        try {
            $token = \JWTAuth::attempt( [
                                        'email' => $this->email , 
                                        'password' => $this->password  
                                        ]);
          if ( $token === false ) {
                throw new JWTException('Dados do Usuário não encontrados:'.var_dump($this->email));
            }
            $this->token = $token;
        } catch ( JWTException $e ) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getError()
    {
        return $this->error;
    }
}
<?php

namespace App\Validators;
use Validator;

class UserValidator{
    
    private $redirect = true;
    
    public function __construct($redirect = false ){
        $this->redirect = $redirect;
        $this->setMessages();
    }

    public function validateCreate( $fields )
    {
        return $this->make( $fields , [
             'name' => 'required',
             'last_name' => 'required',
             'email' => 'required|email|unique:users,email',
            ]);

    }

    public function validateUpdate( $fields )
    {
       return $this->make( $fields , [
             'name' => 'required|unique:users,name,'.$fields['id'],
             'email' => 'required|email|unique:users,email,'.$fields['id'],
             'last_name' => 'required',
             ]);

    }

    public function make( $fields , $rules ){
         
        $validate =  Validator::make( $fields , $rules , $this->messages );

        if($this->redirect === true){
            return $validate->validate();
        }
        return $validate;

    }

    private function setMessages(){
        $this->messages = [
                            'name.required'=>'Preencha o campo Nome',
                            'login.required'=>'Preencha o campo Login',
                            'email.required'=>'Preencha o campo Email',
                            'email.email'=>'Email Inválido',
                            'last_name.required'=>'Preencha o campo Sobrenome',
                            'email.unique'=>'Email já esta em uso',
                            ];
    }


}
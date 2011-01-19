<?php

class Users extends AppModel {
    protected $beforeValidate = array('joinName');
    protected $beforeSave = array('hashPassword', 'createToken');
    protected $afterSave = array('createSite', 'authenticate');
    protected $validates = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Você precisa informar seu nome'
        ),
        'username' => array(
            'rule' => array('unique', 'username'),
            'on' => 'create',
            'message' => 'O nome de usuário já foi escolhido'
        ),
        'email' => array(
            array(
                'rule' => 'notEmpty',
                'message' => 'Você precisa informar um e-mail válido'
            ),
            array(
                'rule' => 'email',
                'message' => 'Você precisa informar um e-mail válido'
            ),
            array(
                'rule' => array('unique', 'email'),
                'message' => 'Seu e-mail já está cadastrado em nossa base de dados'
            )
        ),
        'password' => array(
            'rule' => array('minLength', 6),
            'message' => 'A senha deve conter 6 ou mais caracteres'
        ),
        'confirm_password' => array(
            'rule' => array('confirmField', 'password'),
            'message' => 'As senhas informadas não conferem'
        )
    );

    protected function hashPassword($data) {
        require_once 'lib/core/security/Security.php';
        
        if(array_key_exists('password', $data)) {
            $password = array_unset($data, "password");
            if(!empty($password)) {
                $data['password'] = Security::hash($password, 'sha1');
            }
        }

        return $data;
    }
    
    protected function createToken($data) {
        if(is_null($this->id)) {
            $data['token'] = Security::hash(time(), 'sha1');
        }
        
        return $data;
    }
    
    protected function createSite($created) {
        if($created) {
            $model = Model::load('Sites');
            $model->save(array(
                'segment' => Config::read('Segments.default'),
                'domain' => '',
                'title' => ''
            ));
            $this->site_id = $model->id;
            $this->save();
        }
    }
    
    protected function authenticate() {
        
    }
    
    protected function joinName($data) {
        if(array_key_exists('firstname', $data) && array_key_exists('lastname', $data)) {
            $data['name'] = $data['firstname'] . ',' . $data['lastname'];
        }
        
        return $data;
    }
}
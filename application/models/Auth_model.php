<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model{

    function __construct(){
      parent::__construct();
      $this->load->model('core_model');
    }

    
  public function login()
  {
    try {
      require_once 'vendor/autoload.php';
      $client = new Google_Client();
      $client->setAuthConfig('assets/client_credentials.json');
      $client->addScope("email");
      $client->addScope("profile");
      redirect($client->createAuthUrl());
    } catch (Exception $e) {
      return $e->getMessage();
    }   
  }

  public function validate()
  {
    require_once 'vendor/autoload.php';
    $client = new Google_Client();
    $client->setAuthConfig('assets/client_credentials.json');
    $client->addScope("email");
    $client->addScope("profile");    
    $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));
    $client->setAccessToken($token['access_token']);
    $validUser = (new Google_Service_Oauth2($client))->userinfo->get();
    $isRegisteredUser = $this->core_model->getNumRows('user', 'email', $validUser->email);
    if ($isRegisteredUser)
    {
      $data = array(
        'name' =>  $validUser->name,
        'image' => $validUser->picture,
      );
      $this->core_model->updateSomeData('user', 'email', $validUser->email, $data);
    }
    else
    {
      $user = array(
        'email' => $validUser->email,
        'name' => $validUser->name,
        'image' => $validUser->picture,
        'roleId' => 3
      );
      $this->core_model->createData('user', $user);
    }
    $user = $this->core_model->readSingleData('viewUser', 'email', $validUser->email);
      $userdata = array(
        'isLogin' => true,
        'id' => $user->id,
        'email' => $user->email,
        'name' => $user->name,
        'image' => $user->image,
        'roleId' => $user->roleId,
        'role' => $user->role
      );
    $this->session->set_userdata($userdata);
    notify('Berhasil', 'Login berhasil, Selamat datang '.$this->session->userdata['name'], 'success', 'fa fa-user','dashboard');
  }

  function logout(){
    $this->session->sess_destroy();
    redirect(base_url());
  }
}

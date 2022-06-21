
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "libraries/vendor/autoload.php";

class Google_login extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('google_login_model');
  // Load google oauth library 
  
 }

 function login()
 {
//   include_once APPPATH . "libraries/vendor/autoload.php";

  if($this->session->userdata('login_oauth_uid') == true){ 
    redirect('google_login');
} 
  $google_client = new Google_Client();

  $google_client->setClientId('581973631476-jj5qmkd4k9ct7kc31g0aa1q1disibtj2.apps.googleusercontent.com'); //Define your ClientID

  $google_client->setClientSecret('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'); //Define your Client Secret Key

  $google_client->setRedirectUri('http://localhost/signinTesting/Google_login/login'); //Define your Redirect Uri

  $google_client->addScope('email');

  $google_client->addScope('profile');

  if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);

    $this->session->set_userdata('access_token', $token['access_token']);

    $google_service = new Google_Service_Oauth2($google_client);

     $data = $google_service->userinfo->get();
    //  echo $data['id']; exit;

    


    $current_datetime = date('Y-m-d H:i:s');

    if($this->google_login_model->Is_already_register($data['id']))
    { 

     //update data
     $user_data = array(
      'first_name' => $data['given_name'],
      'last_name'  => $data['family_name'],
      'email_address' => $data['email'],
      'profile_picture'=> $data['picture'],
      'updated_at' => $current_datetime
     );

     $this->google_login_model->Update_user_data($user_data, $data['id']);
    }
    else
    {
     //insert data
     $user_data = array(
      'login_oauth_uid' => $data['id'],
      'first_name'  => $data['given_name'],
      'last_name'   => $data['family_name'],
      'email_address'  => $data['email'],
      'profile_picture' => $data['picture'],
      'gender' => $data['gender'],
      'hd' => $data['hd'],
      'googleLoginId' => $data['id'],
      'language'=>$data['locale'],
      'link'=>$data['link'],
      'fullname'=>$data['name'],
      'verifiedEmail'=>$data['verifiedEmail'],
      'created_at'  => $current_datetime
     );
     
    //  echo "<pre>"; print_r($user_data); exit;


     $this->google_login_model->Insert_user_data($user_data);
    }
    $this->session->set_userdata('user_data', $user_data);
   }
  }
  $login_button = '';
  if(!$this->session->userdata('access_token'))
  {
//    $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url().'asset/sign-in-with-google.png" /></a>';
$login_button = ' <a href="'.$google_client->createAuthUrl().'" class="singUpLink"><button type="button" class="btn signUpBtn"><img src="https://storage.getlatka.com/images/google-icon.png" /><span class="auth_sign_title__CYCiH">Sign up with Google</span></button></a>';

   $data['login_button'] = $login_button;
   $this->load->view('google_login', $data);
  }
  else
  {
   $this->load->view('google_login', $data);
  }
 }

 function logout()
 {

    $google_client = new Google_Client();

   $access_token=$this->session->userdata['access_token'];
   $google_client->revokeToken($access_token);
    
  $this->session->unset_userdata('access_token');

  $this->session->unset_userdata('user_data');

  redirect('google_login/login');
 }
 
}
?>
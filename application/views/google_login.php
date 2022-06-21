<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
    .signUpBtn{
        font-size: 1.8vw !important;
    width: 31vw !important;
    border-style: solid !important;
    border-width: 1px !important;
    border-color: black !important;
    border-radius: 73px !important; 
    background-color: transparent !important;
    }
    ..panel-defaultP{
        border: none !important;
    }
    .mainDiv{
        margin-top: 15%;
    }
    .singUpLink{
        color: black;
        font-size: 1.8vw;
        font-family: sans-serif;
        font-weight: 500;
        line-height: 1.25rem;
    }
    .signupClass{
        margin-top: 5%;
    }
    </style>
</head>
<body>
  
<div class="container">
<?php
   if(!isset($login_button))
   {
?>
<div class="panel panel-default" style="margin-top: 10%;">
<?php
    $user_data = $this->session->userdata('user_data');
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$user_data['profile_picture'].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name : </b>'.$user_data["first_name"].' '.$user_data['last_name']. '</h3>';
    echo '<h3><b>Email :</b> '.$user_data['email_address'].'</h3>';
    echo '<h3><a href="'.base_url().'google_login/logout">Logout</h3></div>';

?>
</div>
    <?php
   }
   else
   {
    
    //echo '<div align="center">'.$login_button . '</div>';
    ?>
    <div class="mainDiv">
  <h1>Create a <span style="color: #da2d26;">free account</span> to view data on<br/> 30,318 SaaS Companies</h1>
  <p>GetLatka is the only place to get accurate revenue data on SaaS companies. <br/>You'll also get access to valuations, growth rates, CEO emails and 28 other metrics per company. <br/>Signup below to view instantly.</p>
  </div>
  <div class="signupClass">
   <?php echo $login_button;?>
    </div>
</div>
</div>
<?php
   }
   ?>
</body>
</html>

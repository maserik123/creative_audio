<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome | Creative Audio Concept</title>
  <script src="modernizr.min.js" type="text/javascript"></script>

  <link href='https://fonts.googleapis.com/css?family=Raleway:300,200' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php echo base_url('assets/login/reset.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/login/style.css'); ?>">

</head>

<body>
  <div class="form">
    <div class="forceColor"></div>
    <p><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></p>
    <form action="<?php echo base_url('Main_Ctrl/aksi_login'); ?>" method="POST">
      <div class="topbar">
        <div class="spanColor"></div>
        <input type="email" class="input" id="username" placeholder="Email" name="email_user" />
        <input type="password" class="input" id="password" placeholder="Password" name="password_user" />
      </div>
      <?php if (isset($error)) {
        echo $error;
      }; ?>
      <button class="submit" id="submit">Login</button><br>
    </form>
    <a href="<?php echo base_url('Main_Ctrl/register'); ?>" style="text-decoration:none;"><button class="submit" id="submit">Register</button></a><br>
    <a href="<?php echo base_url('Main_Ctrl/forgetpassword'); ?>" style="text-decoration:none;"><button class="submit" id="submit">Lupa Password?</button></a><br>
    <button class="submit" type="button" style="background-color:orangered;" onclick="history.back(-1)">Back</button>

  </div>

  <script src='<?php echo base_url('assets/login/jquery.min.js'); ?>'></script>
  <script src="<?php echo base_url('assets/login/script.js'); ?>"></script>

</body>

</html>
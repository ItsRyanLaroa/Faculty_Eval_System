<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){

$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach($system as $k => $v){
  $_SESSION['system'][$k] = $v;
}
// }
ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<?php include 'header.php' ?>
<link rel="stylesheet" href="Css/homepage.css">
<head>
<style>
    body {
      position: relative;
      background-image: url('images/img.png');
      background-repeat: no-repeat;
      background-size: cover;
      height: 100vh;
      padding: 120px;
      overflow: hidden; /* Ensure the pseudo-element does not overflow */
      margin: 0;
    }
    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(179, 27, 27, 0.3); 
      z-index: 1; 
      pointer-events: none;
    }
    .login-box {
      margin-top: 100px;
      position: relative;
      z-index: 2; 
      background-color: rgba(255, 255, 255, 0.8); 
      padding: 20px;
      border-radius: 8px; 
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
      width: 450px;
    }
    .login-logo a {
      color: #333; 
      font-size: 24px;
      font-weight: bold;
    }
    .card {
      background-color: transparent; 
      border: none;
    }
    b{
      color: red;
     margin-left: 20px;
    }
    .btn {
      margin-left: 120px;
      color: white;
      background-color: red;
      width: 120px;
    }
     /* Navbar Styles */
.navbar {
  background-color: rgba(255, 255, 255, 0.9);
  padding: 15px;
  width: 100%;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1000;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.navbar-logo {
  display: flex;
  align-items: center;
}

.navbar-logo img {
  margin-right: 15px; /* Space between the image and text */
}

.logo-text {
  display: flex;
  flex-direction: column;
}

.logo_title {
  color: black;
  font-weight: bold;
  font-size: 20px;
}

.logo_subtitle {
  color: black;
  font-size: 14px;
}

.navbar-links {
  display: flex;
  gap: 20px;
}

.navbar-links a {
  color: #333;
  text-decoration: none;
  font-size: 16px;
  font-weight: bold;
  transition: color 0.3s ease;
}

.navbar-links a:hover {
  color: red;
}

body {
  padding-top: 70px; /* To ensure content doesn't overlap with fixed navbar */
}

.bg-black {
  background-color: black;
}
  </style>
</head>

</head>

<body>

<!-- Navbar -->
<div class="navbar">
  <div class="navbar-logo">
    <a href="homepage.php">
      <img src="images/feslogo.png" width="70" height="70" alt="FES Logo">
    </a>
    <div class="logo-text">
      <span class="logo_title">Faculty Evaluation System</span>
      <span class="logo_subtitle">St. Cecilia's College, Cebu - Inc.</span>
    </div>
  </div>
  <ul class="nav-navbar">
    <li><a href="index.php">Home</a></li>
    <li><a href="about-us.php">About</a></li>
    <li><a href="register.php">Sign up</a></li>
  </ul>
</div>

<body class="hold-transition login-page bg-black">

<div class="login-box">
  
<h3><b><?php echo $_SESSION['system']['name'] ?> </b></h3>
  <div class="login-logo">
    <img src="images/file.png"  style="width: 150px;">
    <!-- <a href="#" class="text-dark">Login</a> -->
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <form action="" id="login-form">
  <div class="input-group mb-3">
    <input type="email" class="form-control" name="email" required placeholder="Email">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
  </div>
  <div class="input-group mb-3">
    <input type="password" class="form-control" name="password" required placeholder="Password">
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <button type="submit" class="btn">Sign In</button>
    </div>
  </div>
  <p style="margin-left:70px; margin-top:10px;">Don't have an account? <a href="register.php">Register here</a></p>
</form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>

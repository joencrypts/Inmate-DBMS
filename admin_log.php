<!DOCTYPE html>
<html>

<head>
<title>Admin Login</title>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="bootstrap-3.3.7-dist/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="assets/css/admin-theme.css" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    background-color: #ffffff;
  }
  
  .auth-container {
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(247, 247, 247, 0.1);
  }
  
  .legend {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 30px;
  }
  
  .form-control {
    height: 40px;
    border-radius: 4px;
  }
  
  .btn-3d {
    height: 40px;
    border-radius: 4px;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 0.5px;
  }
  
  @media (max-width: 768px) {
    .auth-container {
      padding: 15px;
    }
    
    .form-group {
      margin-bottom: 15px;
    }
  }
</style>
</head>

<body>
<form class="form-horizontal auth-container neon-border" action="a_log_verify.php" method="post">	
<fieldset>

<!-- Form Name -->
<legend class="text-center" style="color: var(--primary-color); font-weight: 600; margin-bottom: 30px;">Admin Login Portal</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Username: </label>  
  <div class="col-md-8">
  <input id="textinput" name="textinput" type="text" placeholder="example: Anurag" class="form-control input-md">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordinput">Password: </label>
  <div class="col-md-8">
    <input id="passwordinput" name="passwordinput" type="password" placeholder="password" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-8">
    <button id="singlebutton" name="singlebutton" class="btn btn-3d btn-block">Login</button>
  </div>
</div>

</fieldset>
</form>
</body>
</html>
<html>

<head>
<title> Login Php Page </title>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="bootstrap-3.3.7-dist/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="../assets/css/vibrant-theme.css" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
  }
  
  .auth-container {
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
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
<form class="form-horizontal auth-container neon-border" action="verify.php" method="post">	
<fieldset>

<!-- Form Name -->
<legend class="text-center" style="color: var(--primary-color); font-weight: 600; margin-bottom: 30px;">User Login Portal</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Guard no: </label>  
  <div class="col-md-8">
  <input id="textinput" name="textinput" type="text" placeholder="example: guard1" class="form-control input-md">
    
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
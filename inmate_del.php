<html>

<head>
<title> Login Php Page </title>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="bootstrap-3.3.7-dist/jquery/3.2.1/jquery.min.js"></script>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this inmate? This action cannot be undone.");
}

function showSuccessDialog() {
    alert("Inmate has been successfully deleted!");
}

function showErrorDialog() {
    alert("Error deleting inmate. Please try again.");
}
</script>

<!------ Include the above in your HEAD tag ---------->
</head>

<body>
<form class="form-horizontal" action="p_del_dbms.php" method="post" onsubmit="return confirmDelete()">	
<fieldset>

<!-- Form Name -->
<legend>Delete Inmate Details</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Inmate No: </label>  
  <div class="col-md-4">
  <input id="textinput" name="noinput" type="text" placeholder="eg: 0000" class="form-control input-md">
    
  </div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Delete</button>
  </div>
</div>

</fieldset>
</form>
</body>
</html>
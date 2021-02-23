<DOCTYPE html>
<html lang="en">
<head>
<style>

</style>
    <meta charset="UTF-8">
    <title>Meme</title>
</head>
<body>
<div class="container-fluid">
  <form method="post" action="logincek.php">
  <center>
<h1><font size='5'> LOGIN</h1></font>
<table>
<form>
<td><b><center><font>Username</b>
	<br></br>
	<input type="text" name="username"
     placeholder="" required><br>
	 
	<b><center><font>Password</b>	 
	<br></br>
	<input type="password" name="password"
     placeholder="" required><br>
	 
	 <?php if(isset($_GET['pesan'])) {  ?>
                  <label' style="color:red;"><?php echo $_GET['pesan']; ?></label>
              <?php } ?>	
	 <br></br>
	  <button type="submit">LOGIN</button> 
			</form>
</td>
</tr>
</table>
<td>      
              
		</td>
</body>
</html>
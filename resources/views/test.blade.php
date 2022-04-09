<html>
<head><title>cPanel Email Account Creator</title></head>
<body>
<?php echo '<div style="color:red">'.$msg.'</div>'; ?>
<h1>cPanel Email Account Creator</h1>
<form name="frmEmail" method="post" action="{{route('test-post')}}">
	@csrf
<table width="400" border="0">
<tr><td>Username:</td><td><input name="user" size="20" value="<?php echo htmlentities($euser); ?>" /></td></tr>
<tr><td>Password:</td><td><input name="pass" size="20" type="password" /></td></tr>
<?php if ($antispam) { ?>
<tr><td><img src="antispam.php" alt="CAPTCHA" /></td><td><input name="anti_spam_code" size="20" /></td></tr>
<?php } ?>
<tr><td colspan="2" align="center"><hr /><input name="submit" type="submit" value="Create Email Account" /></td></tr>
</table>
</form>
</body>
</html>
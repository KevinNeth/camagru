<p><?= $this->vars['valid']?></p>
<div id = "divsign">
	<form class="" action="/<?= $this->req->path ?>/signup/check" method="post">
		<label for="login"><img src="/<?= $this->req->path ?>/img/SignUp Logo.png" id = "sign"></label>
		<p>Username :<input id = "login" name = "login" value = "" required = "true"></p><?= $this->vars['login']?>
		<p>E-Mail :<input name = "email" value = "" required = "true"></p><?= $this->vars['email']?>
		<p>Password :<input type = "password" name = "passwd" value = "" required = "true"><br><br><?= $this->vars['passwd']?>
		<input type="submit" name="submit" value="Sign Up">
	</form>
</div>
<div id = "divsign">
	<form class="" action="/<?= $this->req->path ?>/signin/check" method="post">
		<label for = "login2"><img src="/<?= $this->req->path ?>/img/SignIn Logo.png" id = "sign"></label>
		<p>Username :<input id = "login2" name = "login" value = "" required = "true"></p><?= $this->vars['login2']?>
		<p>Password :<input type = "password" name = "passwd" value = "" required = "true"><br><br><?= $this->vars['passwd2']?>
		<input type="submit" name="submit" value="Sign In">
	</form>
</div>

<form method="post" id="auth-form" class="form" novalidate>
	<div class="form-row flex-column flex-sm-row">
		<div class="form-group col-auto col-sm">
			<input type="password" placeholder="Passwort" id="auth-password" name="auth-password" class="form-control">
		</div>
		<div class="col-auto mb-3"><button id="auth-form-submit" type="submit" class="btn btn-block btn-light">Login</button></div>
	</div>
	<div id="auth-error" class="alert alert-danger">Das Passwort stimmt nicht!</div>
</form>

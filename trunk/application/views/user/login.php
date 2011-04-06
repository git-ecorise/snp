<h1>Login</h1>
<form action="<?= login_route() ?>" method="post">
    <label>Email</label>
    <input type="text" name="email" value="" />
    <br />
    <label>Password</label>
    <input type="password" name="password" value="" />
    <br />
    <input type="submit" value="Login" />
</form>
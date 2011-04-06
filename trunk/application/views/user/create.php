<h1>Create user</h1>

<form action="<?= createuser_route() ?>" method="post">
<label for="email">Email:</label><input type="text" name="email" value=""/><br/>
<label for="password">Password:</label><input type="password" name="password" value=""/><br/>
<label for="firstname">First name:</label><input type="text" name="firstname" value=""/><br/>
<label for="lastname">Last name:</label><input type="text" name="lastname" value=""/><br/>
<input type="submit" name="submit" value="Create user"/><br/>
</form>
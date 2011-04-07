<?php
    $template_model->title = 'Create user';
?>

<h1>Sign Up</h1>

<form action="<?= createuser_route() ?>" method="post">
<label for="email">Email:</label><br/><input type="text" name="email" value=""/><br/>
<label for="password">Password:</label><br/><input type="password" name="password" value=""/><br/>
<label for="firstname">First name:</label><br/><input type="text" name="firstname" value=""/><br/>
<label for="lastname">Last name:</label><br/><input type="text" name="lastname" value=""/><br/>
<input type="submit" name="submit" value="Create user"/><br/>
</form>
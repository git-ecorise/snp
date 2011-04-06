<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      	<meta name="description" content="A Social Network Project"/>
        <meta name="keywords" content="Social, Network, Project"/>

        <title>The Social Network Project</title>

        <link rel="shortcut icon" href="<?= graphic_content('favicon.ico') ?>" />
        <link type="text/css" rel="Stylesheet" href="<?= stylesheet_content('layout.css') ?>" />
    </head>
    <body>
        
        <h2>Features</h2>
        <ul>
            <li>
                <a href="<?= home_route() ?>">Home</a>
            </li>
            <li>
                <a href="<?= createuser_route() ?>">Create user</a>
            </li>
            <li>
                <a href="<?= login_route() ?>">Login</a>
            </li>
            <li>
                <a href="<?= logout_route() ?>">Logout</a>
            </li>
        </ul>

        <hr />

        <?= $template_view ?>

    </body>
</html>
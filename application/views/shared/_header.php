<?
    $user = get_user();
?>

<a href="<?= home_route() ?>">
    <img src="<?= graphic_content('logo.png') ?>" alt="logo"/>
</a>

<div id="navigation">
    <ul>
        <?if (!is_authenticated()):?>
            <li><a href="<?= home_route() ?>">Home</a></li>
            <li><a href="<?= signup_route() ?>">Sign up</a></li>
            <li><a href="<?= login_route() ?>">Login</a></li>
        <? else: ?>
            <li><a href="<?= profile_route() ?>">Home</a></li>
            <li><a href="<?= usersearch_route() ?>">Search</a></li>
            <li><a href="<?= settings_route() ?>">Settings</a></li>
            <li><a href="<?= logout_route() ?>">Logout</a></li>
        <?  endif;?>
    </ul>
</div>

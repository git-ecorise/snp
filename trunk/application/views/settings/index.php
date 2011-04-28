<?
    $template_model->set_title('Settings');
?>

<h1>Settings</h1>
<br />
<h2>Your have the following options:</h2>

<ul>
    <li>
        <a href="<?= settings_edit_route() ?>">Edit Profile Information</a>
    </li>
    
    <li>
        <a href="<?= upload_image_route() ?>">Upload Image</a>
    </li>
    
    <li>
        <a href="<?= reset_password_route() ?>">Reset Password ------- Virker lige nu med reset code for user der ikke er logged ind - fix hvis logged in user skal kunne bruge det</a>
    </li>

    <li>
        <a href="<?= interests_edit_route() ?>">Manage Interests</a>
    </li>

    <li>
        <a href="<?= friends_route() ?>">Manage Friends</a>
    </li>
    
    <li>
        <a href="<?= interests_search_route() ?>">Find Friends by interest</a>
    </li>
</ul>
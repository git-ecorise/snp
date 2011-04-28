<?
    $template_model->set_title('Settings');
?>

<h1>Settings</h1>
<br />
<h2>Your have the following options:</h2>

<ul>
    <li>
        <a href="<?= edit_profile_route() ?>">Edit Profile Information</a>
    </li>
    
    <li>
        <a href="<?= upload_image_route() ?>">Upload Image</a>
    </li>
    
    <li>
        <a href="<?= reset_password_route() ?>">Reset Password ------- AUTOMATICALLY REQUEST RESET ? IF ALREDAY LOGGED IN?</a>
    </li>

    <li>
        <a href="<??>">Manage Interests</a>
    </li>
    
    <li>
        <a href="<?= edit_interests_route() ?>">Edit Interests</a>
    </li>

    <li>
        <a href="<?= friends_route() ?>">Manage Friends</a>
    </li>
    
    <li>
        <a href="<?= search_interests_route() ?>">Find Friends by interest</a>
    </li>



    <li><?=anchor('interests/index', 'Interests');?></li>
    <li><?=anchor('friends/index', 'See Friends');?></li>
</ul>
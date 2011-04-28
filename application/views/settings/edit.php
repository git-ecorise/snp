<?
    $template_model->set_title('Edit Information');
?>

<div class="left">
    <form action="<?= settings_edit_route(); ?>" method="POST">
    <div class="input">
        <label for="firstname">First name</label>
        <input type="text" name="firstname" value="<?=$user->firstname;?>" />
        <?= form_error('firstname'); ?>
    </div>
    <div class="input">
        <label for="lastname">Last name</label>
        <input type="text" name="lastname" value="<?=$user->lastname;?>" />
        <?= form_error('lastname'); ?>
    </div>
    <div class="input">
        <label for="city">City</label>
        <input type="text" name="city" value="<?=$user->city;?>" />
        <?= form_error('city'); ?>
    </div>
    <div class="input">
        <label for="zip">Zip</label>
        <input type="text" name="zip" value="<?=$user->zip;?>" />
        <?= form_error('zip'); ?>
    </div>
    <div class="input">
        <label for="Country">Country</label>
        <input type="text" name="country" value="<?=$user->country;?>" />
        <?= form_error('country'); ?>
    </div>
    <div class="input-submit">
        <input type="hidden" name="id" value="<?=$user->id;?>" />
        <input type="submit" name="submit" value="save changes" />
    </div>
</form>
</div>

<div class="left">
    <img src="<?= profile_thumbnail($user->pictureurl);?>" alt="profile picture" />
</div>

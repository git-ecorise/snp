<div id="profile-left-item">
    <div class="float-left">
        <img src="<?= select_profile_image($user->id, $user->hasimage);?>" alt="" width="180px"/>
    </div>
    <div class="float-left">
        <?= $user->firstname.' '.$user->lastname; ?>
    </div>

    <div class="clear"></div>
    <div class="left-menu-line"></div>
</div>
<div id="profile-left-item">
    <div class="float-left">
        <h3>Friends</h3>
        <div id="friends-thumbs">
            <?foreach($friends as $friend):?>
            <a href="<?=profile_route($friend->id);?>">
                <img src="<?= select_thumbnail_image($friend->id, $friend->hasimage);?>" width="30px;" alt="<?=$friend->firstname.' '.$friend->lastname?>"/>
            </a>
            <?endforeach;?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="left-menu-line"></div>
</div>
<div id="profile-left-item">
    <div class="float-left">
        <h3>Interests</h3>
        <p><?=$interests;?></p>
    </div>
    <div class="clear"></div>
    <div class="left-menu-line"></div>
</div>

<?
if (get_user()->is_admin())
{
?>
<div id="profile-left-item">
    <div class="float-left">
        <h3>Admin options</h3>
        <div>
            <a href="<?=settings_edit_route($user->id)?>">Edit Profile Settings</a>
        </div>
        <div>
            <a href="<?=reset_password_admin_route($user->id);?>">Reset Password</a>
        </div>
    </div>
    <div class="clear"></div>
    <div class="left-menu-line"></div>
</div>
<?
}
?>
<div id="profile-left-item">
    <div class="float-left">
        <img src="<?= select_thumbnail_image($user->id, $user->hasimage);?>" alt="" width="60px"/>
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
            <img src="<?= select_thumbnail_image($friend->id, $user->hasimage);?>"  width="30px;" alt="<?=$friend->firstname.' '.$friend->lastname?>"/>
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
            <a href="">Edit Profile Settings</a>
        </div>
        <div>
            <a href="">Reset Password</a>
        </div>
    </div>
    <div class="clear"></div>
    <div class="left-menu-line"></div>
</div>
<?
}
?>
<div id="profile-left-item">
    <div class="float-left">
        <img src="<?=  profile_thumbnail('_default.jpg')?>" alt="" width="60px"/>
    </div>
    <div class="float-left">
        <?= get_user()->get_fullname() ?>
    </div>

    <div class="clear"></div>
    <div class="left-menu-line"></div>
</div>
<div id="profile-left-item">
    <div class="float-left">
        <h3>Friends</h3>
        <div id="friends-thumbs">
            <?foreach($friends as $friend):?>
            <img src="<?= profile_thumbnail($friend->pictureurl);?>"  width="30px;" alt="<?=$friend->firstname.' '.$friend->lastname?>"/>
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
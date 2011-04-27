<?php
$template_model->set_title('Profile');
?>
<div id="profile-left">
    <?$this->load->view('');?>
</div>
<div id="profile-right">
    <div class="status-update">
        <h3>What's going on?</h3>
        <form action="<?= update_status_route() ?>" method="POST" >
            <div class="input">
                <textarea class="status-field" name="statusupdate" cols="" rows="" ></textarea><br/>
            </div>
            <div class="input-submit">
                <input type="submit" name="sbmit-update" value="Update" />
            </div>
        </form>
    </div>
    <hr>
    <? foreach ($updates as $update): ?>
        <div class="update-field">
            <div class="update-field-left">
                <img src="<?= profile_thumbnail($update['user']->pictureurl); ?>" alt="profile picture" width="40px"/>
            </div>
            <div class="update-field-right">
                <h3><?= $update['user']->firstname; ?> <?= $update['user']->lastname; ?></h3>
                <p><?= $update['status']->comment; ?></p>
                <p class="update-date"><?= $update['status']->date; ?> <a href="">add comment</a></p>
            </div>

            <div class="clear"></div>
        </div>
    <? endforeach; ?>
</div>
<div class="clear"></div>

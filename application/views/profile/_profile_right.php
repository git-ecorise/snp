<? if ($user->id == get_user()->get_id()): ?>
    <div class="status-update">
        <h3>What's Up?</h3>
        <form action="<?= update_status_route() ?>" method="POST" >
            <div class="input">
                <input class="status-field" name="statusupdate" type="text" />
                <input type="submit" name="sbmit-update" value="Update" />
            </div>
        </form>
    </div>
    <hr>
<? endif; ?>
<? foreach ($updates as $update): ?>
        <div class="update-field">
            <div class="update-field-left">
                <img src="<?= select_thumbnail_image($update['user']->id, $update['user']->hasimage); ?>" alt="profile picture" width="40px"/>
            </div>
            <div class="update-field-right">
                <h3><?= $update['user']->firstname; ?> <?= $update['user']->lastname; ?></h3>
                <p><?= $update['status']->comment; ?></p>
                <p class="update-date"><?= $update['status']->date; ?></p>
                <?foreach($update['comments'] as $comment):?>
                <div class="comment">
                    <div class="float-left">
                        <img src="<?= select_thumbnail_image($comment['userid'], has_image($comment['userid']))?>" width="30px;" />
                    </div>
                    <div class="float-left">
                        <span class="comment_name"><?=$comment['user']->firstname.' '.$comment['user']->lastname?></span>
                        <span class="comment_text"><?=$comment['comment']?></span><br/>
                        <span class="update-date"><?=$comment['date']?></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <?  endforeach;?>
                <div class="comment">
                    <form action="<?=  add_comment_route()?>" method="POST" >
                        <input type="text" name="comment" />
                        <input type="submit" value="add comment" />
                        <input type="hidden" value="<?=$update['status']->id;?>" name="status_id" />
                    </form>
                </div>
            </div>

            <div class="clear"></div>
        </div>
<? endforeach; ?>
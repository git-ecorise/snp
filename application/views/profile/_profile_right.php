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

<?
if (count($updates) == 0)
    echo 'Nothing have been posted yet.'
?>

<? foreach ($updates as $update): ?>

        <div class="update-field">
            <div class="update-field-left">
                <a href="<?= profile_route($update->userid)?>">
                    <img src="<?= select_thumbnail_image($update->userid, $update->hasimage); ?>" alt="profile picture" width="40px"/>
                </a>
            </div>
            <div class="update-field-right">
                <h3><?= $update->firstname . ' ' . $update->lastname; ?></h3>
                <p><?= $update->comment ?></p>
                <p class="update-date"><?= $update->date ?></p>

                <?foreach($comments[$update->id] as $comment):?>
                <div class="comment">
                    <div class="float-left">
                        <a href="<?= profile_route($comment->userid)?>">
                            <img src="<?= select_thumbnail_image($comment->userid, $comment->hasimage)?>" width="40px;" alt="" />
                        </a>
                    </div>
                    <div class="float-left comment-width">
                        <span class="comment_name"><?=$comment->firstname.' '.$comment->lastname?></span>
                        <span class="comment_text"><?=$comment->comment?></span><br/>
                        <span class="update-date"><?=$comment->date?></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <?  endforeach;?>

                <div class="comment">
                    <form action="<?= add_comment_route() ?>" method="POST" >
                        <input type="text" name="comment" />
                        <input type="submit" value="add comment" />
                        <input type="hidden" value="<?=$update->id;?>" name="status_id" />
                        <input type="hidden" value="<?=$user->id;?>" name="user_id" />
                    </form>
                </div>

            </div>

            <div class="clear"></div>
        </div>
<? endforeach; ?>

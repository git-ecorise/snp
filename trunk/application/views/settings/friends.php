<?
    $template_model->set_title('Friends');
?>

<h1>Friends</h1>

<div id="friends">
    <? foreach ($friends as $friend): ?>
    <div class="left">
        <img src="<?= profile_thumbnail($friend->pictureurl);?>" alt="" height="80px"/>
    </div>
    <div class="left">
        <h4><?=$friend->firstname.' '.$friend->lastname;?></h4>
    </div>
    <div class="clear"></div>
    <hr/>
    <? endforeach; ?>
</div>
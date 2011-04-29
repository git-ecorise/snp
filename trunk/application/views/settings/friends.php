<?
    $template_model->set_title('Friends');
?>

<h1>Friends</h1>

<div id="friends">
    <?
    if ($friends == NULL)
    {
        echo 'You have no friends';
    }
    else
    {
        foreach ($friends as $friend): ?>

        <div class="left">
            <img src="<?= select_thumbnail_image($friend->id, $friend->hasimage); ?>" alt="" width="40px"/>
        </div>
        <div class="left">
            <h4><?=$friend->firstname.' '.$friend->lastname;?></h4>
        </div>
        <div class="clear"></div>
        <hr/>
        
        <? endforeach;
    }
    ?>
</div>
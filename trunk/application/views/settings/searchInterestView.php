<?
    $template_model->set_title('Search interests');
?>

<h3>Find friends with common interests</h3>

<?php
$this->load->view('settings/_interestpartial');
?>

<?if(isset($friends)):?>
    <h2>Results</h2>
<ul class="searchresult">
    <?
    foreach ($friends as $row)
    {
    ?>
    <li>
        <a href="<?=profile_route($row->id)?>"><img src="<?= select_thumbnail_image($row->id, $row->hasimage)?>" /></a>
        <a href="<?=profile_route($row->id)?>"><?= $row->firstname . ' ' . $row->lastname ?></a>
    <?if(!is_friend(get_user()->get_id(), $row->id)):?>
        -&nbsp;<a href="<?= friends_add_route($row->id) ?>">add as friend</a>
    <?endif;?>
    </li>
    <?
    }
    ?>
</ul>
<?  endif;?>
<?php
    $template_model->set_title('Search');
?>

<h1>Search</h1>

<form action="<?= usersearch_route() ?>" method="post">
    <div class="input">
        <label>Name</label>
        <input type="text" name="name" value="<?= set_value('name')?>"/>
        <?= form_error('name'); ?>
    </div>
    <div class="input-submit">
        <input type="submit" name="submit" value="Search"/><br/>
    </div>
</form>

<br/>

<?
if (isset($result))
{
?>
<h3>Results</h3>
<ul class="searchresult">
    <?
    foreach ($result as $row)
    {
    ?>
    <li>
        <a href="<?=profile_route($row->id) ?>">
            <img src="<?=select_thumbnail_image($row->id, $row->hasimage) ?>" alt="" />
        </a>
        <a href="<?= profile_route($row->id)?>"><?=$row->firstname . ' ' . $row->lastname ?></a>
        <?if(!is_friend($row->id)):?>
            <a href="<?= friends_add_route($row->id) ?>">add as friend</a>
        <? endif; ?>
    </li>
    <?
    }
    ?>
</ul>
<?
}
?>
<br />
<br />
<a href="<?= interests_search_route(); ?>">Find friends with common interests</a>
<br />
<br />
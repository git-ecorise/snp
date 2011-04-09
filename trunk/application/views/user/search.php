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
<br/>

<?
if (isset($result))
{
?>
<h2>Results</h2>
<ul class="searchresult">
    <?
    foreach ($result as $row)
    {
    ?>
        <li><?= $row->firstname . ' ' . $row->lastname ?></li>
    <?
    }
    ?>
</ul>
<?
}
?>
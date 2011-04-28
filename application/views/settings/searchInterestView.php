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
    <li><?= $row->firstname . ' ' . $row->lastname ?>
    <?if(!is_friend(get_user()->get_id(), $row->id)):?>
        <a href="<?= friends_add_route($row->id) ?>">add as friend</a>
    <?endif;?>
    </li>
    <?
    }
    ?>
</ul>
<?  endif;?>
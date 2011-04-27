<h3>Find friends with common interests</h3>
<?php
$this->load->view('profile/_interestpartial');
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
        <a href="<?= add_as_friend_route($row->id)?>">add as friend</a>
    <?endif;?>
    </li>
    <?
    }
    ?>
</ul>
<?  endif;?>
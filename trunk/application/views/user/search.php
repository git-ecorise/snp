<?php
    $template_model->title = 'Search';
?>

<h1>Search</h1>

<?= validation_errors() ?>

<form action="<?= usersearch_route() ?>" method="post">
    <div class="input">
        <label>Email</label>
        <br />
        <input type="text" name="email" value="<?= set_value('email')?>"/>
    </div>
    <div class="input-submit">
        <input type="submit" name="submit" value="Search"/><br/>
    </div>
</form>

<br/>
<br/>

<!-- Only show if result is found -->
<h2>Result</h2>
<div>
    
</div>
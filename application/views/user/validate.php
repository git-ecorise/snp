<?php
    $template_model->set_title('Validate Email');
?>

<h1>Validate Email</h1>

<form action="<?= validate_route() ?>" method="post">
    <div class="input">
        <label>Validation Code</label>
        <input type="text" name="validationcode" value="<?= set_value('validationcode')?>" />
        <?= form_error('validationcode'); ?>
    </div>
    <div class="input-submit">
        <input type="submit" value="Validate" />
    </div>
</form>
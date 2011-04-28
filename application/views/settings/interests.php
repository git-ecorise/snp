<?
    $template_model->set_title('Add interests');
?>

<form action="<?= interests_route(); ?>" method="POST" >
    <div class="input">
        <div class="ui-widget">
            <label for="interests">Interest: </label>
            <textarea cols="50" rows="5" name="interests" id="interests"><?=$interests;?></textarea>
        </div>
        <div class="input-submit">
            <input type="submit" name="submit" id="submit" value="Save" />
        </div>
    </div>
</form>
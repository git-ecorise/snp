<?
$interests = isset($interests) ? $interests : "";
?>
<form action="<?=$action?>" method="POST" >
    <div class="input">
        <div class="ui-widget">
            <label for="interests">Interest: </label>
            <textarea cols="50" rows="5" name="interests" id="interests"><?=$interests;?></textarea>
        </div>
        <div class="input-submit">
            <input type="submit" name="submit" id="submit" value="<?=$submit_value?>" />
        </div>
    </div>
</form>
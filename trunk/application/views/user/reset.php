<div class="reset-form">
    <h3>Please enter your email</h3>
    <form action="<?= reset_password_route() ?>" method="POST" >
        <div class="input">
            <input type="text" name="email" />
            <p>You will receive an email with futher instructions...</p>
        </div>
        <div class="input-submit">
            <input type="submit" name="submit" value="Send"/>
        </div>
    </form>
</div>
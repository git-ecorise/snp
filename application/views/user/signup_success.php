<?php
    $template_model->set_title('Sign up - Success');
?>

<h1>You have been signed up!</h1>
<div>
    Oh and by the way ... check out these cool features ...
    <br />
    Now go validate your email (and for this presentation just <a href="<?= validate_route($this->session->flashdata('code')) ?>">click here</a>)
</div>
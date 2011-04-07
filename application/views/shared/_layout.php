<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      	<meta name="description" content="A Social Network Project"/>
        <meta name="keywords" content="Social, Network, Project"/>

        <title><?= $template_model->get_title() ?> | The Social Network Project</title>

        <link rel="shortcut icon" href="<?= graphic_content('favicon.ico') ?>" />
        <link type="text/css" rel="Stylesheet" href="<?= stylesheet_content('layout.css') ?>" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    </head>
    <body>
        <div id="header-wrap">
            <div id="header">
            <? $this->load->view('shared/header'); ?>
            </div>
        </div>
        <div class="header-bottom"></div>

        <div id="main-wrap">
            <div id="main">
            <?= $template_view ?>
        </div>
        </div>
        
        <div class="footer-top"></div>
        <div id="footer-wrap">
            <div id="footer">
            <? $this->load->view('shared/footer'); ?>
        </div>
        </div>
    </body>
</html>
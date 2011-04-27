<?

$status = isset(${STATUS_KEY}) ? ${STATUS_KEY} : $this->session->flashdata(STATUS_KEY);

?>

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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
        <script type="text/javascript" src="<?= javascript_content('layout.js') ?>"></script>
    </head>
    <body>
        <div id="message-box">
        </div>
        
        <div id="header">
            <div class="section">
                <? $this->load->view('shared/_header'); ?>
            </div>
        </div>

        <div id="view">
            <div class="section">
                <?= $template_view ?>
            </div>
        </div>
 
        <div id="footer">
            <div class="section">
                <? $this->load->view('shared/_footer'); ?>
            </div>
        </div>

        <script type="text/javascript">
        var status = '<?= $status ?>';
        </script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <base href="<?= base_url(); ?>">
    <title>
        <?= isset($title) ? $title : lang('title_default'); ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/jumbotron-narrow.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation">
                        <a href="users"><?= lang('home'); ?></a>
                    </li>
                    <li role="presentation">
                        <a href="user/edit/<?= $authentication['id']; ?>"><?= lang('setting'); ?></a>
                    </li>
                    <li role="presentation">
                        <a href="categories"><?= lang('title_categories'); ?></a>
                    </li>
                    <li role="presentation">
                        <a href="words"><?= lang('title_word'); ?></a>
                    </li>
                    <li role="presentation">
                        <a href="sessions/logout"><?= lang('sign_out'); ?></a>
                    </li>
                </ul>
            </nav>
            <h3 class="text-muted"><?= lang('name_project'); ?></h3>
        </div>

        <?php
            if (isset($template) && !empty($template)) {
                $this->load->view($template, isset($data) ? $data : NULL);
            }
        ?>

        <footer class="footer">
            <p><?= lang('footer'); ?></p>
        </footer>

    </div>
    <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

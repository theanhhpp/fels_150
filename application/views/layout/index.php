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
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href=""><?= lang('name_project'); ?></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href=""><?= lang('home'); ?></a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li role="presentation">
                                <a href="users"><?= lang('users'); ?></a>
                            </li>
                            <li role="presentation">
                                <a href="lessons"><?= lang('all_lessons'); ?></a>
                            </li>
                            <li role="presentation">
                                <a href="categories"><?= lang('title_categories'); ?></a>
                            </li>
                            <li role="presentation">
                                <a href="words"><?= lang('title_word'); ?></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= lang('title_show'); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li role="presentation">
                                        <a href="user/show/<?= $authentication['id']; ?>"><?= lang('profile'); ?></a>
                                    </li>
                                    <li role="presentation">
                                        <a href="user/edit/<?= $authentication['id']; ?>"><?= lang('setting'); ?></a>
                                    </li>
                                    <li role="presentation">
                                        <a href="sessions/logout" class="delete"><?= lang('sign_out'); ?></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>
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
    <script src="assets/js/custom.js"></script>
</body>

</html>

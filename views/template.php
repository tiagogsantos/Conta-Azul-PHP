<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel - <?php echo $viewData['company_name'] ?></title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/template.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript"> var BASE_URL = '<?php echo BASE_URL ?>';</script>
        <script type="text/javascript" src="/assets/js/scripts.js"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/jquery.tinymce.min.js" referrerpolicy="origin"></script>
    </head>
    <body>

    <div class="leftmenu">
        <div class="company_name">
            <?php echo $viewData['company_name'] ?>
        </div>
        <div class="menuarea">
            <ul>
                <li><a href="<?php echo BASE_URL.'/home' ?>">Home</a> </li>
                <li><a href="<?php echo BASE_URL.'/permissions' ?>">Permissões</a></li>
                <li><a href="<?php echo BASE_URL.'/users' ?>">Usuários</a></li>
                <li><a href="<?php echo BASE_URL.'/clients' ?>">Clientes</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="top">
            <div class="top_rigth"><a href="<?php echo BASE_URL.'/login/logout'; ?>">Sair</a> </div>
            <div class="top_rigth"> <?php echo $viewData['user_email']; ?></div>
        </div>
        <div class="area">
            <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        </div>
    </div>

    </body>
</html>

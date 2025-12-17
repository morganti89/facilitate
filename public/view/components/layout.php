<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= DIR_CSS . 'styles.css' ?>" rel="stylesheet">
    <link href="<?= DIR_CSS . 'layout.css' ?>" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="layout">
            <nav class="navbar">
                <div class="d-flex">
                    <a class="logo_link" href="/"><img class="logo_img" src="<?= DIR_IMG . 'logo.png' ?>" /></a>
                    <ul class="list-group d-flex">
                        <?php foreach ($modules as $moduleName => $moduleList) : ?>
                            <li class="list-item">
                                <div class="dropdown">
                                    <button class="dropbtn"><?= $moduleName ?></button>
                                        <div class="dropdown-content">
                                            <?php foreach ($moduleList as $module) : ?>
                                            <a href=<?= route($module['link']) ?>><?= $module['name']?></a>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <form class="layout__form">
                    <?php if (isset($user)): ?>
                        <ul class="list-group d-flex">
                            <li class="list-item">
                                <div class="dropdown">
                                    <button class="dropbtn"><?= $user ?></button>
                                    <div class="dropdown-content">
                                        <a href="#">Conta</a>
                                        <a href="#">Suporte</a>
                                        <a href="/user/config">Configurações</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    <?php endif ?>
                    <a class="btn bg-btn mr-l logout" href="<?= route('login/logout') ?>">Logout</a>
                </form>
            </nav>
        </div>
        <slot />
</body>

</html>
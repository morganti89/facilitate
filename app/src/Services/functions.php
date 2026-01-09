<?php

use App\Facilitate\Services\System;

function dd($v)
{
    echo '<pre
        style = "
            background-color: #333;
            color: white;
            padding: 2em;
            width: 100%;
        ">';
    var_dump($v);
    echo '</pre>';
    exit();
}

function debug($message): void
{
    echo '<pre
        style = "
            background-color: #333;
            color: white;
            padding: 2em;
            width: 100%;">';
    echo "$message </br>";
    echo '</pre><br>';
}

function render_view(string $viewName, array $viewVariables = []): void
{
    extract(['slot' => $viewName]);
    $viewVariables['auth'] = $_SESSION['auth'];

    System::getModulesAndUser($viewVariables);

    foreach ($viewVariables as $key => $value) {
        extract([$key => $value]);
    }

    ob_start();
    include DIR_VIEW . "{$viewName}.php";
    $view = ob_get_clean();
    

    if (!file_exists(DIR_VIEW . "components")) {
        echo $view;
        return;
    }
    

    ob_start();
    include DIR_VIEW . 'components/layout.php';
    $layout = ob_get_clean();

    $htmlToRender = str_replace('<slot />', $view, $layout);
    load_js(['layout.js'], $htmlToRender);
    if (!file_exists(DIR_VIEW . "$viewName.php")) {
        return;
    }

    echo $htmlToRender;
}

function load_js(array $jsFile = [], string &$html): void
{
    foreach ($jsFile as $js) {
        $path = DIR_JS . $js;
        $html = str_replace('</body>', "<script src=$path></script></body>", $html);
    }
}

function load_env()
{
    $envFile = DIR_REQ . ".env";
    
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with($line, "#")) continue;
            [$key, $value] = explode("=", $line, 2);
            $key = trim($key);
            $value = trim($value, " \"'");
            putenv($key . "=" . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

function insert_GET(string $k, mixed $v)
{
    $_GET[$k] = $v;
}

function redirect(string $url, array $headers = [])
{
    header( header: 'Location:' . DIR_PAGE . $url);
}

function route(string $route): string
{
    return DIR_PAGE . $route;
}

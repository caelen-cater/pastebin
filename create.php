<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!file_exists('paste')) {
        mkdir('paste');

        $redirectIndex = '<?php' . PHP_EOL;
        $redirectIndex .= 'header("Location: ..");' . PHP_EOL;
        $redirectIndex .= 'exit;' . PHP_EOL;
        file_put_contents('paste/index.php', $redirectIndex);
    }

    $dir = uniqid();
    mkdir("paste/$dir");

    $dir = uniqid();
    mkdir("paste/$dir");

    $index = '<?php' . PHP_EOL;

    if (isset($_POST['password']) && $_POST['password'] !== '') {
        $index .= 'if (!isset($_GET["password"]) || $_GET["password"] !== "' . $_POST['password'] . '") {' . PHP_EOL;
        $index .= '    echo "<h1>Incorrect password</h1>";' . PHP_EOL;
        $index .= '    exit;' . PHP_EOL;
        $index .= '}' . PHP_EOL;
    }

    $index .= 'echo <<<EOT' . PHP_EOL;
    $index .= $_POST['text'] . PHP_EOL;
    $index .= 'EOT;' . PHP_EOL;

    if (isset($_POST['burn'])) {
        $index .= 'file_put_contents(__FILE__, "<h1>This paste has been deleted</h1>");' . PHP_EOL;
        $index .= 'exit;' . PHP_EOL;
    }

    $index .= '?>' . PHP_EOL;

    $index .= '<!DOCTYPE html>' . PHP_EOL;
    $index .= '<html>' . PHP_EOL;
    $index .= '<head>' . PHP_EOL;
    $index .= '    <title>' . ($_POST['title'] ?? 'Pastebin') . '</title>' . PHP_EOL;
    $index .= '</head>' . PHP_EOL;
    $index .= '<body>' . PHP_EOL;
    $index .= '' . PHP_EOL;
    $index .= '</body>' . PHP_EOL;
    $index .= '</html>';

    file_put_contents("paste/$dir/index.php", $index);

    header("Location: /paste/$dir");
    echo "/paste/$dir";
}

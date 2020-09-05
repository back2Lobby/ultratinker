<?php
include '../../../../voku/ansi-to-html/src/voku/AnsiConverter/Theme/Theme.php';
include '../../../../voku/ansi-to-html/src/voku/AnsiConverter/AnsiToHtmlConverter.php';

if (isset($_POST['input'])) {
    file_put_contents('main.php', $_POST['input']);
}
$con = new voku\AnsiConverter\AnsiToHtmlConverter();
$data = $con->convert(shell_exec('cd ../../../../../;more vendor/back2future/ultratinker/src/UltraTinker/main.php | php artisan tinker --ansi'));
$data = str_replace('color: blue;', 'color:#2471c8;', $data);
$data = "<pre>" . str_replace('background-color: black;', '', $data) . "</pre>";
echo $data;


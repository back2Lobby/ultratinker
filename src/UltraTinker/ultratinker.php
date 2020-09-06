<?php
include 'colors.php';
// Input from the user
$data = '';

if (isset($_POST['input'])) {
    $data = $_POST['input'];
    //if the user wants query also
    if (isset($_POST['show_query'])) {
        $data = 'DB::listen(function ($query) { dump($query->sql); dump($query->bindings); dump($query->time); });' . $_POST['input'];
    }
    file_put_contents('main.php', $data);
}
$data = '<pre>' . '<span style="color:white;">' . shell_exec('cd ../../../../../;more vendor/back2future/ultratinker/src/UltraTinker/main.php | php artisan tinker --ansi 2>&1') . '</pre>';
//remove the exit notif after each process
$data = str_replace('[37;41;1mExit:  Exiting main thread[39;49;22m', '', $data);
$data = str_replace('Exit:  Exiting main thread', '', $data);
//HTML to ANSI
foreach ($colors as $color => $value) {
    $data = str_replace($color, '</span><span style="background-color:rgba(0,0,0,0.0);color:' . $value . ';">', $data);
}
foreach ($bgColors as $color => $value) {
    $data = str_replace($color, '</span><span style="color:white;background-color:' . $value . ';">', $data);
}
foreach ($boldColors as $color => $value) {
    $data = str_replace($color, '</span><span style="font-weight:bold;background-color:rgba(0,0,0,0.0);color:' . $value . ';">', $data);
}
echo $data;


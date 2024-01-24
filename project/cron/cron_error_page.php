<?php
include __DIR__.'/config_path.php';
require RACINE_WWW . '/src/class/classSite/Config.php';
include RACINE_WWW . '/src/class/classMain/Error_Log.php';
require RACINE_WWW . '/src/class/classMain/EmailSend.php';
require RACINE_WWW . '/src/class/classSite/MessageEmailTxt.php';
include RACINE_WWW . '/src/class/classMain/Error_log_serv.php';
include RACINE_WWW . '/admin/src/function/functionHtml.php';

$error_serv_log = new Error_log_serv([__DIR__, RACINE_WWW]);
$errorContenu_serv = $error_serv_log->getDataAllError();

$error_log = new Error_Log();
$errorContenu = $error_log->load();

$time_err_old = 0;
$time_serv_err_old = 0;

$fileTime = __DIR__."/fileTime.json";
if(is_file($fileTime)) {
    $json = json_decode(file_get_contents($fileTime),true);
    $time_err_old = intval($json['time_err']);
    $time_serv_err_old = intval($json['time_serv_err']);
}

$data_err = [];
$data_serv_err = [];
$time_err = 0;
$time_serv_err = 0;

if (!empty($errorContenu)) {
    $data_err = $errorContenu[0];
    $time_err = intval($data_err['time']);
}

if (!empty($errorContenu_serv)) {
    $data_serv_err = $errorContenu_serv[0];
    $time_serv_err = intval($data_serv_err['time']);
}

$tab_json = [
    'time_err' => $time_err,
    'time_serv_err' => $time_serv_err
];

file_put_contents($fileTime, json_encode($tab_json));

$config = new Config();

if($time_err_old < $time_err && !empty($data_err)) {
    $error_all = explode("<br/>", text_display($data_err['message']), 2);
    $error_message = text_display($error_all[0]);
    $emailSend = new EmailSend();
    $messageEmailTxt = new MessageEmailTxt();
    $messageEmailTxt->recupeMessage("error_page");
    $messageEmailTxt->addVar('DATE_ERR', date('d/m/Y H:i:s', strtotime($data_err['date'])));
    $messageEmailTxt->addVar('MSG_ERR', $error_message);
    $messageEmailTxt->addVarLien('LIEN_ERR', "./admin/?ind=error_list");
    $object = $messageEmailTxt->getObject();
    $msg = $messageEmailTxt->getMessage();
    $emailSend->setMailTo($config->getemailDev())
        ->setNameTo($config->getNameEmailDev())
        ->setMailFrom($config->getEmailAlert())
        ->setNameFrom($config->getNameEmailAlert())
        ->setObjet($object)
        ->setMessageHTML($msg)->send();
}

if($time_serv_err_old < $time_serv_err && !empty($data_serv_err)) {
    $emailSend = new EmailSend();
    $messageEmailTxt = new MessageEmailTxt();
    $messageEmailTxt->recupeMessage("error_serve");
    $messageEmailTxt->addVar('DATE_ERR', date('d/m/Y H:i:s', strtotime($data_serv_err['date'])));
    $messageEmailTxt->addVar('MSG_ERR', $data_serv_err['message']);
    $messageEmailTxt->addVarLien('LIEN_ERR', "./admin/?ind=error_serv_list");
    $object = $messageEmailTxt->getObject();
    $msg = $messageEmailTxt->getMessage();
    $emailSend->setMailTo($config->getemailDev())
        ->setNameTo($config->getNameEmailDev())
        ->setMailFrom($config->getEmailAlert())
        ->setNameFrom($config->getNameEmailAlert())
        ->setObjet($object)
        ->setMessageHTML($msg)->send();
}

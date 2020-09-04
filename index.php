<?php
//root
define('DF_ROOT', getcwd());
//auto load
require DF_ROOT.'/config/common.php';
require DF_ROOT.'/libs/Bootstrap.php';
require DF_ROOT.'/libs/controller.php';
require DF_ROOT.'/libs/Model.php';
require DF_ROOT.'/libs/rb.php';
require DF_ROOT.'/libs/View.php';
require DF_ROOT.'/libs/Session.php';
require DF_ROOT.'/libs/encryptDecrypt.php';
require DF_ROOT.'/config/database.php';
//library
//require DF_ROOT.'/libs/database.php';
//common functions
$app=new Bootstrap();

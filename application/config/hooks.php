<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$hook['pre_system'][] = array(
    'class'    => 'maintenance_hook',
    'function' => 'offline_check',
    'filename' => 'maintenance_hook.php',
    'filepath' => 'hooks'
);
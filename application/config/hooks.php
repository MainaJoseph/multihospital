<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller'] = array(
       // 'class'    => '',
        'function' => 'required',
        'filename' => 'required.php',
        'filepath' => 'hooks',
       // 'params'   => ''
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */
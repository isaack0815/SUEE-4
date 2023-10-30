<?php

/**
 * Description of Template functions
 * 
 * @package Template
 * @subpackage Template functions
 * @category Template functions
 * @license http://opensource.org/licenses/MIT
 * @copyrigth 2023 VMS1-Scripte.de
 * 
 */

/**
 * function to load Template Menu
 * 
 * $titel = Titel of the Menu
 * $content = Content of the Menu
 * 
 * @return string
 * 
 * @version 1.0.0
 * @package Template
 * @subpackage Template functions
 * @category Template functions
 * @license http://opensource.org/licenses/MIT
 * @copyrigth 2023 VMS1-Scripte.de
 */

 function Menuhead($titel,$content){
    $ret = '';
    $ret .= '<div class="card">';
    $ret .= '<div class="card-header">'. $titel .'</div>';
    $ret .= '<div class="card-body">';
    $ret .= $content;
    $ret .= '</div>';
    $ret .= '</div>';
    $ret .= '<hr>';

    return $ret;
 }

 /**
  * function to load Template Menulinks
  * 
  * $LinkURL = URL of the Link
  * $LinkTitel = Titel of the Link
  * $LinkIcon = Icon of the Link
  * 
  * @return string
  * 
  * @version 1.0.0
  * @package Template
  * @subpackage Template functions
  * @category Template functions
  * @license http://opensource.org/licenses/MIT
  * @copyrigth 2023 VMS1-Scripte.de
  */

  function Menulinks($LinkURL, $LinkTitel, $LinkIcon = '0'){
        $icon = '';
        if($LinkIcon != '0')  $icon = '<i class="bi bi-'. $LinkIcon .'"></i> ';
        return '<a href="'. $LinkURL .'" class="btn btn-primary">'. $icon .' '. $LinkTitel .'</a><br>';
  }
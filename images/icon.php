<?php
/*
  * @copyright  Copyright (C) 2017 Gari-Hari LLC. All rights reserved.
  * @license    GPL 3.0 or later; see LICENSE file for details.
  */

include_once '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'config.php';

header( 'Content-type:image/svg+xml' );

$dom = new DOMDocument( '1.0', $encoding );

$dom -> xmlStandalone = false;

echo $dom -> saveXML()

?><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><defs><linearGradient id="l1" x1="0%" y1="0%" x2="0%" y2="100%"><stop style="stop-color:<?=$color ? hsla( $color, 100, 95 ) : 'hsla(0,0%,100%, 0.5 )'?>" offset="0"/><stop style="stop-color:<?=$color ? hsla( $color, 100, 45 ) : 'hsla( 0, 0%, 30%,1 )'?>" offset="1"/></linearGradient><linearGradient id="l2" x1="0%" y1="0%" x2="0%" y2="100%"><stop style="stop-color:<?=$color ? hsla( $color, 100, 80 ) : 'hsla( 0, 0%, 80%, 1 )'?>" offset="0"/><stop style="stop-color:<?=$color ? hsla( $color, 100, 30 ) : 'hsla( 0, 0%, 0%,1 )'?>" offset="1"/></linearGradient></defs><g transform="translate(0,-1042.4)"><rect width="100%" height="100%" ry="1.7" x="0" y="1042.4" style="fill:url(#l2)"/><g><path d="m 0.63895588,1048.5911 c -0.10371082,0.8712 -0.300762,1.8046 -0.63263661,2.3957 0.2800192,0.1038 0.76746103,0.3423 0.99562483,0.4979 0.3318746,-0.6638 0.6015235,-1.7009 0.7363475,-2.7069 l -1.09933572,-0.1867 m 2.53054642,0.2697 c 0.2903903,0.643 0.6222656,1.4934 0.7467186,2.0223 l 1.0267381,-0.3941 c -0.1555662,-0.5496 -0.4874416,-1.3586 -0.8089452,-1.9809 l -0.9645115,0.3527 m 3.619511,2.1364 c -0.4874408,0 -0.57041,-0.062 -0.57041,-0.5082 l 0,-3.1217 1.8564254,0 0,0.5912 1.244531,0 0,-4.8744 -4.5736515,0 0,1.1615 3.3291205,0 0,1.9705 -3.0905853,0 0,1.6594 c -0.2177928,-0.5911 -0.6844925,-1.4519 -1.120078,-2.1157 l -0.912656,0.4252 c 0.134824,0.2178 0.2800196,0.4667 0.4044725,0.7053 l -1.2549021,0.062 c 0.7259757,-0.8193 1.5141801,-1.8357 2.146816,-2.7276 l -1.0578513,-0.5186 c -0.2903903,0.5393 -0.6948636,1.1616 -1.1200779,1.7735 -0.124453,-0.1348 -0.2592775,-0.2904 -0.4148437,-0.446 0.4148432,-0.5704 0.8919143,-1.3586 1.3171286,-2.0431 l -1.1200779,-0.4667 c -0.2281638,0.5601 -0.5704104,1.286 -0.92302715,1.8668 -0.0829687,-0.062 -0.15556646,-0.1244 -0.23853511,-0.1867 l -0.54966787,0.8505 c 0.42521434,0.3837 0.94376973,0.8815 1.27564433,1.3067 -0.1763084,0.2282 -0.3526173,0.446 -0.52892572,0.643 l -0.7570897,0.031 0.1244531,1.0785 1.66974582,-0.1037 0,4.19 1.1719333,0 0,-4.2626 0.7363476,-0.041 c 0.082969,0.2074 0.1555664,0.4044 0.2074218,0.5807 l 0.9437694,-0.4563 0,2.4787 c 0,1.2964 0.4044738,1.649 1.6490036,1.649 l 1.7112301,0 c 1.1719322,0 1.5038085,-0.5082 1.6490036,-2.2713 -0.3318746,-0.093 -0.8608009,-0.2904 -1.1408201,-0.4978 -0.062226,1.369 -0.1348246,1.6179 -0.6015233,1.6179 l -1.462324,0" style="fill:url(#l1)"/></g></g></svg>

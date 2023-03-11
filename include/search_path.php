<?php
/** op-unit-git:/include/search_path.php
 *
 * @created    2023-03-11
 * @version    1.0
 * @package    op-unit-git
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

 /** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP\UNIT\GIT;

/**
 *
 */
foreach(['/usr/bin/','/usr/local/bin/'] as $path){
	$path .= 'git';
	if( `{$path} --version` ){
		return $path;
	}
}

//	...
return null;

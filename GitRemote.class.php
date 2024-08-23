<?php
/** op-unit-git:/GitRemote.class.php
 *
 * @created    2023-02-13
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

/** use
 *
 */
use OP\OP_CI;
use OP\OP_CORE;
use OP\IF_UNIT;

/** GitRemote
 *
 * @created    2023-02-13
 * @version    1.0
 * @package    op-unit-git
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */
class GitRemote implements IF_UNIT
{
	/** use
	 *
	 */
	use OP_CORE, OP_CI;

	/** Add remote repository.
	 *
	 * @created    2023-02-13
	 * @param      string      $name
	 * @param      string      $url
	 * @return     string
	 */
	static function Add(string $name, string $url)
	{
		return `git remote add {$name} $url`;
	}

	/** Delete remote repository.
	 *
	 * @created    2023-02-13
	 * @param      string      $name
	 * @param      string      $url
	 * @return     string
	 */
	static function Delete(string $name)
	{
		return `git remote rm {$name}`;
	}

	/** Rename remote repository.
	 *
	 * @created    2023-02-13
	 * @param      string      $from
	 * @param      string      $to
	 * @return     string
	 */
	static function Rename(string $from, string $to)
	{
		return `git remote rename {$from} {$to}`;
	}

	/** Return remote repository name list.
	 *
	 * @created    2023-02-13
	 * @return     array
	 */
	static function List():array
	{
		return explode("\n", trim(`git remote`));
	}

	/** Check if exists remote name.
	 *
	 * @created    2023-02-13
	 * @param      string      $name
	 * @param      string      $url
	 * @return     string
	 */
	static function isExists(string $name)
	{
		//	...
		$list = self::List();

		//	...
		return (array_search($name, $list) !== false) ? true: false;
	}

	/** Fetch
	 *
	 * @created    2024-08-23
	 * @param      string     $remote
	 * @return     boolean
	 */
	static function Fetch(string $remote='')
	{
		//	...
		if( $remote ){
			//	...
			if( false === array_search( $remote, self::List() ) ){
				OP()->Notice("This remote name is not found.`{$remote}`");
				return false;
			}
		}

		/* @var $output array */
		/* @var $status int   */
		exec("git fetch {$remote} 2>&1", $output, $status);
		if( $status ){
			echo join("\n", $output)."\n";
		}
	}
}

<?php
/** op-unit-git:/GitCommit.class.php
 *
 * @created     2024-09-16
 * @version     1.0
 * @package     op-unit-git
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
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
use OP\OP_CORE;
use OP\OP_CI;
use OP\IF_UNIT;

/** GitCommit
 *
 * @created     2024-09-16
 * @version     1.0
 * @package     op-unit-git
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
 */
class GitCommit implements IF_UNIT
{
	/** use
	 *
	 */
	use OP_CORE, OP_CI;

	/** Pick
	 *
	 * @created    2024-09-16
	 * @param      string     $commit_id
	 * @return     bool
	 */
	static function Pick(string $commit_id) : bool
	{
		/* @var $output array */
		/* @var $status int   */
		$result = exec("git cherry-pick {$commit_id} 2>&1", $output, $status);

		//	...
		if( $result === 'no changes added to commit (use "git add" and/or "git commit -a")' ){
			$status = 0;
		}

		//	...
		if( $status ){
			var_dump($result, $status, $output);
		}

		//	...
		return ($status === 0) ? true: false;
	}
}

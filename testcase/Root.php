<?php
/**	op-unit-git:/testcase/Root.class.php
 *
 * @created    2025-10-29
 * @version    1.0
 * @package    op-unit-git
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	Declare strict
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

/* @var $git \OP\UNIT\Git */
$git  = OP()->Unit('Git');
$root = $git->Root();
D( $root );

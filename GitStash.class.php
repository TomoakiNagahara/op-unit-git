<?php
/** op-unit-git:/GitStash.class.php
 *
 * @created     2022-11-12
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

/** GitStash
 *
 * @created     2022-11-12
 * @version     1.0
 * @package     op-unit-git
 * @author      Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright   Tomoaki Nagahara All right reserved.
 */
class GitStash implements IF_UNIT
{
    /** use
     *
     */
    use OP_CORE, OP_CI;

    /** Save
     *
     * @created     2022-11-12
     */
    function Save()
    {
        //  ...
        $return = [];
        $status = null;
        $comand = 'git stash save 2>&1';
        $result = exec($comand, $return, $status);

        /*
        //  ...
        if( OP()->Config('git')['debug'] ?? null ){
            D( $status, $result, $return );
        }
        */

        //  ...
        return trim($result) === 'No local changes to save' ? false: true;
    }

    /** Pop
     *
     * @created     2022-11-12
     */
    function Pop()
    {
        //  ...
        $return = [];
        $status = null;
        $comand = 'git stash pop 2>&1';
        $result = exec($comand, $return, $status);

        //  ...
        if( OP()->Config('git')['debug'] ?? null ){
            D($comand, $return, $status, getcwd());
        }

        //  ...
        return trim($result) === 'No stash entries found.' ? false: true;
    }
}

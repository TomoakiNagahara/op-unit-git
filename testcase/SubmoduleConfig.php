<?php
/** op-unit-git:/testcase/SubmoduleConfig.class.php
 *
 * @created    2023-01-30
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
namespace OP;

?>
<section>
	<h1>Show Git::SubmoduleConfig() result</h1>
	<p>
		Parse a <code>.gitmodules</code> file and return an associative array.<br/>
		You can specify the file as follows:
	</p>
	<pre><code>OP()->Unit()->Git()->SubmoduleConfig('asset/core/.gitmodules')</code></pre>
	<p>
		Note that the path is always relative to the <b>git root</b>.
	</p>

	<h2>Default</h2>
	<?php
	D( OP()->Unit()->Git()->SubmoduleConfig() );
	?>

	<h2>asset/core</h2>
	<?php
	D( OP()->Unit()->Git()->SubmoduleConfig('asset/core/.gitmodules') );
	?>
</section>

<?php /* $Id */
// License for all code of this FreePBX module can be found in the license file inside the module directory
// Copyright 2015 Sangoma Technologies.
//
if (!defined('FREEPBX_IS_AUTH')) {
	die('No direct script access allowed');
}
$heading = _("Time Groups");
$freepbx = FreePBX::Create();
$request = $_REQUEST;
$content = match ($_GET['view'] ?? '') {
	'form' => load_view(__DIR__.'/views/timegroups/form.php', ['request' => $request]),
	default => load_view(__DIR__.'/views/timegroups/grid.php', ['request' => $request]),
};
?>
<div class="container-fluid">
	<h1><?= $heading ?></h1>
	<?php
	$errormsg = $freepbx->Timeconditions->errormsg;
	if (!empty($errormsg)) {
		echo '<div class="alert alert-danger">' . $errormsg . '</div>';
		$freepbx->Timeconditions->errormsg = '';
	}
	?>
	<div class="display full-border">
		<div class="row">
			<div class="col-sm-12">
				<div class="fpbx-container">
					<div class="display full-border">
						<?= $content ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
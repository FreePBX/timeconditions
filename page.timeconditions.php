<?php /* $Id */
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//  Copyright 2015 Sangoma Technologies.
//
declare(strict_types=1);

if (!defined('FREEPBX_IS_AUTH')) {
	die('No direct script access allowed');
}

$heading = _("Time Conditions");
$request = $_REQUEST ?? [];
$display_mode = "advanced";
$FreePBX = FreePBX::Create();
$mode = $FreePBX->Config->get("FPBXOPMODE");
if (!empty($mode)) {
	$display_mode = $mode;
}

$usagehtml = '';

if (isset($request['view'])) {
	if (isset($request['itemid'])) {
		$destination = timeconditions_getdest($request['itemid']);
		$usagehtml = $FreePBX->View->destinationUsage($destination);
	}

	$content = match ($display_mode) {
		"basic" => load_view(__DIR__.'/views/timeconditions/basic_form.php', ['request' => $request]),
		default => load_view(__DIR__.'/views/timeconditions/advanced_form.php', ['request' => $request]),
	};
} else {
	$content = load_view(__DIR__.'/views/timeconditions/grid.php', ['request' => $request]);
}

?>
<div class="container-fluid">
	<h1><?= $heading ?></h1>
	<?= $usagehtml ?>
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$alerts = $this->layout->getAlerts();
$types = array('success', 'warning', 'info', 'danger');
$alert_header = array(
	'success'=>'Success',
	'warning'=>'Warning',
	'info'=>'Note',
	'danger'=>'Alert',
);

if ( ! $alerts) return;
?> 

<div class="content-header">
	<?php foreach ($alerts as $alert) {
		if ( ! in_array($alert['type'], $types)) continue;
		?>
		<div class="callout callout-<?php echo $alert['type'] ?>">
			<small class="pull-right ca-countdown"></small>
			<h4><?php echo $alert_header[$alert['type']] ?>!</h4>
			<p><?php echo $alert['text'] ?></p>
		</div>
	<?php } ?>
</div>

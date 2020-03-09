<div class="jumbotron">
	<div class="container">
		<h1><?php echo $heading; ?></h1>
		<p><?php echo $text; ?></p>
		<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
	</div>
</div>
<div class="container">
	<!-- Example row of columns -->
	<div class="row">
		<?php foreach ($items as $item) { ?>
		<div class="col-md-12 item">
			<h2><?php echo $item['name']; ?></h2>
			<p><?php echo $item['description']; ?></p>
			<p><a class="btn btn-info" href="#" role="button">View details »</a></p>
		</div>
		<?php } ?>
	</div>
    
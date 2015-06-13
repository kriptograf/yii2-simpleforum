<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Forums</h3>
  </div>
  <div class="panel-body">
    <?php
    	foreach ($dataProvider as $dataProvider) {
    		echo "{$dataProvider->title}";
	}
	?>
  </div>
</div>
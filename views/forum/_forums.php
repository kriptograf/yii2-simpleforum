<?php

use yii\helpers\Html;

?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Forums</h3>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-hover">
			<?php
				foreach ($forums as $forum) {
					echo "<tr>";
						echo "<td class='col-md-6'>";
							echo Html::a($forum->title, ['forum/view', 'id' => $forum->id]);
							echo "</br>";
							echo "{$forum->description}";
						echo "</td>";
						echo "<td class='col-md-2'>";
							echo "Topics no:" . \ivan\simpleforum\models\Thread::find()
								->where(['forum_id' => $forum->id])
								->count();
							echo "<br/>";
							echo "Replies no:" . \ivan\simpleforum\models\Post::find()
								->joinWith(['thread'])
								->where(['forum_id' => $forum->id])
								->count();
						echo "</td>";
						echo "<td class='col-md-4'>";
							echo \ivan\simpleforum\models\Post::find()
								->joinWith(['thread'])
								->where(['forum_id' => $forum->id])
								->orderBy(['id' => SORT_DESC])
								->one()->content;
							echo "</br>";
							echo \ivan\simpleforum\models\Post::find()
								->joinWith(['thread'])
								->where(['forum_id' => $forum->id])
								->orderBy(['id' => SORT_DESC])
								->one()->created;
							echo \ivan\simpleforum\models\Post::find()
								->joinWith(['thread'])
								->where(['forum_id' => $forum->id])
								->orderBy(['id' => SORT_DESC])
								->one()->author_id;
						echo "</td>";
					echo "</tr>";
				}
			?>
		</table>	
	</div>
</div>
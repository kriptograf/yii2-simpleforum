<?php

use yii\helpers\Html;

?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?php if(Yii::$app->getRequest()->getQueryParam('id')):echo "Subforums"; else: echo "Forums"; endif; ?></h3>
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
							echo "Topics no: " . \ivan\simpleforum\models\Thread::find()
								->where(['forum_id' => $forum->id])
								->count();
							echo "<br/>";
							echo "Replies no: " . \ivan\simpleforum\models\Post::find()
								->joinWith(['thread'])
								->where(['forum_id' => $forum->id])
								->count();
						echo "</td>";

						echo "<td class='col-md-4'>";
						if(\ivan\simpleforum\models\Thread::find()->where(['forum_id' => $forum->id])->count() != 0) {
							echo \ivan\simpleforum\models\Thread::find()
								->where(['forum_id' => $forum->id])
								->orderBy(['id' => SORT_DESC])
								->one()->subject;
							echo "</br>";
							echo "on " . Yii::$app->formatter->asDatetime(\ivan\simpleforum\models\Post::find()
								->joinWith(['thread'])
								->where(['forum_id' => $forum->id])
								->orderBy(['id' => SORT_DESC])
								->one()->created);
							echo ", by " . 
							dektrium\user\models\User::find()
								->where([
									'id' => \ivan\simpleforum\models\Post::find()
										->joinWith(['thread'])
										->where(['forum_id' => $forum->id])
										->orderBy(['id' => SORT_DESC])
										->one()->author_id
								])
								->one()->username;
						} else {
							echo "No topics";
						}
						echo "</td>";
					echo "</tr>";
				}
			?>
		</table>	
	</div>
</div>
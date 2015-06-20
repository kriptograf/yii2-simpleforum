<?php

use yii\helpers\Html;

?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Posts</h3>
	</div>
	<div class="panel-body">
		<table class="table table-bordered">
			<?php 
				foreach ($posts as $post) {
					echo "<tr class='info'>";
						echo "<td>";
							echo dektrium\user\models\User::find()
							->where(['id' => $post->author_id])
							->one()->username;
						echo "</td>";
						echo "<td>";
							echo "Posted at " . Yii::$app->formatter->asDatetime($post->created);
						echo "</td>";
					echo "</tr>";

					echo "<tr>";
						echo "<td class='col-md-2'>";
						echo "Joined: " . Yii::$app->formatter->asDate(dektrium\user\models\User::find()
							->where(['id' => $post->author_id])
							->one()->created_at)
						. "</br>";
						echo "Posts: " . ivan\simpleforum\models\Post::find()
                            		->where(['author_id' => $post->author_id])
                          		->count()
                          		. "</br>";
						echo "ID no: " . dektrium\user\models\User::find()
							->where(['id' => $post->author_id])
							->one()->id
							.  "</br>";
						echo "</td>";

						echo "<td class='col-md-10'>";
						echo $post->content;
						echo "</td>";
					echo "</tr>";
				}
			?>
		</table>	
	</div>
</div>
<?php ob_start() ?>

<?php
if($params==NULL){
	echo "<h2>You haven't done any test.</h2>";
} 
?>

<?php foreach ($params as $score) :?>
<div class="thumbnail">
<h2><?php echo $score['title'] ?> </h2>
<h1><?php echo $score['score'] ?>%</h1><br />
</div>
<?php endforeach; ?>

 <?php $content = ob_get_clean() ?>

 <?php include 'layout.php' ?>
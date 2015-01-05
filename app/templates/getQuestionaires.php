<?php ob_start() ?>
<?php
if($params==NULL){
	echo "<h2>There are no Questionaires in the database<h2>";
} 
?>

<?php foreach ($params as $questionaire) :?>
<div class="thumbnail">
<a href="/DB_Project/web/questionaire/solve/<?php echo $questionaire['questionaire_n']?>"><h2><?php echo $questionaire['title'] ?></h2></a><br /><p><?php echo $questionaire['description'] ?></p>
</div>
<?php endforeach; ?>
 


 <?php $content = ob_get_clean() ?>

 <?php include 'layout.php' ?>
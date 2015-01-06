<?php ob_start() ?>

<form method="POST" enctype="multipart/form-data" action="./upload">
	<h2>Upload new questionnaire</h2>
	<h2>File: <input type="file" name="file" id="file"></h2>
	<p><input type="submit" class="botonSubmit" name="submit" value="Submit"></p>
</form>

 <?php $content = ob_get_clean() ?>

 <?php include 'layout.php' ?>
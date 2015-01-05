<?php ob_start() ?>

 <h1><?php echo $params['title'] ?></h1>
 <h2><?php echo $params['description'] ?></h2>

<form id="questionaire" name="questionaire" method="post" action="/DB_Project/web/questionaire/submit">
    <input type="hidden" name="questionaire_n" value="<?php echo $params['questionaire_n'] ?>">
<?php foreach ($params['questions'] as $question) :?>
   <div id="question"><h1><?php echo $question['question'] ?></h1></div>
    <div id="options">
    <input type="radio" name="<?php echo $question['question_n'] ?>" value="A"> <?php echo $question['options'][0]['A'] ?> <br />
        <input type="radio" name="<?php echo $question['question_n'] ?>" value="B"> <?php echo $question['options'][1]['B'] ?> <br />
        <input type="radio" name="<?php echo $question['question_n'] ?>" value="C"> <?php echo $question['options'][2]['C'] ?> <br />
        <input type="radio" name="<?php echo $question['question_n'] ?>" value="D"> <?php echo $question['options'][3]['D'] ?> <br />
    </div>
<?php endforeach; ?>
    <input type="submit" class="botonSubmit" name="submit" value="Submit">
</form>
 <?php $content = ob_get_clean() ?>

 <?php include 'layout.php' ?>
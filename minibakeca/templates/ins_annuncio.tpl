<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>MiniBakeca</title>
  </head>
  <body>
    <?php echo apply_template(__SITE_PATH . '/templates/navigation_bar.tpl'); ?>
    <h1>MiniBakeca</h1>
  	<p>
      Inserisci il tuo nuovo annuncio:

      <?php
      if(!is_null($errorMessage)) {
      ?>
        <br>
        <br>
        <?= $errorMessage?>
        <br>
      <?php
      }
      ?>
      <form action="?url=insAnnuncio/save" method="post">
        Nome <br>
        <input type="text" name="name" value="<?= $values->name ?>"> <?= $errors['name']?>
        <br><br>
        Email <br>
        <input type="text" name="email" value="<?= $values->email ?>"> <?= $errors['email']?>
        <br><br>
        Titolo <br>
        <input type="text" name="title" value="<?= $values->title ?>"> <?= $errors['title']?>
        <br><br>
        Descrizione <br>
        <textarea name="description" rows="5" cols="30"><?= $values->description ?></textarea> <?= $errors['description']?>
        <br><br>
        <button type="submit">Inserisci</button>
      </form>      
  	</p>
  </body>
</html>
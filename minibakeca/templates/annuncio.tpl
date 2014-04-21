<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>MiniBakeca</title>
  </head>
  <body>
  	<h1><?= utf8_encode($dati->title); ?></h1>
  	<p>
      <?= utf8_encode($dati->description); ?>
  	</p>
    <hr>
    Inserito da: <?= utf8_encode($dati->name); ?>
    <br>
    Email: <?= utf8_encode($dati->email); ?>
    <br>
    Il: <?= date("d/m/Y", $dati->date); ?>
    <br>
    Visualizzazioni: <?= $dati->views ?>
  </body>
</html>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <title>MiniBakeca</title>
  </head>
  <body>
    <?php echo apply_template(__SITE_PATH . '/templates/navigation_bar.tpl');  ?>
  	<h1>MiniBakeca</h1>
  	<p>
      Annuncio inserito con successo!
      <br>
      <br>
      <a href="?url=viewAnnuncio&idAnnuncio=<?= $idAnnuncio?>">Clicca qui per visualizzarlo</a>
  	</p>
  </body>
</html>
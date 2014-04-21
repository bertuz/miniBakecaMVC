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
  		<a href="index.php?url=insAnnuncio">Inserisci nuovo</a>
  	</p>
  	<p>
  		Elenco degli attuali annunci [<a href="?url=<?= $route?>/orderDate&desc=true">Nuovi in cima</a> | <a href="?url=<?= $route?>/orderDate&desc=false">Vecchi in cima</a>]
  	</p>
  	<p>
      <?php
        if(sizeof($annunci) == 0) {
      ?>
        Nessun annuncio, per ora.
      <?php
        }
      ?>

  		<ul>
  
      <?php
        for($i=0; $i<sizeof($annunci); $i++) {
      ?>
      
        <li><a href="?url=viewAnnuncio&idAnnuncio=<?= $annunci[$i]->ID?>"><?= $annunci[$i]->title ?></a> inserito il <?= date("d/m/Y",$annunci[$i]->date); ?></li>

      <?php
        }
      ?>

  		</ul>
  	</p>
  </body>
</html>
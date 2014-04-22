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
    <br>
    Interessi inviati: <?= $dati->answers ?>
    <hr>

    <div>
      Esprimi il tuo interesse e fatti contattare:
      <br><br>
      <?php
      if($interestSuccess) {
      ?>
      
        Interesse inviato con successo <br><br>
      
      <?php
      } else {
      ?>

        Interesse non inviato: <?= $errors["genErr"]; ?> <br>

      <?php
      }
      ?>


      <form action="?url=<?= $route?>/interested&idAnnuncio=<?= $dati->ID ?>" method="post">
        Email <br>
        <input type="text" name="email" value="<?= $values->email ?>"> <?= $errors['email']?>
        <br><br>
        <button type="submit">Invia</button>
      </form>      


    </div>

  </body>
</html>
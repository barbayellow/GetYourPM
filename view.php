<?php
require_once('database.class.php');

// Create db object
$dbcon = new database();

// request all data in db
$data = $dbcon->queryArrayFetchAll();

?>
<html lang="fr-FR">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Députés AN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<div class="container">
  	<div class="page-header">
      <h1>Liste des députés</h1>
    </div>

	  <table class="table table-striped">
	    <thead>
	      <tr>
	        <th>Civilité</th>
	        <th>Prénom</th>
	        <th>Nom</th>
	        <th>Département</th>
	        <th>Circonscription</th>
	        <th>Groupe</th>
	        <th>Contact</th>
	      </tr>
	    </thead>
	    <tbody>
      <?php while ($r = $data->fetch()) : ?>
        <tr>
          <td> <?php echo $r['civilite'] ?></td>
          <td> <?php echo $r['prenom'] ?></td>
          <td> <?php echo $r['nom'] ?></td>
          <td> <?php echo $r['departement'] ?></td>
          <td> <?php echo $r['circonscription'] ?></td>
          <td> <?php echo $r['groupe'] ?></td>
          <td> <?php echo $r['contact'] ?></td>
      </tr>
      <?php endwhile; ?>
      </tbody>
	  </table>

	  <p class="pull-right small">Scrapped from http://www.assemblee-nationale.fr</p>
	</div>

</body>
</html>

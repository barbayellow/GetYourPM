<?php

/*

*** Action file
- récup les coords dans fichier local (ou pas local)
- récup contacts dans fiches linkées -> scrapping
- sauve en base

*** Todo
- nothing yet

*/

require_once('lib/simple_html_dom.php');
require_once('lib/database.class.php');

// usefull vars
$dirwork = 'data';
$dirname = realpath('./').'/' . $dirwork;
$filename = 'data-short.html';
$abspath = $dirname . '/' . $filename;
$relpath = $dirwork . '/' . $filename;
$baseurl = "http://www.assemblee-nationale.fr";
$count = 0;
// Create db object
$dbcon = new database();

// Load local or distant html file
$html = new simple_html_dom();
$html->load_file($relpath);


// Let's go
echo 'fecthing data';
// For each table line - header excluded
foreach($html->find('tr') as $tr) {
  if ($tr->first_child()->tag != 'th') { // check qu'on est ds la bonne partie du tableau
    $civilite = trim(str_replace('&nbsp;', ' ', $tr->children(1)->innertext));
    $prenom = trim(str_replace('&nbsp;', ' ', $tr->children(2)->innertext));
    $nom = trim(str_replace('&nbsp;', ' ', $tr->children(3)->innertext));
    $groupe = trim(str_replace('&nbsp;', ' ', $tr->children(4)->innertext));
    $dpt = trim(str_replace('&nbsp;', ' ', $tr->children(5)->innertext));
    $circ = trim(str_replace('&nbsp;', ' ', $tr->children(6)->innertext));
    $commission = trim(str_replace('&nbsp;', ' ', $tr->children(7)->innertext));

		// recup url page de contact
    $link = $tr->children(0)->first_child()->href;
    $link = $baseurl . $link;

    // scrapping url page de contact
    $html2 = new simple_html_dom();
		$html2->load_file($link);
		$contacts = $html2->find('li.contact-adresse');

		// Loop trough the table of objects and display text
		foreach($contacts as $contact) {
		  $contact = $contact->innertext;
		  //echo $contact;
		}

		// unload html2 object
		$html2->clear();

		// insert data in DB
		$dbcon->insertSingleRow($civilite,$prenom,$nom,$groupe,$dpt,$circ,$commission,$contact);

		/* stuff to make people wait in peace */
    $count ++;
		echo '.';
  }
}
echo "\n" . $count . ' requests' . "\n";

// unload html object
$html->clear();

?>
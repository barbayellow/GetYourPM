# Get Your PM

Un petit bout de code qui permet de récupérer et d'agréger des données en ligne. Il a été spécialement été développé pour agréger les informations du site assemblenationale.fr sur les parlementaires français :

* nom
* prénom
* civilité
* groupe
* département
* circonscription
* commission
* informations de contact

Toutes ces infos sont publiquement accessibles sur le site de l'assemblée nationale mais éclatées en 578 pages. Ce script les réunit.

## Détail

* action.php lance le scrapping
* view.php pour la sortie (utilise [bootstrap](http://getbootstrap.com/) pour la mise en page mais on peut bien styler comme on veut)
* lib/database.php enregister et ressort les infos de la base mysql (à créer à la main - structure inclue ds le fichier)
* simplehtml_html_dom.php le parser php [simple html dom](http://sourceforge.net/projects/simplehtmldom/)

## Todo

Structurer les informations de contact'. Tout est en vrac pour l'instant. Faisable avec les expressions régulières mais perso, je déteste ça. Si une bonne âme veut s'y pencher.

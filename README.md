**Approche technique et fonctionnelle**

Dans le cadre de la demande je fournis une version finale représentant environ 5h30 de travail 
(j'avais un résultat presque totalement fonctionnel au bout d'une 1h30 - que je regrette maintenant de ne pas avoir commité - , mais les tests, le refactoring et 
les commentaires ça prend un peu de temps ;-) ).
Habituellement j'aurais sans doute cherché à optimiser mon temps par rapport au chiffre vendu client 
mais ignorant cette donnée j'ai simplement développé afin de respecter les différentes attentes du CdC
et autres normes de codage (à noter que sur le passage de variables aux fonctions j'ai bien noté le _variable
mais ne sachant pas si c'était aussi requis sur les méthodes, j'ai passé outre, sans doute à rediscuter).

J'ai cherché à exploiter différentes techniques, pas forcément nécessaire ici (et qui complexifie un peu trop 
l'ensemble pour un si petit test à mon goût), mais utile à l'usage, comme 
les traits et les namespaces ou les regex. J'ai aussi subdivider au maximum les éléments. Sur un dev "pressé"
j'aurais sûrement fait plus simple comme architecture allant plus au fonctionnel qu'à l'esthétique.

EDIT : bon tu as mis à jour le test, alors forcément ça répond à certaines questions, mais je prends le parti de ne rien changer à ce qui suit
J'ai assumé que certaines données n'étaient pas structurées mais présentes dans les textes descriptifs de 
l'annonce (comme la présence d'un parking, d'une piscine, etc) n'ayant pas trouvé la spec du XML sur le site de bonotel.
J'avoue n'avoir pas parcouru les 5000 items et assume que certains tests sont incomplet ;-)
J'ai également pris parti de considérer que introduction_text et introduction_media n'était pas des données
unitaire mais de possible tableaux de par l'analyse de leur nature. Egalement que distribution était rapport à une 
donnée voyagiste et ne contiendrait ici que la clef BONOTEL. En temps normal j'aurais vérifier ces données avec le chef de projet,
mais je suppose que tu regardes aussi notre capacité d'analyse (et si c'est de communication, damned :-P)

Tout le code a été pensé pour être réexploitable dans le cadre d'autre import de l'objet Hotel.
NB : certaines méthodes sont publiques uniquement à cause des tests unitaires

**Commande pour lancer l'import**

Le paquet php-xml est nécessaire. Sous debian (postulat d'un LAMP déjà installé) :

PHP 7

```
apt install php-xml
```

PHP 5 ou et/ou débian plus ancien
```
apt-get install php5-xml
```


Le code est orienté PHP 5 ne connaissant pas l'architecture de déploiement.

En mode développement, dans config.php, attribuer DEV à ENV ce qui permet d'utiliser un XML et des images locales
Pour passer en production et utiliser la vraie url d'appel et les vraies images, attribuer PROD a ENV (forcément ça prend du temps)

Dans les deux cas, le binaire PHP doit être définis et accessible via la variable PATH

```
php final_version.php
```

**Lancer les tests unitaires selon la version de PHP**

Sous linux 
```
./phpunit5 test1.php
./phpunit7 test1.php
```

Sous Windows 
```
phpunit5.cmd test1.php
phpunit7.cmd test1.php
```


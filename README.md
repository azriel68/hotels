**Approche technique et fonctionnelle**

Dans le cadre de la demande je fournis une version finale représentant environ 4h30 de travail 
(j'avais un résultat presque totalement fonctionnel au bout d'une 1h30 - que je regrette maintenant de ne pas avoir commité - , mais les tests, le refactoring et 
les commentaires ça prend un peu de temps ;-) ).
Habituellement j'aurais sans doute chercher à optimiser mon temps par rapport au chiffre vendu client 
mais ignorant cette donnée j'ai simplement développé afin de respecter les différentes attentes du CdC
et autres normes de codage (à noter que sur le passage de variable au fonction j'ai bien noté le _variable
mais ne sachant pas si c'était aussi requis sur les méthodes, j'ai passé outre, sans doute à rediscuter).

J'ai cherché à exploiter différentes techniques, pas forcément nécessaire ici (et qui complexifie un peu trop 
l'ensemble pour un si petit test), mais utile à l'usage, comme 
les traits et les namespaces ou les regex. J'ai aussi subdivider au maximum les éléments. Sur un dev "pressé"
j'aurais sûrement fait plus simple comme architecture allant plus au fonctionnel qu'à l'esthétique.

J'ai assumé que certaines données n'étaient pas structurées mais présentes dans les textes descriptifs de 
l'annonce (comme la présence d'un parking, d'une piscine, etc) n'ayant pas trouvé la spec du XML sur le site de bonotel.
J'ai également pris parti de considérer que introduction_text et introduction_media n'était pas des données
unitaire mais de possible tableaux de par l'analyse de leur nature. Egalement que distribution était rapport à une 
donnée voyagiste. En temps normal j'aurais vérifier ces données avec le chef de projet.

Tout le code a été pensé pour être réexploitable dans le cadre d'autre import de l'objet Hotel.

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

En mode développement, dans config.php, attribuer DEV à $env
Pour passer en production et utiliser la vraie url d'appel, attribuer PROD a $env

Dans les deux cas, le binaire PHP doit être définis et accessible via la variable PATH

```
php job1.php
```

**Lancer les tests unitaires**

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


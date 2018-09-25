**Approche technique et fonctionnelle**

Dans le cadre de la demande je fournis une version finale représentant environ 4h30 de travail.
Habituellement j'aurais sans doute chercher à obtimiser mon temps par rapport au chiffre vendu client 
mais ignorant cette donnée j'ai simplement développer afin de respecter les différentes attentes du CdC.

J'ai cherché à exploiter différentes techniques, pas forcément nécessaire, utile à l'usage, comme 
les traits et les namespaces. J'ai aussi subdivider au maximum les éléments. Sur un dev "pressé"
j'aurai sûrement fait plus simple.

J'ai assumé que certaines données n'étaient pas structurées mais présentes dans les textes descriptifs de l'annonce (comme la présence d'un parking, d'une piscine, etc).
J'ai également pris partie de considérer que introduction_text et introduction_media n'était pas des données
unitaire mais de possible tableaux de par l'analyse de leur nature. En temps normal j'aurais vérifier ces données avec le chef de projet.

Tout le code a été pensé pour être reexploitable dans le cadre d'autre import de l'objet Hotel.

**Commande pour lancer l'import**

Le paquet php-xml est nécessaire. Le code est orienté PHP 5 ne connaissant pas l'architecture de déploiement.

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


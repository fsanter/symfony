# symfony
Cours symfony août 2018

Git:

Système de versionning
Système de gestion de versions décentralisé : chaque poste
possède l'ensemble du code

Utilisable ligne de commande ou avec une interface graphique
comme Git GUI

Git est utilisable avec plusieurs protocoles :
- HTTPS
- SSH : fonctionne avec un duo clé privée/clé publique
    * La clé privée est personnelle et permet
    de crypter des données à envoyer
    * La clé publique permet de décrypter, et vous pouvez la donner
    à n'importe qui, pour qu'il puisse décrypter ce que vous
    envoyez

### Commandes :
**git clone** : cloner/récupérer un projet pour le placer sur son poste

Pour envoyer ses modifications sur le serveur, il y a trois étapes:
1- dire quels fichiers on veut envoyer
(ce qui peut se faire en plusieurs fois)  :
prendre en compte certains fichiers pour le prochain commit

git add .
"." pour prendre en compte tous les fichiers modifiés
sinon il faut le faire fichier par fichier

WARNING : les fichiers qui sont mentionnés dans le
.gitgnore ne sont pas pris en compte


2- préparer les fichiers à envoyer dans un commit
avec un message expliquant quels sont les modifications
apportées dans ce commit

git commit -m "le message qui explique les modifs"

3- git push
envoyer tous les commits vers le serveur

II) Dans l'autre sens, pour récupérer les modifs du serveur
1- facultatif : vous devez d'abord ajouter à l'index
vos fichiers modifiés/créés
(git add "ici voit ., soit le nom de vos fichiers").
Si il n'y en a pas, on peut aller à l'étape 2.

2- git pull
pour récupérer tous les derniers commits présents sur le serveur

III)
Dans une installation symfony sur git, on ne versionne pas les vendors
et certaines autres fichiers (.gitgnore)
php ../composer.phar update

composer met à jour ou installe les vendors nécessaires
qui sont précisés dans le fichier composer.json

à la fin composer vous demande également de mettre à jour si nécessaire
le fichier de paramètre app/config/parameters.yml
Ce fichier contient au miniimum les accès à la base de données
et tout autre paramètre rajouté par les autres dévs


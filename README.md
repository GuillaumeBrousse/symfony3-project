A Symfony project created on April 19, 2017, 5:39 pm.

## Elections 2017

L'application Elections 2017 est développée en PHP à l'aide du framework Symfony3.

### 1 - Installation des outils
    
#### Composer

Télécharger [Composer](http://getcomposer.org/) à l'aide de la commande suivante :

    curl -s http://getcomposer.org/installer | php
    
Installer composer :

    sudo mv composer.phar /usr/local/bin/composer

### 2 - Avant de démarrer

#### Installer les vendors

Installer les dépendances du projet à l'aide de composer :

    composer install

#### C'est prêt !

L'application est prête à être utilisée en mode DEV, il est nécessaire de fournir les droits en lecture et écriture sur tous les fichiers du projet pour l'utilisateur apache : `chmod -R o+rw ./`

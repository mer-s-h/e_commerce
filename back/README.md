Sprint 1 :

Command sprint 1 :

    - symfony new back
    - cd back
    - composer req api
    - create .env.local with (DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/ecommerce?serverVersion=5.7")
    - composer i (for use command php bin/console)
    - php bin/console doctrine:database:create (crée ecommerce dans mysql)
    - php bin/console doctrine:schema:create
    - composer require symfony/maker-bundle --dev (dépendance pour l'entité)
    - php bin/console make:entity inscription
    - php bin/console make:migration
    - php bin/console doctrine:migrations:migrate

Marie ==> Connexion :
En tant que : Utilisateur
Je veux : me connecter
Afin de : pouvoir faire des achats



Vincent ==> Inscription :
En tant que : Utilisateur
Je veux : m'inscrire
Afin de : m'identifier et avoir un compte utilisateur



Meriem ==> Déconnexion :
En tant que : Utilisateur
Je veux : me déconnecter
Afin de : ne plus accéder au site ou de changer d'utilisateur
Page d'accueil :
En tant que : Utilisateur
Je veux : accéder à la page d'accueil
Afin de : voir tout les articles en vente



Régina ==> Article :
En tant que : Utilisateur
Je veux : sélectionner des articles
Afin de : les acheter



Micipsa ==> FAQ :
En tant que : Utilisateur
Je veux : avoir accès à des questions réccurente
Afin de : résoudre mes problèmes
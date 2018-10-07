Anaxago symfony-starter-kit
===================

# Description

Ce projet est un kit de démarage avec en prérequis :
- Symfony 3.4 minimum
- php 7.1 minimum
- MySQL 5.5 minimum ou MariaDB 10 minimum

La base de données contient deux tables :
- user => pour la gestion et la connexion des utilisateurs 
- project => pour la liste des projets

Les données préchargés sont
- pour les users 

| email     | password    | Role |
| ----------|-------------|--------|
| john@local.com  | john   | ROLE_USER    |
| admin@local.com | admin | ROLE_ADMIN   | 

 - une liste de 3 projets
 
La connexion et l'enregistrement des utilisateurs sont déjà configurés et opérationnels


#Installation de JWT


Add [`lexik/jwt-authentication-bundle`](https://packagist.org/packages/lexik/jwt-authentication-bundle)
to your `composer.json` file:

    php composer.phar require "lexik/jwt-authentication-bundle"

Register the bundle in `app/AppKernel.php`:

``` php
public function registerBundles()
{
    return array(
        // ...
        new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),
    );
}
```

Generate the SSH keys :

``` bash
$ mkdir -p config/jwt # For Symfony3+, no need of the -p option
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

In case first ```openssl``` command forces you to input password use following to get the private key decrypted
``` bash
$ openssl rsa -in config/jwt/private.pem -out config/jwt/private2.pem
$ mv config/jwt/private.pem config/jwt/private.pem-back
$ mv config/jwt/private2.pem config/jwt/private.pem
```

Configuration
-------------

Configure the SSH keys path in your `config/packages/lexik_jwt_authentication.yaml` :

``` yaml
lexik_jwt_authentication:
    secret_key:       '%kernel.project_dir%/config/jwt/private.pem' # required for token creation
    public_key:       '%kernel.project_dir%/config/jwt/public.pem'  # required for token verification
    pass_phrase:      'your_secret_passphrase' # required for token creation, usage of an environment variable is recommended
    token_ttl:        3600
```

Configure your `config/packages/security.yaml` :

``` yaml
security:
    # ...
    
    firewalls:

        login:
            pattern:  ^/api/login
            stateless: true
            anonymous: true
            json_login:
                check_path:               /api/login_check
                success_handler:          lexik_jwt_authentication.handler.authentication_success
                failure_handler:          lexik_jwt_authentication.handler.authentication_failure

        api:
            pattern:   ^/api
            stateless: true
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator

    access_control:
        - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/api,       roles: IS_AUTHENTICATED_FULLY }
```

Configure your `config/routes.yaml` :

``` yaml
api_login_check:
    path: /api/login_check
```

# Installation
- ```composer install```
- ```composer init-db ```

    - Script personnalisé permet de créer la base de données, de lancer la création du schéma et de précharger les données
    - Ce script peut être réutilisé pour ré-initialiser la base de données à son état initial à tout moment

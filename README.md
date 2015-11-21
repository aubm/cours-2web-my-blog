# Présentation

Ce projet est un support pour le cours de Supinfo 2WEB promotion 2014/2015.

![Page d'accueil](http://git.aubm.net/cours-supinfo-2web/my-blog/raw/master/doc/home.png)

# Installation et démarrage

1. Télécharger les fichiers de ce repo (avec git `git clone http://git.aubm.net/cours-supinfo-2web/my-blog.git`).
2. Créer une base de données MySQL nommée `my_blog_2web`, configurer un accès `root`, `root` ou bien changer les informations dans config.php au besoin.
3. Importer les tables en jouant les requêtes SQL contenues dans les fichiers sous `sql_files`.
4. Démarrer un serveur HTTP avec PHP dans le répertoire `public` :
..1. `cd public`
..2. `php -S localhost:8080`
5. (Option) La branche `add_router` propose une organisation du code permettant d'intégration de routing.

# Utilisation

- Naviguer sur `localhost:8080` pour atteindre la page d'accueil.
- Naviguer sur `localhost:8080/admin` pour atteindre l'administration du site protégée par user/mot de passe.

# License

http://www.apache.org/licenses/LICENSE-2.0
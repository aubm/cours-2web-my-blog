<?php

namespace MyBlog\Database;

/**
 * Cette classe représente une légère surchouche à la classe \PDO.
 * Le contrôleur est surchargé afin de faciliter l'instanciation et la méthode
 * de classe getInstance() est écrite de façon à toujours retourner la même
 * instance de de classe classe. Ce modèle est inspiré du patron de construction
 * Singleton qui permet de réduire la consommation mémoire lors de l'éxécution du
 * script.
 * Par ailleurs, dans le cas de cette classe, une seule instance de \PDO
 * signifie également une seule connexion à la base de données, ce qui constitue
 * une meilleure optimisation des accès I/O.
 */
class Database extends \PDO
{
    private static $_instance;

    public function __construct()
    {
        $dsn = 'mysql:dbname=my_blog_2web;host=127.0.0.1';
        $root = 'root';
        $password = 'root';

        try {
            parent::__construct($dsn, $root, $password);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
            self::$_instance->exec('SET CHARACTER SET utf8');
        }
        return self::$_instance;
    }
}
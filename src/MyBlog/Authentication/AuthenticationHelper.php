<?php

namespace MyBlog\Authentication;

/**
 * La classe AuthenticationHelper expose les méthodes nécessaires pour
 * persister, lire et supprimer des données d'un utilisateur en session.
 */
class AuthenticationHelper
{
    public function setCurrentUser(User $user)
    {
        /* L'information est stockée en session en ajoutant une entrée dans la
           superglobale $_SESSION. L'index 'current_user' est choisi de façon
           tout à fait arbitraire.

           Le support offert par PHP pour stocker des objets en session est limité.
           Une façon simple de contourner ce problème consiste à sérialiser cet
           objet afin d'en stocker une représentation textuelle. unserialize sera
           utilisé pour re-créer l'objet à partir de sa représentation. Cet technique
           peut être utilisée avec n'importe quel type de variable.

           A noter que les informations stockées dans le tableau $_SESSION ne seront
           effectivement persistées en session que si la fonction session_start a été
           appelée en amont. Cette fonction est appelée dans le fichier bootstrap.php. */
        $_SESSION['current_user'] = serialize($user);
    }

    /**
     * Retire les informations liées à l'utilisateur connecté de la session.
     * Cette méthode peut être utilisée dans un workflow de déconnexion.
     */
    public function unsetCurrentUser()
    {
        unset($_SESSION['current_user']);
    }

    /**
     * Retourne la représentation de l'utilisateur connecté. Si aucun utilisateur
     * n'est connecté, la méthode renverra la valeur null.
     *
     * @return User|null
     */
    public function getCurrentUser()
    {
        if (isset($_SESSION['current_user'])) {
            return unserialize($_SESSION['current_user']);
        }

        return null;
    }
}
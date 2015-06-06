<?php

/* Ce fichier est pensé pour être inclus en début de chaque fichier
   PHP sous le répertoire admin.
   Une instance de la classe \MyBlog\Authentication\AuthenticationHelper
   est utilisée pour s'assurer qu'un utilisateur est actuellement connecté.

   Si ce n'est pas le cas, la méthode \MyBlog\Navigation\NavigationHelpe::redirectUser()
   est utilisée afin de rediriger l'utilisateur vers la page login.php */

use \MyBlog\Authentication\Factory;
use \MyBlog\Navigation\NavigationHelper;

$authentication_factory = Factory::getAuthenticationHelper();
$current_user = $authentication_factory->getCurrentUser();
if ($current_user === null) {
    $navigation_helper = new NavigationHelper();
    $navigation_helper->redirectUser('../login.php');
}

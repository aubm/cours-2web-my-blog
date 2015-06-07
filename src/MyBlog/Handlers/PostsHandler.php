<?php

namespace MyBlog\Handlers;

use MyBlog\Http\Request;
use \MyBlog\Posts\Factory;
use \MyBlog\Authentication\Factory as AuthFactory;
use \MyBlog\Navigation\NavigationHelper;
use MyBlog\Posts\Post;
use MyBlog\Validation\ValidationErrors;
use MyBlog\Validation\ValidationException;

class PostsHandler extends HandlerParent
{
    public function index()
    {
        $posts_manager = Factory::getPostsManager();
        $posts = $posts_manager->getAllPosts();

        $this->renderTemplate('posts/index.html.php', [
            'posts' => $posts
        ]);
    }

    public function details()
    {
        $posts_manager = Factory::getPostsManager();
        /* Le paramètre d'url postSlug peut être directement lu en accédant
           à l'index 'postSlug' de la superglobale $_GET. $_GET, au même titre que
           $_POST, $_REQUEST, $_SERVER, $_SESSION (etc ...) est de type array. */
        $post = $posts_manager->getOnePostBySlug($_GET['postSlug']);

        $this->renderTemplate('posts/details.html.php', [
            'post' => $post
        ]);
    }

    public function adminIndex()
    {
        $this->checkUserAuthentication();

        $posts_manager = Factory::getPostsManager();
        $posts = $posts_manager->getAllPosts();

        $this->renderTemplate('posts/admin-index.html.php', [
            'posts' => $posts
        ]);
    }

    public function edit()
    {
        $this->checkUserAuthentication();

        /* Les variables $validation_errors et $post sont utilisées dans le template
           qu'il s'agisse d'une requête de type GET ou de type POST.

           L'objet $validation_errors est utilisé pour extraire les erreurs potentielles
           associées aux champs du formulaire.

           L'état de $post est utilisé pour pré-remplir les champs du formulaire
           (voir notamment les attributs value des champs input). */
        $validation_errors = new ValidationErrors();
        $post = new Post();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request = new Request();
            $posts_manager = Factory::getPostsManager();

            /* $post contient une instance de \MyBlog\Posts\Post dont l'état
               est issu des informations contenues dans le corps de la
               requête HTTP (ei: $_POST) */
            $post = $posts_manager->createNewPost([
                'title' => $_POST['title'],
                'slug' => $_POST['slug'],
                'content' => $_POST['content'],
                'content_short' => $_POST['content_short'],
                'uploaded_files' => $request->getRequestFilesFromGlobals()
            ]);

            try {
                /* PostsManagerInterface::validate() lévera une exception du type
                   \MyBlog\Validation\ValidationException si des erreurs de validation
                   existent.
                   Cette exception sera catchée par le bloc catch, dans lequel
                   l'instance de \MyBlog\Validation\ValidationErrors sera extraite (afin
                   d'être utilisée dans le template).
                   Si aucune exception n'est levée, les instructions suivantes du bloc
                   try seront executées. Ainsi le post sera sauvegardé, puis l'utilisateur
                   sera redirigé vers l'accueil de l'espace d'administration. */
                $posts_manager->validate($post);
                $posts_manager->save($post);
                $navigation_helper = new NavigationHelper();
                $navigation_helper->redirectUser(SERVER_ROOT . '/admin');
            } catch (ValidationException $e) {
                $validation_errors = $e->getValidationErrors();
            }
        }

        $this->renderTemplate('posts/edit.html.php', [
            'validation_errors' => $validation_errors,
            'post' => $post
        ]);
    }

    public function remove()
    {
        $this->checkUserAuthentication();

        $posts_manager = Factory::getPostsManager();

        $post_id = $_POST['post_id'];
        $post = $posts_manager->getOnePostById($post_id);

        $posts_manager->removePost($post);

        $navigation_helper = new NavigationHelper();
        $navigation_helper->redirectUser(SERVER_ROOT . '/');
    }

    public function removeAjax()
    {
        $this->checkUserAuthentication();

        $posts_manager = Factory::getPostsManager();

        $post_id = $_POST['post_id'];
        $post = $posts_manager->getOnePostById($post_id);

        $posts_manager->removePost($post);

        http_response_code(204);
    }

    /* Cette méthode privée est pensée pour être appellée en début de chaque méthode
       nécessitant une authentification de la part de l'utilisateur final.
       Une instance de la classe \MyBlog\Authentication\AuthenticationHelper
       est utilisée pour s'assurer qu'un utilisateur est actuellement connecté.

       Si ce n'est pas le cas, la méthode \MyBlog\Navigation\NavigationHelpe::redirectUser()
       est utilisée afin de rediriger l'utilisateur vers la page login */
    private function checkUserAuthentication()
    {
        $authentication_factory = AuthFactory::getAuthenticationHelper();
        $current_user = $authentication_factory->getCurrentUser();
        if ($current_user === null) {
            $navigation_helper = new NavigationHelper();
            $navigation_helper->redirectUser(SERVER_ROOT . '/login');
        }
    }
}
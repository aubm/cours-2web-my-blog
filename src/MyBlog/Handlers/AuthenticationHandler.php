<?php

namespace MyBlog\Handlers;

use MyBlog\Authentication\Factory as AuthFactory;
use MyBlog\Authentication\User;
use MyBlog\Hash\Factory as HashFactory;
use MyBlog\Navigation\NavigationHelper;
use MyBlog\Validation\ValidationErrors;
use MyBlog\Validation\ValidationException;

class AuthenticationHandler extends HandlerParent
{
    public function login()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $users_manager = AuthFactory::getUsersManager();
            $user = $users_manager->getOneUserByUsername($_POST['username']);

            if ($user !== null) {
                $hasher = HashFactory::getHasher();
                if ($hasher->compare($_POST['password'], $user->getPassword())) {
                    $authentication_helper = AuthFactory::getAuthenticationHelper();
                    $authentication_helper->setCurrentUser($user);

                    $navigation_helper = new NavigationHelper();
                    $navigation_helper->redirectUser(SERVER_ROOT . '/admin');
                }
            }

            $error = 'Nom d\'utilisation ou mot de passe incorrect';
        }

        $this->renderTemplate('authentication/login.html.php', [
            'error' => $error
        ]);
    }

    public function logout()
    {
        $authentication_helper = AuthFactory::getAuthenticationHelper();
        $authentication_helper->unsetCurrentUser();

        $navigation_helper = new NavigationHelper();
        $navigation_helper->redirectUser(SERVER_ROOT . '/');
    }

    public function register()
    {
        $validation_errors = new ValidationErrors();
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $users_manager = AuthFactory::getUsersManager();
            $user = $users_manager->createUser([
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'password_confirmation' => $_POST['password_confirmation']
            ]);
            try {
                $users_manager->validate($user);
                $users_manager->save($user);

                $navigation_helper = new NavigationHelper();
                $navigation_helper->redirectUser(SERVER_ROOT . '/login');
            } catch (ValidationException $e) {
                $validation_errors = $e->getValidationErrors();
            }
        }

        $this->renderTemplate('authentication/register.html.php', [
            'validation_errors' => $validation_errors,
            'user' => $user
        ]);
    }
}
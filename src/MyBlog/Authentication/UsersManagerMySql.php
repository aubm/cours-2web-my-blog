<?php

namespace MyBlog\Authentication;

use MyBlog\Database\Database;
use MyBlog\Hash\Factory as HashFactory;
use MyBlog\Validation\ValidationErrors;
use MyBlog\Validation\ValidationException;

class UsersManagerMySql
{
    /** @var Database */
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return User
     */
    public function getOneUserByUsername($username)
    {
        $statement = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindValue('username', $username);
        $statement->execute();
        $user_data = $statement->fetch(\PDO::FETCH_ASSOC);
        if ($user_data) {
            $user = new User();
            $this->hydrateUser($user, $user_data);
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @return User
     */
    public function createUser(array $user_data)
    {
        $user = new User();
        $this->hydrateUser($user, $user_data);
        return $user;
    }

    public function save(User $user)
    {
        /* Si il s'agit d'un nouvel utilisateur, (ei si la valeur de id est nulle),
           nous allons hacher le mot de passe avant de l'enregistrer en base de données. */
        $hasher = HashFactory::getHasher();
        $user->setPassword(
            $hasher->hash($user->getPassword())
        );

        $query = 'INSERT INTO users (username, password) VALUES (:username, :password)';
        $statement = $this->db->prepare($query);
        $statement->bindValue('username', $user->getUsername());
        $statement->bindValue('password', $user->getPassword());
        $statement->execute();
    }

    public function validate(User $user)
    {
        $validation_errors = new ValidationErrors();

        if (!$user->getUsername()) {
            $validation_errors->registerErrorForField('username', 'Vous devez renseigner un nom d\'utilisateur');
        }

        if (!$user->getPassword()) {
            $validation_errors->registerErrorForField('password', 'Le mot de passe ne peut pas être vide');
        }

        /* S'il s'agit d'un nouvel utilisateur (ei si le champ id est nul),
           Nous appliquons des règles de validations supplémentaires. */
        if ($user->getId() === null) {
            /* Il faut s'assurer que la valeur de username n'est pas déjà utilisée
               en base de données. */
            if ($user->getUsername() && $this->getOneUserByUsername($user->getUsername())) {
                $validation_errors->registerErrorForField('username',
                    'Ce nom d\'utilisateur est déjà utilisé');
            }

            /* Une valeur doit également être saisie pour password_confirmation et
               doit être égale à la valeur de password. */
            if ($user->getPasswordConfirmation()) {
                if ($user->getPassword() !== $user->getPasswordConfirmation()) {
                    $validation_errors->registerErrorForField('password',
                        'Les deux mots de passe ne correspondent pas');
                }
            } else {
                $validation_errors->registerErrorForField('password_confirmation',
                    'Vous devez re-saisir votre mot de passe');
            }
        }

        if ($validation_errors->getErrorsCount() > 0) {
            $e = new ValidationException();
            $e->setValidationErrors($validation_errors);
            throw $e;
        }
    }

    private function hydrateUser(User $user, array $user_data)
    {
        if (isset($user_data['id'])) {
            $user->setId($user_data['id']);
        }

        if (isset($user_data['username'])) {
            $user->setUsername($user_data['username']);
        }

        if (isset($user_data['password'])) {
            $user->setPassword($user_data['password']);
        }

        if (isset($user_data['password_confirmation'])) {
            $user->setPasswordConfirmation($user_data['password_confirmation']);
        }
    }
}
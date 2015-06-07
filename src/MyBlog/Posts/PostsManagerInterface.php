<?php

namespace MyBlog\Posts;

/**
 * La méthode de classe \MyBlog\Posts\Factory::getPostsManager() retournera
 * toujours une instance de \MyBlog\Posts\PostsManagerInterface.
 * L'implémentation de cette interface peut changer tant que la classe
 * concrète qui l'implémente respecte le contract défini par elle. Si bien
 * que retourner une instance de \MyBlog\Posts\PostsManagerMySql ou une instance
 * de \MyBlog\Posts\PostsManagerJson ne changera pas la manière dont se comporte
 * les fichiers utilisant cette API (par exemple : /public/index.php, /public/post-details.php,
 * etc ...).
 *
 * C'est là tout l'intérêt de l'utilisation des interfaces. Privilégier la
 * dépendance à une abstraction (une interface par exemple, ou une classe abstraite),
 * plutôt qu'à une classe concrète est un des principes du design objet visant
 * à produire un code mieux découplé.
 */
interface PostsManagerInterface
{
    /**
     * @param array $post_state
     * @return Post
     */
    public function createNewPost(array $post_state);

    /**
     * @param Post $post
     */
    public function save(Post $post);

    /**
     * @param Post $post
     */
    public function validate(Post $post);

    /**
     * @return Post[]
     */
    public function getAllPosts();

    /**
     * @param string $post_slug
     * @return Post
     */
    public function getOnePostBySlug($post_slug);

    /**
     * @return Post
     */
    public function getOnePostById($post_id);

    /**
     * @param Post $post
     */
    public function removePost(Post $post);
}
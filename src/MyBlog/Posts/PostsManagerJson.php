<?php

namespace MyBlog\Posts;

class PostsManagerJson extends PostsManagerParent implements PostsManagerInterface
{
    private $json_file_path;

    public function __construct($json_file_path)
    {
        $this->json_file_path = $json_file_path;
    }

    public function getAllPosts()
    {
        $json_content = file_get_contents($this->json_file_path);
        $posts_to_return = [];
        $posts = json_decode($json_content, true);
        foreach($posts as $post) {
            $p = new Post();
            $this->hydratePost($p, $post);
            $posts_to_return[] = $p;
        }
        return $posts_to_return;
    }

    public function getOnePostBySlug($post_slug)
    {
        $posts = $this->getAllPosts();
        $post = null;
        foreach ($posts as $p) {
            if ($p->getSlug() === $post_slug) {
                $post = $p;
            }
        }
        return $post;
    }

    public function save(Post $post)
    {
        // TODO: Implement save() method.
    }

    public function validate(Post $post)
    {
        // TODO: Implement validate() method.
    }

    public function getOnePostById($post_id)
    {
        // TODO: Implement getOnePostById() method.
    }

    public function removePost(Post $post)
    {
        // TODO: Implement removePost() method.
    }
}
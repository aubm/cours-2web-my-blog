<?php

namespace MyBlog\Posts;

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

    public function removePost(Post $post);
}
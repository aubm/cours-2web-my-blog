<?php

namespace MyBlog\Posts;

abstract class PostsManagerParent
{
    public function createNewPost(array $post_state)
    {
        $post = new Post();
        $this->hydratePost($post, $post_state);
        return $post;
    }

    /**
     * @param Post $post
     * @param array $post_data
     */
    protected function hydratePost(Post $post, array $post_data)
    {
        if (isset($post_data['id'])) {
            $post->setId($post_data['id']);
        }

        if (isset($post_data['title'])) {
            $post->setTitle($post_data['title']);
        }
        if (isset($post_data['slug'])) {
            $post->setSlug($post_data['slug']);
        }
        if (isset($post_data['content'])) {
            $post->setContent($post_data['content']);
        }
        if (isset($post_data['content_short'])) {
            $post->setContentShort($post_data['content_short']);
        }
        if (isset($post_data['illustration_original'])) {
            $post->setIllustrationOriginal($post_data['illustration_original']);
        }
        if (isset($post_data['illustration_preview'])) {
            $post->setIllustrationPreview($post_data['illustration_preview']);
        }
        if (isset($post_data['published_at'])) {
            $post->setPublishedAt(new \Datetime($post_data['published_at']));
        }

        if (isset($post_data['uploaded_files']['illustration_original'])) {
            $post->setIllustrationOriginalFile($post_data['uploaded_files']['illustration_original']);
        }
        if (isset($post_data['uploaded_files']['illustration_preview'])) {
            $post->setIllustrationPreviewFile($post_data['uploaded_files']['illustration_preview']);
        }
    }
}
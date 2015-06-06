<?php

namespace MyBlog\Posts;

use MyBlog\Database\Database;
use MyBlog\Http\Request;
use MyBlog\Validation\ValidationErrors;
use MyBlog\Validation\ValidationException;

class PostsManagerMySql extends PostsManagerParent implements PostsManagerInterface
{
    /** @var Database */
    private $db;

    /** @var Request */
    private $request;

    /** @var string */
    private $original_images_dir;

    /** @var string */
    private $preview_images_dir;

    public function __construct($db, $request, $original_images_dir, $preview_images_dir)
    {
        $this->db = $db;
        $this->request = $request;
        $this->original_images_dir = $original_images_dir;
        $this->preview_images_dir = $preview_images_dir;
    }

    public function getAllPosts()
    {
        $statement = $this->db->prepare('SELECT * FROM posts');
        $statement->execute();
        $posts_to_return = [];
        while ($post_data = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $p = new Post();
            $this->hydratePost($p, $post_data);
            $posts_to_return[] = $p;
        }
        return $posts_to_return;
    }

    public function getOnePostById($post_id)
    {
        $query = 'SELECT * FROM posts WHERE id = :id';
        $statement = $this->db->prepare($query);
        $statement->bindValue('id', $post_id);
        $statement->execute();
        $post_data = $statement->fetch(\PDO::FETCH_ASSOC);

        $p = new Post();
        $this->hydratePost($p, $post_data);

        return $p;
    }

    public function getOnePostBySlug($post_slug)
    {
        $query = 'SELECT * FROM posts WHERE slug = :slug';
        $statement = $this->db->prepare($query);
        $statement->bindValue('slug', $post_slug);
        $statement->execute();
        $post_data = $statement->fetch(\PDO::FETCH_ASSOC);

        $p = new Post();
        $this->hydratePost($p, $post_data);

        return $p;
    }

    public function validate(Post $post)
    {
        $validation_errors = new ValidationErrors();

        if (!$post->getTitle()) {
            $validation_errors->registerErrorForField('title', 'Le titre doit être renseigné');
        }

        if (!$post->getSlug()) {
            $validation_errors->registerErrorForField('slug', 'L\'alias doit être renseigné');
        }

        if (!$post->getContentShort()) {
            $validation_errors->registerErrorForField('content_short', 'Le contenu court doit être renseigné');
        }

        if (!$post->getContent()) {
            $validation_errors->registerErrorForField('content', 'Le contenu doit être renseigné');
        }

        if (!$post->getIllustrationOriginal()) {
            if ($post->getIllustrationOriginalFile()) {
                if (!in_array($post->getIllustrationOriginalFile()->getType(), [
                    'image/png', 'image/jpeg', 'image/jpg', 'image/gif'
                ])) {
                    $validation_errors->registerErrorForField('illustration_original',
                        'Le fichier n\'est pas une image valide');
                }
            } else {
                $validation_errors->registerErrorForField('illustration_original',
                    'L\'image d\'illustration doit être renseignée');
            }
        }

        if (!$post->getIllustrationPreview()) {
            if ($post->getIllustrationPreviewFile()) {
                if (!in_array($post->getIllustrationPreviewFile()->getType(), [
                    'image/png', 'image/jpeg', 'image/jpg', 'image/gif'
                ])) {
                    $validation_errors->registerErrorForField('illustration_preview',
                        'Le fichier n\'est pas une image valide');
                }
            } else {
                $validation_errors->registerErrorForField('illustration_preview',
                    'L\'image de prévisualisation doit être renseignée');
            }
        }

        if ($validation_errors->getErrorsCount() > 0) {
            $e = new ValidationException();
            $e->setValidationErrors($validation_errors);
            throw $e;
        }
    }

    public function save(Post $post)
    {
        $this->handleFilesUpload($post);
        $this->insertPostIntoDatabase($post);
    }

    public function removePost(Post $post)
    {
        $statement = $this->db->prepare('DELETE FROM posts WHERE id = :id');
        $statement->bindValue('id', $post->getId());
        $statement->execute();
        $this->removePostFiles($post);
    }

    private function handleFilesUpload(Post $post)
    {
        if ($post->getIllustrationOriginalFile() !== null) {
            $illustration_file_name = $this->request->moveAndRenameUploadedFile(
                $post->getIllustrationOriginalFile(),
                $this->original_images_dir
            );
            if ($illustration_file_name) {
                $post->setIllustrationOriginal($illustration_file_name);
            }
        }

        if ($post->getIllustrationPreviewFile() !== null) {
            $preview_file_name = $this->request->moveAndRenameUploadedFile(
                $post->getIllustrationPreviewFile(),
                $this->preview_images_dir
            );
            if ($preview_file_name) {
                $post->setIllustrationPreview($preview_file_name);
            }
        }
    }

    private function insertPostIntoDatabase(Post $post)
    {
        $query = 'INSERT INTO posts
             (title, slug, content, content_short, published_at, illustration_original, illustration_preview)
             VALUES (:title, :slug, :content, :content_short, :published_at, :illustration_original, :illustration_preview)';
        $statement = $this->db->prepare($query);
        $statement->bindValue('title', $post->getTitle());
        $statement->bindValue('slug', $post->getSlug());
        $statement->bindValue('content', $post->getContent());
        $statement->bindValue('content_short', $post->getContentShort());
        $statement->bindValue('published_at', $post->getPublishedAt('Y-m-d H:i:s'));
        $statement->bindValue('illustration_original', $post->getIllustrationOriginal());
        $statement->bindValue('illustration_preview', $post->getIllustrationPreview());
        $statement->execute();
    }

    private function removePostFiles(Post $post)
    {
        unlink($this->original_images_dir . '/' . $post->getIllustrationOriginal());
        unlink($this->preview_images_dir . '/' . $post->getIllustrationPreview());
    }
}
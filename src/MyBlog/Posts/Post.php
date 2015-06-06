<?php

namespace MyBlog\Posts;

use MyBlog\Http\RequestFile;

class Post
{
    private $id;
    private $title;
    private $slug;
    private $illustration_original;
    private $illustration_preview;
    private $published_at;
    private $content;
    private $content_short;

    /** @var RequestFile */
    private $illustration_original_file;
    /** @var RequestFile */
    private $illustration_preview_file;

    public function __construct()
    {
        $this->published_at = new \Datetime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = intval($id);
    }

    /**
     * @return mixed
     */
    public function getContentShort()
    {
        return $this->content_short;
    }

    /**
     * @param mixed $content_short
     */
    public function setContentShort($content_short)
    {
        $this->content_short = $content_short;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getIllustrationOriginal()
    {
        return $this->illustration_original;
    }

    /**
     * @param mixed $illustration_original
     */
    public function setIllustrationOriginal($illustration_original)
    {
        $this->illustration_original = $illustration_original;
    }

    /**
     * @return mixed
     */
    public function getIllustrationPreview()
    {
        return $this->illustration_preview;
    }

    /**
     * @param mixed $illustration_preview
     */
    public function setIllustrationPreview($illustration_preview)
    {
        $this->illustration_preview = $illustration_preview;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt($format = 'l d F Y')
    {
        return $this->published_at->format($format);
    }

    /**
     * @param mixed $published_at
     */
    public function setPublishedAt(\Datetime $published_at)
    {
        $this->published_at = $published_at;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return RequestFile
     */
    public function getIllustrationOriginalFile()
    {
        return $this->illustration_original_file;
    }

    /**
     * @param mixed $illustration_original_file
     */
    public function setIllustrationOriginalFile(RequestFile $illustration_original_file)
    {
        $this->illustration_original_file = $illustration_original_file;
    }

    /**
     * @return RequestFile
     */
    public function getIllustrationPreviewFile()
    {
        return $this->illustration_preview_file;
    }

    /**
     * @param mixed $illustration_preview_file
     */
    public function setIllustrationPreviewFile(RequestFile $illustration_preview_file)
    {
        $this->illustration_preview_file = $illustration_preview_file;
    }
}
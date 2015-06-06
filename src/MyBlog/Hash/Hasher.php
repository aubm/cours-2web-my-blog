<?php

namespace MyBlog\Hash;

class Hasher implements HasherInterface
{
    public function hash($entry)
    {
        return hash('sha256', $entry);
    }

    public function compare($entry, $hash)
    {
        return $this->hash($entry) === $hash;
    }
}
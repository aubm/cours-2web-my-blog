<?php

namespace MyBlog\Hash;

interface HasherInterface
{
    /**
     * Retourne la valeur hachée de $entry
     *
     * @param string $entry
     * @return string
     */
    public function hash($entry);

    /**
     * Retourne true si la chaîne $entry correspond
     * à la chaine hachée $hash
     *
     * @param string $entry
     * @param string $hash
     * @return boolean
     */
    public function compare($entry, $hash);
}

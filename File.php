<?php

/**
 * Classe File
 *
 * Aquesta classe simplifica l'accés a les propietats dels fitxers
 * i millora la lectura del codi.
 *
 * @author Robert Sallent
 *
 */
class File
{
    /** @var string $path la ruta completa del fitxer */
    private $path;

    /**
     * Constructor
     *
     * @param string $path la ruta completa del fitxer
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Retorna la ruta completa del fitxer.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Retorna el nom del fitxer, incloent l'extensió.
     *
     * @return string
     */
    public function getFilename(): string
    {
        return basename($this->path);
    }
}

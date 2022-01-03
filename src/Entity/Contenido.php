<?php

namespace App\Entity;

use App\Repository\ContenidoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContenidoRepository::class)
 */
class Contenido
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_archivo;

    /**
     * @ORM\ManyToOne(targetEntity=SeccionContenidos::class, inversedBy="contenidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seccionContenidos;

    public function __toString()
    {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUrlArchivo(): ?string
    {
        return $this->url_archivo;
    }

    public function setUrlArchivo(?string $url_archivo): self
    {
        $this->url_archivo = $url_archivo;

        return $this;
    }


    public function getSeccionContenidos(): ?SeccionContenidos
    {
        return $this->seccionContenidos;
    }

    public function setSeccionContenidos(?SeccionContenidos $seccionContenidos): self
    {
        $this->seccionContenidos = $seccionContenidos;

        return $this;
    }
}

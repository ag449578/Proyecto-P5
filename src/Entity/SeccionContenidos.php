<?php

namespace App\Entity;

use App\Repository\SeccionContenidosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=SeccionContenidosRepository::class)
 */
class SeccionContenidos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nombre;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=Asignatura::class, inversedBy="seccionesContenidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $asignatura;

    /**
     * @ORM\OneToMany(targetEntity=Contenido::class, mappedBy="seccionContenidos", orphanRemoval=true)
     */
    private $contenidos;


    public function __construct()
    {
        $this->contenidos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre .' - '. $this->asignatura;
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

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getAsignatura(): ?Asignatura
    {
        return $this->asignatura;
    }

    public function setAsignatura(?Asignatura $asignatura): self
    {
        $this->asignatura = $asignatura;

        return $this;
    }

    /**
     * @return Collection|Contenido[]
     */
    public function getContenidos(): Collection
    {
        return $this->contenidos;
    }

    public function addContenido(Contenido $contenido): self
    {
        if (!$this->contenidos->contains($contenido)) {
            $this->contenidos[] = $contenido;
            $contenido->setSeccionContenidos($this);
        }

        return $this;
    }

    public function removeContenido(Contenido $contenido): self
    {
        if ($this->contenidos->removeElement($contenido)) {
            // set the owning side to null (unless already changed)
            if ($contenido->getSeccionContenidos() === $this) {
                $contenido->setSeccionContenidos(null);
            }
        }

        return $this;
    }

   
}

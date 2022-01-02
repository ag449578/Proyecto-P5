<?php

namespace App\Entity;

use App\Repository\AnnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnoRepository::class)
 */
class Anno
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
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity=Asignatura::class, mappedBy="anno_imparte")
     */
    private $asignaturas;

    /**
     * @ORM\OneToMany(targetEntity=Estudiante::class, mappedBy="anno_cursa")
     */
    private $estudiantes;

    public function __construct()
    {
        $this->asignaturas = new ArrayCollection();
        $this->estudiantes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->descripcion;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Asignatura[]
     */
    public function getAsignaturas(): Collection
    {
        return $this->asignaturas;
    }

    public function addAsignatura(Asignatura $asignatura): self
    {
        if (!$this->asignaturas->contains($asignatura)) {
            $this->asignaturas[] = $asignatura;
            $asignatura->setAnnoImparte($this);
        }

        return $this;
    }

    public function removeAsignatura(Asignatura $asignatura): self
    {
        if ($this->asignaturas->removeElement($asignatura)) {
            // set the owning side to null (unless already changed)
            if ($asignatura->getAnnoImparte() === $this) {
                $asignatura->setAnnoImparte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Estudiante[]
     */
    public function getEstudiantes(): Collection
    {
        return $this->estudiantes;
    }

    public function addEstudiante(Estudiante $estudiante): self
    {
        if (!$this->estudiantes->contains($estudiante)) {
            $this->estudiantes[] = $estudiante;
            $estudiante->setAnnoCursa($this);
        }

        return $this;
    }

    public function removeEstudiante(Estudiante $estudiante): self
    {
        if ($this->estudiantes->removeElement($estudiante)) {
            // set the owning side to null (unless already changed)
            if ($estudiante->getAnnoCursa() === $this) {
                $estudiante->setAnnoCursa(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\EstudiantesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstudiantesRepository::class)
 */
class Estudiantes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Asignatura::class, inversedBy="estudiantes")
     */
    private $asignaturas;

    public function __construct()
    {
        $this->asignaturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        }

        return $this;
    }

    public function removeAsignatura(Asignatura $asignatura): self
    {
        $this->asignaturas->removeElement($asignatura);

        return $this;
    }
}

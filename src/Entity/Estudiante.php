<?php

namespace App\Entity;

use App\Repository\EstudianteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Usuario;

/**
 * @ORM\Entity(repositoryClass=EstudianteRepository::class)
 */
class Estudiante extends Usuario
{
    /**
     * @ORM\ManyToOne(targetEntity=Anno::class, inversedBy="estudiantes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $anno_cursa;

    /**
     * @ORM\OneToMany(targetEntity=Solicitud::class, mappedBy="estudiante")
     */
    private $solicitudes;

    /**
     * @ORM\ManyToMany(targetEntity=Asignatura::class, mappedBy="estudiantes")
     */
    private $asignaturas;

    public function __construct()
    {
        $this->solicitudes = new ArrayCollection();
        $this->asignaturas = new ArrayCollection();
    }

    public function getAnnoCursa(): ?Anno
    {
        return $this->anno_cursa;
    }

    public function setAnnoCursa(?Anno $anno_cursa): self
    {
        $this->anno_cursa = $anno_cursa;

        return $this;
    }

    /**
     * @return Collection|Solicitud[]
     */
    public function getSolicitudes(): Collection
    {
        return $this->solicitudes;
    }

    public function addSolicitude(Solicitud $solicitude): self
    {
        if (!$this->solicitudes->contains($solicitude)) {
            $this->solicitudes[] = $solicitude;
            $solicitude->setEstudiante($this);
        }

        return $this;
    }

    public function removeSolicitude(Solicitud $solicitude): self
    {
        if ($this->solicitudes->removeElement($solicitude)) {
            // set the owning side to null (unless already changed)
            if ($solicitude->getEstudiante() === $this) {
                $solicitude->setEstudiante(null);
            }
        }

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
            $asignatura->addEstudiante($this);
        }

        return $this;
    }

    public function removeAsignatura(Asignatura $asignatura): self
    {
        if ($this->asignaturas->removeElement($asignatura)) {
            $asignatura->removeEstudiante($this);
        }

        return $this;
    }
}

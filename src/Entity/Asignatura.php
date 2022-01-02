<?php

namespace App\Entity;

use App\Repository\AsignaturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AsignaturaRepository::class)
 */
class Asignatura
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
    private $url_imagen;

    /**
     * @ORM\Column(type="integer")
     */
    private $semestre;

    /**
     * @ORM\Column(type="integer")
     */
    private $horas_clase;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad_temas;

    /**
     * @ORM\Column(type="boolean")
     */
    private $es_curricular;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departamento;

    /**
     * @ORM\ManyToOne(targetEntity=Anno::class, inversedBy="asignaturas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $anno_imparte;

    /**
     * @ORM\OneToMany(targetEntity=Profesor::class, mappedBy="asignatura")
     */
    private $profesores;

    public function __construct()
    {
        $this->profesores = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }
    

    public function getId(): ?string
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

    public function getUrlImagen(): ?string
    {
        return $this->url_imagen;
    }

    public function setUrlImagen(?string $url_imagen): self
    {
        $this->url_imagen = $url_imagen;

        return $this;
    }

    public function getSemestre(): ?int
    {
        return $this->semestre;
    }

    public function setSemestre(int $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getHorasClase(): ?int
    {
        return $this->horas_clase;
    }

    public function setHorasClase(int $horas_clase): self
    {
        $this->horas_clase = $horas_clase;

        return $this;
    }

    public function getCantidadTemas(): ?int
    {
        return $this->cantidad_temas;
    }

    public function setCantidadTemas(int $cantidad_temas): self
    {
        $this->cantidad_temas = $cantidad_temas;

        return $this;
    }

    public function getEsCurricular(): ?bool
    {
        return $this->es_curricular;
    }

    public function setEsCurricular(bool $es_curricular): self
    {
        $this->es_curricular = $es_curricular;

        return $this;
    }

    public function getDepartamento(): ?string
    {
        return $this->departamento;
    }

    public function setDepartamento(string $departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function getAnnoImparte(): ?Anno
    {
        return $this->anno_imparte;
    }

    public function setAnnoImparte(?Anno $anno_imparte): self
    {
        $this->anno_imparte = $anno_imparte;

        return $this;
    }

    /**
     * @return Collection|Profesor[]
     */
    public function getProfesores(): Collection
    {
        return $this->profesores;
    }

    public function addProfesore(Profesor $profesore): self
    {
        if (!$this->profesores->contains($profesore)) {
            $this->profesores[] = $profesore;
            $profesore->setAsignatura($this);
        }

        return $this;
    }

    public function removeProfesore(Profesor $profesore): self
    {
        if ($this->profesores->removeElement($profesore)) {
            // set the owning side to null (unless already changed)
            if ($profesore->getAsignatura() === $this) {
                $profesore->setAsignatura(null);
            }
        }

        return $this;
    }

}

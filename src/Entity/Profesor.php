<?php

namespace App\Entity;

use App\Repository\ProfesorRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Usuario;

/**
 * @ORM\Entity(repositoryClass=ProfesorRepository::class)
 */
class Profesor extends Usuario
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categoria_docente;

    /**
     * @ORM\ManyToOne(targetEntity=Asignatura::class, inversedBy="profesores")
    */
    private $asignatura;


    public function getCategoriaDocente(): ?string
    {
        return $this->categoria_docente;
    }

    public function setCategoriaDocente(string $categoria_docente): self
    {
        $this->categoria_docente = $categoria_docente;

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


}

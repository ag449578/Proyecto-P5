<?php

namespace App\Entity;

use App\Repository\ProfesorRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Usuario;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProfesorRepository::class)
 */
class Profesor extends Usuario
{
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $categoria_docente;

    /**
     * @ORM\ManyToOne(targetEntity=Asignatura::class, inversedBy="profesores")
     * @Assert\NotBlank()
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

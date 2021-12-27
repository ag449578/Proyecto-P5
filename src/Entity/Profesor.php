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

    public function getCategoriaDocente(): ?string
    {
        return $this->categoria_docente;
    }

    public function setCategoriaDocente(string $categoria_docente): self
    {
        $this->categoria_docente = $categoria_docente;

        return $this;
    }
}

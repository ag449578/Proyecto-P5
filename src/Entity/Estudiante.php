<?php

namespace App\Entity;

use App\Repository\EstudianteRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Usuario;

/**
 * @ORM\Entity(repositoryClass=EstudianteRepository::class)
 */
class Estudiante extends Usuario
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $anno_cursa;

    public function getAnnoCursa(): ?string
    {
        return $this->anno_cursa;
    }

    public function setAnnoCursa(string $anno_cursa): self
    {
        $this->anno_cursa = $anno_cursa;

        return $this;
    }
}

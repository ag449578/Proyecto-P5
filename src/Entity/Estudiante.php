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
     * @ORM\ManyToOne(targetEntity=Anno::class, inversedBy="estudiantes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $anno_cursa;

    public function getAnnoCursa(): ?Anno
    {
        return $this->anno_cursa;
    }

    public function setAnnoCursa(?Anno $anno_cursa): self
    {
        $this->anno_cursa = $anno_cursa;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AdministradorRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Usuario;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=AdministradorRepository::class)
 */
class Administrador extends Usuario
{
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $telefono_emergencia;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $centro;

    public function getId(): ?int
    {
        return parent::getId();
    }

    public function getTelefonoEmergencia(): ?int
    {
        return $this->telefono_emergencia;
    }

    public function setTelefonoEmergencia(int $telefono_emergencia): self
    {
        $this->telefono_emergencia = $telefono_emergencia;

        return $this;
    }

    public function getCentro(): ?string
    {
        return $this->centro;
    }

    public function setCentro(string $centro): self
    {
        $this->centro = $centro;

        return $this;
    }
}

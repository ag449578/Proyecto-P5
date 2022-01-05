<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('rol', [$this, 'rolFormat']),
        ];
    }

    public function rolFormat(string $val): string
    {
        switch ($val) {
            case 'ROLE_USER':
                return 'Estudiante';
                break;
            case 'ROLE_TEACHER':
                return 'Profesor';
                break;
            case 'ROLE_ADMIN':
                return 'Administrador';
                break;
            
            default:
                return '';
                break;
        }
    }
}
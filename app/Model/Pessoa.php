<?php
namespace MateusVBC\Magazord_Backend\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table(name: 'pessoa')]
class Pessoa
{
    #[Id]
    #[Column(type: Types::INTEGER, insertable: false)]
    #[GeneratedValue]
    private int $id;
    #[Column(length: 50)]
    private string $nome;
    #[Column(length: 11)]
    private string $cpf;
}
<?php
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
    private String $nome;
    #[Column(length: 11)]
    private String $cpf;
}
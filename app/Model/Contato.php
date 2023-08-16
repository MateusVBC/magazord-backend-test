<?php
namespace MateusVBC\Magazord_Backend\App\Model;

use Doctrine\ORM\Mapping\Column;
use MateusVBC\Magazord_Backend\Core\Model;

#[Entity]
#[Table(name: 'pessoa')]
class Pessoa extends Model
{
    #[Column(length: 50)]
    private string $nome;
    #[Column(length: 11)]
    private string $cpf;

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setCpf(string $cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * Retorna um array com o nome da chave no banco e seu valor
     */
    public function getKey(): array
    {
        return ['id' => $this->id];
    }
}
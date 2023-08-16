<?php
namespace MateusVBC\Magazord_Backend\App\Model;

use Doctrine\ORM\Mapping\Column;
use MateusVBC\Magazord_Backend\Core\Model;

#[Entity]
#[Table(name: 'contato')]
class Contato extends Model
{
    #[Column(length: 50)]
    private string $descricao;
    private int $tipo;
    private int $idPessoa;

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getTipo(): int
    {
        return $this->tipo;
    }

    public function getIdPessoa(): string
    {
        return $this->idPessoa;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setIdPessoa(int $idPessoa)
    {
        $this->idPessoa = $idPessoa;
    }

    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    public function setTipo(int $tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Retorna um array com o descricao da chave no banco e seu valor
     */
    public function getKey(): array
    {
        return ['id' => $this->id];
    }
}
<?php
namespace MateusVBC\Magazord_Backend\Core;

use PDO;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;
use MateusVBC\Magazord_Backend\Core\Config;

abstract class Model
{

    #[Id]
    #[Column(type: Types::INTEGER, insertable: false)]
    #[GeneratedValue]
    private int $id;
    private Connection $connection;
    private QueryBuilder $queryBuilder;

    function __construct()
    {
        $dbParams = [
            'driver' => Config::ORM_DRIVER,
            'host' => Config::DB_HOST,
            'charset' => Config::DB_CHARSET,
            'user' => Config::DB_USER,
            'password' => Config::DB_PASSWORD,
            'dbname' => Config::DB_NAME,
        ];

        $this->connection = DriverManager::getConnection($dbParams, ORMSetup::createAttributeMetadataConfiguration([__FILE__], false));
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public abstract function getKey(): array;

    public function getId(): int|null
    {
        return isset($this->id) ? $this->id : null;
    }

    /**
     * Atualiza as informações do modelo atual com as informações do banco
     */
    public function refresh(): bool
    {
        $query = $this->getQueryBuilder()->select('*')->from($this->getClassName());
        $this->addWhereKeyToQuery($query);
        if ($query->executeQuery()) {
            $valorModelo = $query->fetchAssociative();
            if (!is_array($valorModelo)) {
                return false;
            }
            foreach ($valorModelo as $attribute => $value) {
                $this->{'set' . $attribute}($value);
            }
        }
        return true;
    }

    /**
     * Exclui um modelo do banco
     */
    public function delete()
    {
        $query = $this->getQueryBuilder()->delete($this->getClassName());
        $this->addWhereKeyToQuery($query)->executeQuery();
    }

    /**
     * Insere o modelo atual no banco
     */
    public function insert()
    {
        $reflectionClass = new \ReflectionClass(get_class($this));
        $atts = $reflectionClass->getProperties();
        $childAtt = [];
        foreach ($atts as $att) {
            if ($att->class === get_class($this)) {
                $childAtt[] = $att->getName();
            }
        }
        $insertArray = [];
        foreach ($childAtt as $att) {
            $insertArray[$att] = '\'' . $this->{'get'.$att}(). '\'';
        }
        $this->getQueryBuilder()->insert($this->getClassName())->values($insertArray)->executeQuery();
    }

    /**
     * Atualiza o modelo atual no banco
     */
    public function update()
    {

    }

    /**
     * Retorna o QueryBuilder
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    /**
     * Retorna o nome da classe atual
     */
    private function getClassName(): string
    {
        return str_replace('MateusVBC\\Magazord_Backend\\App\\Model\\', '', get_class($this));
    }

    /**
     * Adiciona os where com a chave do modelo atual à um QueryBuilder
     */
    private function addWhereKeyToQuery(QueryBuilder $query): QueryBuilder
    {
        foreach ($this->getKey() as $dbname => $value) {
            $query->andWhere($dbname . ' = ' . $value);
        }
        return $query;
    }
}
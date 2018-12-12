<?php

namespace activerecord\Abstracts;

use activerecord\Helpers\PDOConnect;
use activerecord\Helpers\PDOEasy;
use activerecord\Interfaces\Model;

abstract class AbstractActiveRecord implements Model
{
    /**
     * Объект для работы с БД
     * @var PDOEasy
     */
    protected $db;

    /**
     * Идентификатор
     * @var int
     */
    protected $id;

    /**
     * Имя таблицы
     * @var string
     */
    protected $tableName;

    public function __construct()
    {
        $this->db = PDOConnect::connectPDO();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function setId(int $id): Model
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return bool
     */
    abstract public function save(): bool;

    /**
     * @param array $attr
     * @return bool
     */
    protected function update(array $attr): bool
    {
        $this->db->update($this->tableName, $attr, ['id' => $this->id]);

        return $this->db->isExistLastQuery();
    }

    /**
     * @param array $attr
     * @return bool
     */
    protected function insert(array $attr): bool
    {
        $this->db->insert($this->tableName, $attr);

        return $this->db->isExistLastQuery();
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        $this->db->delete($this->tableName, ['id' => $this->id]);

        return $this->db->isExistLastQuery();
    }

    /**
     * @return mixed|null
     */
    public function all()
    {
        return $this->db->selectAll($this->tableName);
    }

    /**
     * @return mixed|null
     */
    public function get()
    {
        return $this->db->selectRow($this->tableName, ['id' => $this->id]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->db->selectCount($this->tableName);
    }
}
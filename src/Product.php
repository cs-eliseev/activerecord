<?php

namespace activerecord;

use activerecord\Interfaces\Model;
use activerecord\Abstracts\AbstractActiveRecord;

/**
 * Table product:
 * id int
 * title string
 * price int
 * discount int
 * description string
 */

class Product extends AbstractActiveRecord implements Model
{
    /**
     * Имя таблицы
     * @var string
     */
    protected $tableName = 'product';

    /**
     * Наименование
     * @var string
     */
    private $title;

    /**
     * Цена
     * @var int
     */
    private $price;

    /**
     * Скидка
     * @var int
     */
    private $discount;

    /**
     * Описание
     * @var string
     */
    private $description;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param int $price
     * @return Product
     */
    public function setPrice(int $price): Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @param int $discount
     * @return Product
     */
    public function setDiscount(int $discount): Product
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $attr = [
            'title' => $this->title,
            'price' => $this->price,
            'discount' => $this->discount,
            'description' => $this->description
        ];

        if (isset($this->id)) $attr['id'] = $this->id;

        return empty($this->id) ? $this->insert($attr) : $this->update($attr);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $attr = [];

        if (isset($this->title)) $attr['title'] = $this->title;
        if (isset($this->price)) $attr['price'] = $this->price;
        if (isset($this->discount)) $attr['discount'] = $this->discount;
        if (isset($this->description)) $attr['description'] = $this->description;

        return $this->db->selectCount($this->tableName, $attr);
    }

    /**
     * @return mixed|null
     */
    public function get()
    {
        $data = parent::get();

        if (!is_null($data)) {
            $this->title = $data->title;
            $this->price = $data->price;
            $this->discount = $data->discount;
            $this->description = $data->description;
        }

        return $data;
    }
}

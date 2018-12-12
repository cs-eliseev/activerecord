<?php

namespace activerecord\Interfaces;

interface Model
{
    /**
     * @return bool
     */
    public function save();

    /**
     * @return bool
     */
    public function delete(): bool;

    public function all();

    public function get();

    /**
     * @return int
     */
    public function count(): int;
}
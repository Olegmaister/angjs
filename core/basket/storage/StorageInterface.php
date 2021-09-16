<?php
namespace core\basket\storage;

interface StorageInterface
{
    public function load();
    public function save($items);
}
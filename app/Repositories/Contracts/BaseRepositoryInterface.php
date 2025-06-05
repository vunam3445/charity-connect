<?php 
namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function findById(string $id);
    public function getAll();
    public function search(string $keyword);
    // public function create(array $data);
    // public function update(string $id, array $data);
    // public function delete(string $id);
}
<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFilterData($request)
    {
        return $this->repository->getFilterData($request);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }



}
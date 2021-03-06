<?php
namespace App\Repositories;

interface ProductInterface{

    public function getFilterData($allRequest);

    public function getById($id);

    public function create(array $data);
    
    public function update(array $data, $id);

    public function delete($id);

}
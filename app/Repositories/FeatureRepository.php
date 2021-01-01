<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeatureRepository implements FeatureInterface 
{

    protected $db;

    public function __construct()
    {
        $this->db = DB::table('features');
    }

    public function getAll()
    {
       return $this->db->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function getById($id)
    {
       return $this->db->find($id);
    }

    public function create(array $data)
    {
        $featureId = $this->db->insertGetId([
            'marka'  => $data['product_marka'],
            'model'  => $data['product_model'],
            'size'   => $data['product_size']
        ]);

        return $featureId;
    }

    public function update(array $data, $id)
    {
        $update = $this->db->where('id', $id)->update([
                     'marka'  => $data['product_marka'],
                     'model'  => $data['product_model'],
                     'size'   => $data['product_size']
                    ]);
        return $update;            
    }

    public function delete($id)
    {
        return  $this->db->where('id', $id)->delete(); 
    }



}
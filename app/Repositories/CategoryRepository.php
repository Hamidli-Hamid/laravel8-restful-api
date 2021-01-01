<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryInterface 
{

    protected $db;

    public function __construct()
    {
        $this->db = DB::table('categories');
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
        $categoryId = $this->db->insertGetId([
            'title' => $data['category_title'],
            'slug'  => Str::slug($data['category_title']),
            'created_at' => now()
        ]);

        return $categoryId;
    }

    public function update(array $data, $id)
    {
        $update = $this->db->where('id', $id)->update([
                     'title' => $data['category_title'],
                     'slug'  => Str::slug($data['category_title']),
                     'updated_at' => now()
                    ]);
        return $update;            
    }

    public function delete($id)
    {
        return  $this->db->where('id', $id)->delete();
    }



}
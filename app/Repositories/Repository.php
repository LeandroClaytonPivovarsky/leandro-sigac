<?php

namespace App\Repositories;

use Exception;

class Repository{
    
    protected $model;

    protected function __construct(object $model) {
        $this->model = $model;
    }

    public function selectAll()
    {
        return $this->model->All();
    }

    public function selectAllWith(array $orm)
    {
        return $this->model::with($orm)->get();
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findDeletedById(int $id)
    {
        return $this->model->onlyTrashed()->find($id);
    }

    public function findFirstById(int $id)
    {
        return $this->model->find($id)->first();
    }

    public function findByColumn($column, $value) 
    {
        return $this->model->where($column, $value)->get();
        
    }

    public function findFirstByColumn($column, $value) 
    {
        return $this->model->where($column, $value)->get()->first();
    }

    public function save($obj)
    {
        try {
            $obj->save();
            return $obj;
        } catch (Exception $e) {
            dd($e);
        }
        return false;
    }

    public function saveAndReturnId($obj)
    {
        try {
            $obj->save();
        } catch (Exception $e) {
            dd($e);
        }
        return false;
    }

    public function delete($id)
    {
        $obj = $this->findById($id);
        if(isset($obj)){

            try {
                
                $obj->delete();
                return true;
            } catch (Exception $e) {

                dd($e);
            }
        }
        return false;
    }

    public function restore($id)
    {
        $obj = $this->findDeletedById($id);
        if(isset($obj)){
            try {
                $obj->restore();
                return true;
            } catch (Exception $e) {
                dd($e);
            }
        }
        return false;
    }
}
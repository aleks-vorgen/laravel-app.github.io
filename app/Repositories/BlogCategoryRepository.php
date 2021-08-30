<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */

class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass() {
        return Model::class;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id) {
        return $this->startConditions()->find($id);
    }

    /**
     * @return mixed
     */
    public function getForComboBox() {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
            ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();
        return $result;
    }

    /**
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null) {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this->startConditions()->select($columns)->paginate($perPage);
        return $result;
    }
}

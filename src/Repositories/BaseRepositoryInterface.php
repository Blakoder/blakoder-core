<?php

namespace Controlla\Core\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface BaseServiceInterface
{
    /**
     * Get paginated results
     */
    public function getAllPaginated(Request $request, int $pageSize = 20): mixed;

    /**
     * Find models by attributes
     *
     * @param  mixed  $id
     * @return Model|null
     */
    public function find(int $id);

    /**
     * Find or fail the model
     *
     * @param  mixed  $id
     * @return mixed
     */
    public function findOrFail(int $id);

    /**
     * Return all items
     *
     * @return Collection|null
     */
    public function all();

    /**
     * Create model
     *
     * @return Model|null
     */
    public function create(array $data);

    /**
     * Update a model
     *
     * @param  int  $id
     * @return bool|mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete a model
     *
     * @param  int|Model  $id
     */
    public function delete(int $id);

    /**
     * multiple delete
     *
     * @return mixed
     */
    public function destroy(array $ids);
}

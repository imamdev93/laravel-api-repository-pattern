<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function show($id)
    {
        return $this->user->findOrFail($id);
    }

    public function paginate($limit)
    {
        return $this->user->paginate($limit);
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->user->findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return $this->user->findOrFail($id)->delete();
    }

}

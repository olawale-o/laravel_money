<?php
    namespace App\Repositories\Eloquent;
    
    use App\Repositories\EloquentRepositoryInterface;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder as Builder;
    use App\Models\User;

    class BaseRepository implements EloquentRepositoryInterface
    {

        protected $model;

        public function __construct(Model $model) {
            $this->model = $model;
        }


        public function create(array $attributes) : Model
        {
            return $this->model->create($attributes);
        }

        public function find($attribute) : ?Model
        {
            return $this->model->find($attribute);
        }

        public function where(string $attribute, string $value) : Builder
        {   
            return $this->model->where($attribute, $value);
        }
    }
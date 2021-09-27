<?php 

    namespace App\Repositories\Eloquent;

    use App\Repositories\UserRepositoryInterface;
    use App\Repositories\Eloquent\BaseRepository;
    use Illuminate\Database\Eloquent\Builder as Builder;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Collection;

    class UserRepository extends BaseRepository implements UserRepositoryInterface
    {

        protected $model;

        public function __construct(User $model)
        {
            $this->model = $model;
            parent::__construct($model);
        }

        public function where(string $attribute, string $value) : Builder
        {   
            return $this->model->where($attribute, $value);
        }

        public function findOrFail(int $attribute) : ?Model
        {   
            return $this->model->findOrFail($attribute);
        }

        public function create(array $attributes) : Model
        {
            return $this->model->create($attributes);
        }
    }
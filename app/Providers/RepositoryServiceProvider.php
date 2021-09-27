<?php
  namespace App\Providers;

  use Illuminate\Support\ServiceProvider;
  use App\Repositories\EloquentRepositoryInterface;
  use App\Repositories\UserRepositoryInterface;
  use App\Repositories\Eloquent\BaseRepository;
  use App\Repositories\Eloquent\UserRepository;
  use App\Repositories\PasswordInterface;
  use App\Repositories\Password\Password;
  
  class RepositoryServiceProvider extends ServiceProvider
  {
      /**
       * Register services.
       *
       * @return void
       */
      public function register()
      {
          //
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PasswordInterface::class, Password::class);
      }
  
      /**
       * Bootstrap services.
       *
       * @return void
       */
      public function boot()
      {
          //
      }
  }
## notes

### filling database with fake data

In order to have some data during development it is possible to fill db with fake data.

Seeders can be used only in dev. environment, like so: **APP_ENV=local**

Seed database with objects from _seeders_.

`php artisan db:seed`

Read more: https://laravel.com/docs/9.x/seeding#running-seeders

Seeders may use _Eloquent: Factories_: https://laravel.com/docs/9.x/eloquent-factories

### Factories naming convention

https://laravel.com/docs/9.x/eloquent-factories#factory-and-model-discovery-conventions

_The `HasFactory` trait's `factory` method will use conventions to determine the proper factory for the model the trait
is
assigned to. Specifically, the method will look for a factory in the `Database\Factories` namespace that has a class
name
matching the model name and is suffixed with `Factory`._

So `App\Models\User::class` factory will be: `Database\Factories\UserFactory::class`

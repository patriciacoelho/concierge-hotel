<h1 align="center">Concierge</h1>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Concierge is a web application that allows users to view hotel room prices based on selected dates.

## Running the project

- Clone project than start the container

```
sail up -d
```

- Create a test user to API auth required routes by executing
```
sail artisan tin
```
and paste the follow code (change `<YOUR-PASSWORD>` for whatever you want, such as the name and email):

```
    User::factory()->create([
        'name' => 'Jane Doe',
        'email' => 'jane.doe@masterzeye.com',
        'password' =>  Hash::make('<YOUR-PASSWORD>'),
    ]);
```

- Compiles and hot-reloads for development
```
sail npm run dev
```

- Open `http://localhost/` in a web browser to see it


P.S.: To easily test the application you can run seeders `sail artisan db:seed` than on the web UI set filter "Check-in" to 30 days from now. You can also run factories or add prices, rooms and hotels by API.  

## License

This project is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

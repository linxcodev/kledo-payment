# Welcome to Kledopayment :D

## Configuration

Clone & Install Depedency
```
git clone https://github.com/linxcodev/kledo-payment.git

composer install
```

Copy .env.example to .env, edit
```
DB_DATABASE=namedatabase
DB_USERNAME=username
DB_PASSWORD=passwd
```

Migrate
```
php artisan migrate --seed
```

Run Queue with pusher
```
php artisan queue:work
```

Enjoy.

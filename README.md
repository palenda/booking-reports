## How to install

Create `.env` file from `.env.example` file:
```shell
cp .env.example .env
```

Run command to install dependencies:
```shell
composer install
```

Run Laravel sail:
```shell
./vendor/bin/sail up -d
```

Run command to install dependencies inside docker:
```shell
./vendor/bin/sail composer install
```

Run next command to generate APP_KEY in .env file. You should do it only once.
```shell
./vendor/bin/sail artisan key:generate
```

To run database migrations and set up the data use:
```shell
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed

# or use 
./vendor/bin/sail artisan migrate --seed
```

To run command for creating booking statuses use:
```shell
./vendor/bin/sail artisan app:set-booking-statuses
```

To refresh database with the data use:
```shell
./vendor/bin/sail artisan migrate:refresh --seed
```

Build front-end:
```shell
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

Follow the link [localhost](http://localhost/)

## How to set up

- `git clone https://github.com/litecoding/aertest.git`
- `cd aertest`
- `docker run --rm -v $(pwd):/app composer install`
- `sudo chown -R $USER:$USER ~/aertest`
- `docker-compose up -d`
- `cp .env.example .env`
- `docker-compose exec app php artisan key:generate`
- `docker-compose exec app php artisan config:cache`
- `docker-compose exec app php artisan migrate`
- `docker-compose exec app php artisan db:seed`
- `docker-compose exec app php artisan jwt:secret`

## Create user

- Open `http://127.0.0.1/register`
- Register new user

## How to search

- Available airports ABC, DEF, GHI, JKL, MNO, PQR, STU, VWX, YZ
- Available dates between today and +3 days

###web
- Open `http://127.0.0.1/search`


###api
- login with your email and password `http://127.0.0.1/api/auth/login`
- send POST query with bearer token to `http://127.0.0.1/api/search`

example
```
{
    "searchQuery": {
        "departureAirport": "ABC",
        "arrivalAirport": "DEF",
        "departureDate": "2021-04-14"
    }
}
```

This app is a solution to the ONErpm full-stack-challenge. Check demo in: https://onerpm-challenge.web.app/.
## Run locally
### Backend
Set the follosing variables in a .env file stored in the root of backend folder:
```bash
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=$DB_HOST
DB_PORT=$DB_PORT
DB_DATABASE=$DB_DATABASE
DB_USERNAME=$DB_USERNAME
DB_PASSWORD=$DB_PASSWORD

```

Then run the following commands:

```bash
#creates and populates tables
php artisan migrate:fresh --seed

#run local server
php artisan serve
```
### Frontend

Run the following commands:
```bash
#install packages
npm install

#run application locally
ng serve
```

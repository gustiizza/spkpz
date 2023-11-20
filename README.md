## HOW TO INSTALL
```
git clone https://github.com/gustiizza/spkpz.git
```
```
composer install
```
```
cp .env.example .env
```
```
php artisan key:generate
```
```
npm install
```
```
npm run build
```
```
php artisan migrate:fresh --seed
```
## LOGIN
- operator
- 123123123
## FIX ERROR
If cant zip composer install, Open xampp control panel>Apache>config>php.ini>edit the config delete ';' from ';extension=zip' 

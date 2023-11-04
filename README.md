SISTEM PENDUKUNG KEPUTUSAN PENENTUAN PENERIMA ZAKAT
HOW TO INSTALL
- git clone https://github.com/gustiizza/spkpz.git
- composer install
    If cant zip composer install, Open xampp control panel>Apache>config>php.ini>Fix the config from ';extension=zip' delete ';'
- cp .env.example .env
- php artisan key:generate
- npm install
- php artisan migrate:fresh --seed
Login
operator:123123213 

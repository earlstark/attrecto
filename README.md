<b>Install: (http server share directory)</b><br>
git clone https://github.com/earlstark/attrecto.git<br> 
cd attrecto<br>
composer update<br>
npm install<br>
npm run dev<br>
.env fájl létrehozás a .env.example fájlból
php artisan migrate<br>
php artisan db:seed<br>
<br>
vhost (/apache/conf/extra/httpd-vhosts.conf) /attrecto/public<br>
<br>
<b>Bejelentkezés:</b><br>
admin: fressup@gmail.com adminadmin1<br>
<br>
Működés<br>
-Felhasználók CRUD-al szerkeszthetők<br>
-A TODO rekordokat AJAX-al lehet kezelni<br>
-Bejelentkezés után szerkesztjhető a profilkép<br>
-a listában levő profilképre kattintva szerkeszthető a felhasználó profilképe<br>

Ha valamiért nem menne a db seedelése feltöltöttem dump-ban is (dump.sql)

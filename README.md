# phpBox
Proyecto inspirado en Dropbox realizado con PHP.

## Reto del proyecto
------
Se deberá crear una aplicación web que posibilite a distintos usuarios de forma privada, con un acceso de login de usuario, el almacenamiento de diversos archivos, para tenerlos almacenados en la nube en su cuenta.

Dentro de la cuenta existirán opciones para:

- crear carpetas.

- explorar las carpetas para ver los archivos subidos y subir archivos en las distintas ubicaciones de la cuenta.

- hacer backups de los archivos, pudiendo seleccionar varios. Estos backups se irán conservando en el tiempo y se encontrarán en una carpeta específica de backups.

- Generar informe PDF. Generará un informe con un encabezado de usuario, y un listado de carpetas y archivos que se encuentran, así como un recuento del número de archivos totales y almacenamiento ocupado en la cuenta. Estos archivos se irán almacenando en una carpeta específica para su fin.

Los archivos se deberán mostrar en formato listado, como hipervínculos, y las carpetas aparecerán diferenciadas por un icono en su margen izquierda.

Cada archivo en su margen derecho aparecerá la información de cuando fue subido o creado, y opciones para borrado, selección múltiple para backup y renombrado. Tras este listado de los archivos se mostrarán siempre los listados de las carpetas backup y pdf que siempre tendrá cada espacio de usuario y que no serán borrables.

En la navegación se deberá mostrar la ubicación y posibilidad de navegar a través de las carpetas superiores con el formato breadcrumb.

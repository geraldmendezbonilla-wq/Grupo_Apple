# Configuración de Grupo Apple con XAMPP

Esta guía explica cómo ejecutar el sistema localmente en Windows con XAMPP y CodeIgniter 4.

## Requisitos

- XAMPP con Apache y MySQL/MariaDB.
- PHP 8.1 o superior.
- Composer.
- Extensiones PHP `intl`, `mbstring` y `mysqli` habilitadas.

## Copiar el proyecto

1. Descomprime el ZIP del proyecto.
2. Copia la carpeta `Grupo_Apple-main` dentro de `C:\\xampp\\htdocs\\`.
3. Comprueba que `composer.json`, `spark`, `app/` y `public/` estén en la raíz de esa carpeta.

## Iniciar los servicios

Abre XAMPP Control Panel e inicia Apache y MySQL. Si alguno no inicia, revisa si otro programa está usando los puertos 80, 443 o 3306.

## Instalar dependencias

Abre una terminal en la carpeta del proyecto y ejecuta:

```bash
composer install
```

Este comando crea la carpeta `vendor/`. No la descargues de otra aplicación ni la edites manualmente.

## Habilitar extensiones PHP

En XAMPP, abre **Apache → Config → PHP (php.ini)**. Busca `;extension=intl`, `;extension=mbstring` y `;extension=mysqli`, elimina el punto y coma inicial de las líneas existentes y guarda. Reinicia Apache para aplicar los cambios.

## Crear la base de datos

1. Abre `http://localhost/phpmyadmin`.
2. Crea una base de datos llamada `db_2026_1s_6b`.
3. Selecciónala, entra en **Importar** y elige el archivo `database.sql` de la raíz del proyecto.

## Configurar el entorno

Copia el archivo `env` de la raíz y nombra la copia `.env`. Configura estos valores de acuerdo con tu instalación:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = db_2026_1s_6b
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Si tu usuario MySQL tiene contraseña, escríbela en `database.default.password`. No subas contraseñas reales a GitHub.

## Ejecutar en desarrollo

Con la terminal ubicada en la raíz del proyecto, ejecuta:

```bash
php spark serve
```

Luego visita `http://localhost:8080/`. Si PHP o Composer no se reconocen como comandos, agrega la carpeta PHP de XAMPP y Composer al `PATH` de Windows, o usa sus rutas completas.

## Ejecutar mediante Apache

Como alternativa, inicia Apache en XAMPP y abre `http://localhost/Grupo_Apple-main/public/`. En ese caso, cambia `app.baseURL` en `.env` a `http://localhost/Grupo_Apple-main/public/`.

## Diagnóstico de errores

- **Falta `intl`:** habilita `extension=intl` en el `php.ini` que usa Apache y reinícialo.
- **Error de conexión:** confirma que MySQL esté iniciado y que el nombre, usuario, contraseña y puerto coincidan con `.env`.
- **Pantalla “Whoops!”:** revisa el archivo más reciente en `writable/logs/`. Mantén `CI_ENVIRONMENT = development` solo en el entorno local; usa producción al publicar el sitio.
- **Faltan clases:** ejecuta `composer install` desde la raíz.

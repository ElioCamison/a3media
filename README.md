# A3Media Project

Este proyecto es una aplicación web desarrollada con el framework Slim en PHP. La aplicación permite la gestión de datos de programación a través de una API REST, que incluye funcionalidades de creación, lectura, actualización y eliminación (CRUD).

## Estructura del Proyecto
El proyecto sigue una estructura organizada, dividiendo la lógica en módulos y respetando los principios de separación de responsabilidades. La estructura principal del proyecto es la siguiente:

```bash
/public               # Archivos públicos y punto de entrada (index.php)
/src
  /config             # Configuración de dependencias
  /controllers        # Controladores de la aplicación (ej. HomeController.php)
  /database           # Lógica de acceso a datos y conexión a la base de datos
  /templates          # Plantillas para la interfaz de usuario
  /utils              # Clases auxiliares y utilidades (ej. ResponseBuilder.php)
/vendor               # Dependencias instaladas por Composer
.env                  # Variables de entorno
composer.json         # Archivo de configuración de Composer
```

## Instalación

### 1. Clonar el repositorio:

```bash
git clone https://github.com/usuario/a3media.git
cd a3media
```

### 2. Instalar las dependencias: 
Asegúrate de tener Composer instalado. Luego, ejecuta:

```bash
composer install
```

### 3. Configurar las variables de entorno: 
Renombra el archivo .env.example a .env y configura las variables necesarias (como las credenciales de la base de datos).

### 4. Configurar la base de datos:
Importa el esquema de la base de datos y ajusta los detalles de conexión en `.env`. 

> **Nota:** Asegúrate de que la tabla de la base de datos incluya un campo `ID`. Si la tabla no tiene un campo `ID`, puedes agregarlo ejecutando la siguiente consulta SQL:

```sql
ALTER TABLE nombre_de_tu_tabla ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY;
``` 

### 5. Ejecutar el servidor de desarrollo: 
Puedes utilizar el servidor integrado de PHP para pruebas locales:

```bash
php -S 127.0.0.1:8000 -t public
```

## Uso
### Endpoints
La aplicación ofrece los siguientes endpoints:

- **GET** `/programacion-data`: Obtener todos los datos de programación.
- **GET** `/programacion/{id}`: Obtener un dato específico de programación por ID.
- **POST** `/programacion`: Crear un nuevo registro de programación.
- **POST** `/programacion/{id}`: Actualizar un registro de programación existente.
- **DELETE** `/programacion/{id}`: Eliminar un registro de programación.

### Ejemplo de Petición
```bash
curl -X GET http://127.0.0.1:8000/programacion-data
```

## Configuración de Dependencias

Las dependencias se configuran en el archivo src/config/dependencies.php, que utiliza el contenedor de Slim para inyectar clases y configuraciones, manteniendo el index.php limpio y modular.

## Autoloading
El autoload de Composer se configura para cargar automáticamente las clases dentro del directorio src, permitiendo que Slim gestione las dependencias de manera eficiente.

## Contribuciones
  1. Crea un fork del repositorio.
  2. Crea una nueva rama para tu función o corrección.
  3. Envía un pull request y describe los cambios que has realizado.

## Licencia
Este proyecto está bajo la licencia MIT. Para más detalles, revisa el archivo [LICENSE](LICENSE).

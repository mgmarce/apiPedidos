# Nombre alumno:
- [Marcela Carolina Menjívar Gutiérrez](https://www.github.com/mgmarce)

# Proyecto Laravel API

Este proyecto es una API construida con el framework Laravel. Proporciona un conjunto de endpoints para gestionar pedidos.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos:

- **PHP** >= 8.0
- **Composer** >= 2.0
- **Servidor Web** (por ejemplo, Apache o Nginx)
- **MySQL** o cualquier otro sistema de base de datos compatible
- **Node.js** y **npm** (opcional, si se utiliza Laravel Mix para el frontend)

## Instalación

Sigue los pasos a continuación para configurar el proyecto:

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/mgmarce/apiPedidos
   cd repo-laravel-api
   ```

2. Instalar las dependencias de PHP:

   ```bash
   composer install
   ```

3. Configurar las variables de entorno:

   Copia el archivo de ejemplo `.env.example` y renómbralo como `.env`:

   ```bash
   cp .env.example .env
   ```

   Luego, edita el archivo `.env` para configurar los valores de conexión a la base de datos y otras configuraciones necesarias.

4. Generar la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

5. Migrar la base de datos:

   ```bash
   php artisan migrate
   ```

6. (Opcional) Poblar la base de datos con datos de prueba:

   ```bash
   php artisan db:seed
   ```

7. Iniciar el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

   El servidor estará disponible en `http://localhost:8000`.

## Endpoints de la API

### Pedidos (orders)

- `GET /api/v1/orders`: Obtiene todos los pedidos
- `GET /api/v1/orders/{orderIdUser}`: Recupera todos los pedidos para el usuario del id.

### Recursos principales

[Describiendo los endpoints principales, por ejemplo:]

- `GET /api/v1/orders`: Lista todos los pedidos.
- `GET /api/v1/users`: Lista todos los usuarios.
- `GET /api/v1/users/{letter}`: Obtiene un usuario por su inicial en el nombre.
- `GET /api/v1/orders-group`: Obtiene las ordenes agrupadas por usuario.


### Ejemplo de respuesta

```json
[
    {
	"user_name": "Alycia Feeney",
	"product": "praesentium",
	"amount": 53,
	"total": 791.89
    },
    {
        "user_name": "Delilah Sauer III",
        "product": "suscipit",
        "amount": 20,
        "total": 739.94
    }
]
```

## Construido con

- [Laravel](https://laravel.com/) - Framework PHP
- [MySQL](https://www.mysql.com/) - Base de datos relacional
- [Postman](https://www.postman.com/) - Herramienta para probar APIs

## Contribuir

1. Haz un fork del proyecto.
2. Crea una rama para tu feature o corrección de errores:

   ```bash
   git checkout -b nombre-rama
   ```

3. Realiza tus cambios y haz un commit:

   ```bash
   git commit -m "Descripción de los cambios"
   ```

4. Haz un push a tu rama:

   ```bash
   git push origin nombre-rama
   ```

5. Abre un Pull Request en el repositorio original.

## Licencia

Este proyecto es hecho por Marcela Menjívar.

---

¡Gracias por usar este proyecto! Si tienes alguna pregunta o sugerencia, no dudes en crear un issue.

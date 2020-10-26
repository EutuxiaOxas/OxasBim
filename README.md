## Manual de uso de plantilla de Desarrollo basada en Laravel 7.0

El siguiente manual tiene como finalidad explicar paso a paso como usar correctamente la plantilla de desarrollo.

Se tendran en cuenta todos los conflictos, y ediciones necesarias para el correcto uso.

Explicar cual es el correcto orden en que se deben migrar las diferentes ramas hacia la master, para obtener el producto final.


## 1- Rama Administrador

La rama administrador contiene:

- Administrador CMS del sitio web
- Usuario de administrador (seed)
- Seccion de usuarios de administracion

---

Para realizar el merge a la master es necesario:

    Dar click en merge y listo


-------------------------------------

## 1- Rama Landin_page

La rama landing_page contiene:

- seccion en el administrador para crear/editar/eliminar banners princiaples
- Usuario con permisos de edicion (seed)
- Nuevo perfil de usuario para edicion de landing page

---

Para realizar el merge a la master es necesario:

    Primero migrar la rama "administrador"
    segundo migrar la rama "landing_page"
    ejecutar comando artisan correspondientes:
        1- phpa artisan migrate
        2-php artisan db:seed





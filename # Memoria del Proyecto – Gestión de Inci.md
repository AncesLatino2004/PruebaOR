# Memoria del Proyecto – Gestión de Incidencias

## 1. Introducción
Este proyecto implementa una aplicación sencilla para la gestión de incidencias internas.
Permite crear incidencias, modificar su estado, registrar un historial de cambios y corregir inconsistencias en la base de datos mediante un comando Artisan.

El objetivo ha sido cumplir todos los requisitos del enunciado de forma clara, ordenada y manteniendo una estructura fácil de revisar.

---

## 2. Tecnologías utilizadas
- Laravel 10
- PHP 8
- MySQL
- Bootstrap 5
- JavaScript nativo
- Artisan Commands

---

## 3. Estructura del proyecto
El proyecto sigue la estructura estándar de Laravel:

### Modelos
- Incident
- IncidentLog

### Controlador
- IncidentController

### Vistas
- incidents/index.blade.php
- incidents/logs.blade.php

### Seeders
- UserSeeder
- IncidentSeeder

### Comando Artisan
- incidents:fix

---

## 4. Lógica de negocio

### 4.1 Creación de incidencias
El usuario puede crear incidencias indicando título, descripción y prioridad.
El estado inicial es **open**.

### 4.2 Cambio de estado
Los estados disponibles son:
- open
- review
- resolved

Cada cambio genera automáticamente un registro en `incident_logs`.

### 4.3 Historial
Cada incidencia dispone de un historial accesible desde un botón dedicado.
Se muestran:
- Acción realizada
- Estado anterior
- Estado nuevo
- Fecha del cambio

### 4.4 Filtro y contadores
Se implementó un filtro por estado y un contador dinámico mediante JavaScript.

---

## 5. Ejercicio 5: Inconsistencias

### 5.1 Detección
Se detectan incidencias marcadas como **resolved** sin un log asociado mediante una consulta específica.

### 5.2 Corrección
Se creó un comando Artisan que:
1. Localiza incidencias inconsistentes
2. Genera un log válido
3. Deja la base de datos coherente

El comando se ejecuta con:

php artisan incidents:fix

---

## 6. Usuario de prueba
Aunque la aplicación no requiere autenticación, se ha incluido un usuario de prueba en el seeder:

- Email: test@example.com
- Contraseña: password

---

## 7. Uso puntual de IA
El desarrollo del proyecto se ha realizado manualmente.
Sin embargo, en momentos puntuales utilicé IA como apoyo para revisar o estructurar pequeños fragmentos de código.

Un ejemplo concreto es este bloque de JavaScript, donde pedí ayuda para organizar el listener de confirmación:

document.querySelectorAll('.change-status-form').forEach(form => {
    form.addEventListener('submit', (e) => {
        const select = form.querySelector('select[name="status"]');
        if (select.value === 'resolved') {
            if (!confirm('¿Seguro que quieres marcar esta incidencia como resuelta?')) {
                e.preventDefault();
            }
        }
    });
});

---

## 8. Subida del proyecto a GitHub
El proyecto se ha subido a GitHub utilizando Visual Studio Code.
Los pasos realizados fueron:

1. Inicializar el repositorio Git desde VS Code
2. Realizar el primer commit
3. Crear un repositorio vacío en GitHub
4. Conectar el repositorio local con:

git remote add origin https://github.com/AncesLatino2004/PruebaOR.git

5. Iniciar sesión en GitHub desde Visual Studio Code
6. Subir los cambios con:

git push -u origin main

7. Finalmente, se añadieron los archivos README.md y MEMORIA.md.

---

## 9. Mejoras futuras
- Autenticación y roles
- Paginación
- API REST
- Tests automatizados
- Notificaciones

---

## 10. Conclusión
El proyecto cumple todos los requisitos del enunciado:
CRUD, historial, filtros, seeders, comando de corrección, usuario de prueba y documentación completa.

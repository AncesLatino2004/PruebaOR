# Gestión de Incidencias – Prueba Técnica

Este proyecto implementa un sistema básico de gestión de incidencias internas utilizando Laravel.
Permite crear incidencias, cambiar su estado, registrar un historial y corregir inconsistencias mediante un comando Artisan.

---

## 🚀 Requisitos
- PHP 8
- Composer
- MySQL
- Laravel 10

---

## 📦 Instalación

composer install
cp .env.example .env
php artisan key:generate

Configura tu base de datos en el archivo .env.

---

## 🗄️ Migraciones y seeders

php artisan migrate --seed

Esto creará:
- Incidencias de prueba
- Un usuario de prueba
- Una incidencia inconsistente para el ejercicio 5

---

## 👤 Usuario de prueba
Incluido en el seeder:

Email: test@example.com  
Contraseña: password  

(No se utiliza dentro de la aplicación, porque no existe autenticación.)

---

## 🛠️ Comando para corregir inconsistencias

El enunciado solicita detectar incidencias marcadas como resueltas sin un log asociado.

Para corregirlas:

php artisan incidents:fix

---

## 🖥️ Funcionalidades principales
- Crear incidencias
- Cambiar estado
- Historial de cambios
- Filtro por estado
- Contadores dinámicos
- Interfaz responsive con Bootstrap

---

## 🟦 Subir el proyecto a GitHub desde Visual Studio Code

1️⃣ **Inicializar Git**  
En VS Code → panel *Source Control* → botón *Initialize Repository*

2️⃣ **Añadir archivos**

git add .

3️⃣ **Crear commit**

git commit -m "Initial commit"

4️⃣ **Crear repositorio en GitHub**  
En GitHub → *New repository* → repositorio vacío

5️⃣ **Conectar repositorio local con GitHub**

git remote add origin https://github.com/AncesLatino2004/PruebaOR.git

6️⃣ **Iniciar sesión en GitHub desde VS Code**  
VS Code abrirá el navegador → autorizar acceso

7️⃣ **Subir cambios**

git push -u origin main

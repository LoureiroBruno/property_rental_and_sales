<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

---

# Projeto Laravel + Vue 3 + Inertia.js + Vite

Este projeto utiliza o framework Laravel no backend, com Vue 3 no frontend, integrados através do Inertia.js e empacotados com Vite. O ambiente de desenvolvimento pode ser executado com Docker.

---

## 🔧 Tecnologias Utilizadas

* [Laravel](https://laravel.com)
* [Vue.js 3](https://vuejs.org/)
* [Inertia.js](https://inertiajs.com/)
* [Vite](https://vitejs.dev/)
* [Docker](https://www.docker.com/)
* [Composer](https://getcomposer.org/)
* [Node.js / NPM](https://nodejs.org/)

---

## ✅ Pré-requisitos

* PHP >= 8.2
* Composer
* Node.js >= 16
* Docker & Docker Compose

---

## 🚀 Instalação e Uso Local

### 🔹 Clonar o repositório

```bash
git clone https://github.com/seu-usuario/seu-projeto.git
cd seu-projeto
```

### 🔹 Subir o ambiente com Docker

```bash
docker-compose -f docker-compose.local.yml up -d
```

### 🔹 Instalar dependências PHP e JS

```bash
docker exec -it nome-do-container bash

# Dentro do container
composer install
npm install
```

### 🔹 Gerar chave da aplicação e rodar migrações

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
```

### 🔹 Compilar os assets

```bash
npm run dev
```

---

## ⚙️ Configurações do Inertia.js

As seguintes configurações foram realizadas:

* Instalação do middleware do Inertia:

  ```bash
  php artisan inertia:middleware
  ```
* Registro do middleware no `app/Http/Kernel.php`:

  ```php
  \App\Http\Middleware\HandleInertiaRequests::class,
  ```
* Frontend inicializado com Vue 3 e plugin Vite:

  ```bash
  npm install --save-dev @vitejs/plugin-vue
  ```

---

## 📂 Estrutura do Projeto (parcial)

```
resources/
├── js/
│   ├── Pages/
│   │   └── Example.vue
│   ├── app.js
│   └── bootstrap.js
├── views/
│   └── app.blade.php
```

---

## 🔪 Testes

Você pode rodar os testes com:

```bash
php artisan test
```

---

## Referências

- Documentação Laravel: https://laravel.com/docs/11.x  
- Guia de Inertia.js com Laravel: https://inertiajs.com/server-side-setup  
- Site oficial do Vite: https://vite.dev/  

---

## 📝 Licença

Este projeto está licenciado sob a [MIT license](https://opensource.org/licenses/MIT).

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

* [Simple, fast routing engine](https://laravel.com/docs/routing).
* [Powerful dependency injection container](https://laravel.com/docs/container).
* Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
* Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
* Database agnostic [schema migrations](https://laravel.com/docs/migrations).
* [Robust background job processing](https://laravel.com/docs/queues).
* [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

* **[Vehikl](https://vehikl.com/)**
* **[Tighten Co.](https://tighten.co)**
* **[WebReinvent](https://webreinvent.com/)**
* **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
* **[64 Robots](https://64robots.com)**
* **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
* **[Cyber-Duck](https://cyber-duck.co.uk)**
* **[DevSquad](https://devsquad.com/hire-laravel-developers)**
* **[Jump24](https://jump24.co.uk)**
* **[Redberry](https://redberry.international/laravel/)**
* **[Active Logic](https://activelogic.com)**
* **[byte5](https://byte5.de)**
* **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

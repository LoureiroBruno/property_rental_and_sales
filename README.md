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

# 🏠 Property Rental and Sales 
#### [ Projeto Laravel + Vue 3 + Inertia.js + Vite ]

Sistema web completo para gerenciamento de imóveis para **aluguel** e **venda**, com frontend moderno, backend robusto e ambiente pronto para desenvolvimento via **Docker Compose**.
Este projeto utiliza o framework Laravel no backend, com Vue 3 no frontend, integrados através do Inertia.js e empacotados com Vite. O ambiente de desenvolvimento pode ser executado com Docker.

## 📷 Prints do Sistema

Visualização de algumas telas do sistema de aluguel e venda de imóveis:

| Tela Inicial | Lista de Imóveis |
|--------------|------------------|
| ![Tela 1](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/login.png?raw=true) | ![Tela 2](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/property-listing-customer-area.png?raw=true) |

| Detalhes do Imóvel | Cadastro/Administração |
|---------------------|------------------------|
| ![Tela 3](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/property-details.png) | ![Tela 4](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/real-estate-broker-anagement-area.png?raw=true) |

| Notificações | E-mails Automáticos |
|--------------|----------------------|
| ![Tela 5](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/notification-panel.png?raw=true) | ![Tela 6](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/email-notifications.png?raw=true) |

| Acesso a Area Administrativa | Cadastro de Usuário |
|--------------|----------------------|
| ![Tela 7](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/top-navigation.png?raw=true) | ![Tela 8](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/email-notifications.png?raw=true) |

| Moodo de Visualização | Upload de Arquivos |
|--------------|----------------------|
| ![Tela 9](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/choose-view-mode.png) | ![Tela 10](https://github.com/LoureiroBruno/property_rental_and_sales/blob/develop/public/%20system_images/uoload-files.png) |

---

## 🔧 Tecnologias Utilizadas

- ⚙️ **Backend**: [Laravel](https://laravel.com/)
- 📦 **Gerenciador de Dependências**: [Composer](https://getcomposer.org/)
- 💻 **Ambiente de Execução**: [Node.js / NPM](https://nodejs.org/)
- ⚡ **Frontend**: [Vue 3](https://vuejs.org/) + [Inertia.js](https://inertiajs.com/)
- 🎨 **Estilização**: [Tailwind CSS](https://tailwindcss.com/)
- 🧱 **Banco de Dados**: PostgreSQL
- 🐳 **Ambiente de Container**: Docker + Docker Compose
- 🧩 **Ícones**: Font Awesome + Heroicons
- 📦 **Outros**: Laravel Breeze, Eloquent ORM, Vite, Upload de arquivos

---

## ✅ Pré-requisitos

-   PHP >= 8.2
-   Composer
-   Node.js >= 16
-   Docker & Docker Compose

---

## 🚀 Instalação e Uso Local

### ⚙️ Permissões em Ambiente Docker

Verifique quem é o dono atual:

```bash
ls -l /home/nome_do_usuario/nome_da_pasta_de_projetos/property_rental_and_sales/
```

Se mostrar algo como `root root`, então o VS Code (via seu usuário `nome_do_usuario`) não tem como escrever no arquivo.

Corrija o dono para o seu usuário (`nome_do_usuario`):

```bash
sudo chown -R nome_do_usuario:nome_do_usuario /home/nome_do_usuario/projetos/property_rental_and_sales
```

Isso muda o "dono" dos arquivos para você, sem alterar permissões.

Reinicie o VS Code e tente salvar novamente.

Para que o Laravel funcione corretamente com logs e cache, é necessário garantir que o servidor web (normalmente o usuário `www-data` dentro do container) tenha acesso de escrita aos diretórios `storage` e `bootstrap/cache`.

Após subir os containers com Docker Compose, execute o seguinte comando no terminal (fora do container):

```bash
docker exec -it <nome_do_container_app> chown -R www-data:www-data /application/storage /application/bootstrap/cache
```

Substitua `<nome_do_container_app>` pelo nome correto do container, por exemplo:

```bash
docker exec -it property_rental_and_sales-app-1 chown -R www-data:www-data /application/storage /application/bootstrap/cache
```

Esse comando garante que o Laravel possa gravar os logs e cachear arquivos corretamente, evitando erros como:

```
The stream or file "/application/storage/logs/laravel.log" could not be opened in append mode: Permission denied
```

---

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

-   Instalação do middleware do Inertia:

    ```bash
    php artisan inertia:middleware
    ```

-   Registro do middleware no `app/Http/Kernel.php`:

    ```php
    \App\Http\Middleware\HandleInertiaRequests::class,
    ```

-   Frontend inicializado com Vue 3 e plugin Vite:

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

-   Documentação Laravel: https://laravel.com/docs/11.x
-   Guia de Inertia.js com Laravel: https://inertiajs.com/server-side-setup
-   Site oficial do Vite: https://vite.dev/

---

## 📝 Licença

Este projeto está licenciado sob a [MIT license](https://opensource.org/licenses/MIT).

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

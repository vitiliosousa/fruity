# 🍎 Fruity - E-commerce de Frutas

Sistema de e-commerce completo para venda de frutas, desenvolvido com Laravel 11, Vue.js 3 e Inertia.js. Inclui área administrativa, sistema de carrinho, autenticação de usuários e muito mais.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=flat&logo=vue.js)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=flat&logo=tailwind-css)
![Inertia.js](https://img.shields.io/badge/Inertia.js-1.x-9553E9?style=flat)

---

## 📋 Índice

- [Funcionalidades](#-funcionalidades)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Requisitos do Sistema](#-requisitos-do-sistema)
- [Instalação](#-instalação)
- [Configuração](#-configuração)
- [Executar o Projeto](#-executar-o-projeto)
- [Credenciais de Teste](#-credenciais-de-teste)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Funcionalidades Detalhadas](#-funcionalidades-detalhadas)
- [API e Rotas](#-api-e-rotas)
- [Troubleshooting](#-troubleshooting)

---

## ✨ Funcionalidades

### 👤 Área do Cliente
- ✅ Autenticação completa (Login, Registro, Recuperação de senha)
- ✅ Catálogo de frutas com busca e filtros por categoria
- ✅ Paginação (12 produtos por página)
- ✅ Skeleton loading durante carregamento
- ✅ Carrinho de compras
- ✅ Adicionar/remover/atualizar quantidade de itens
- ✅ Checkout com envio de email de confirmação
- ✅ Tela de sucesso após compra
- ✅ Gerenciamento de perfil

### 🔐 Área Administrativa
- ✅ Dashboard exclusiva para administradores
- ✅ CRUD completo de produtos (frutas)
- ✅ Upload de imagens
- ✅ Middleware de autorização
- ✅ Listagem e gerenciamento de frutas

### 🎨 Design e UX
- ✅ Interface moderna e responsiva
- ✅ Tema verde (tema de frutas)
- ✅ Animações suaves
- ✅ Toast notifications
- ✅ Loading states
- ✅ Mobile-first design

---

## 🛠 Tecnologias Utilizadas

### Backend
- **Laravel 11** - Framework PHP
- **MySQL** - Banco de dados
- **Inertia.js** - Bridge entre Laravel e Vue.js
- **Resend** - Serviço de envio de emails

### Frontend
- **Vue.js 3** - Framework JavaScript
- **Tailwind CSS** - Framework CSS utility-first
- **Vite** - Build tool
- **Lucide Vue Next** - Biblioteca de ícones
- **Headless UI** - Componentes acessíveis

### DevOps
- **Composer** - Gerenciador de dependências PHP
- **NPM** - Gerenciador de dependências JavaScript

---

## 💻 Requisitos do Sistema

Certifique-se de ter instalado:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x
- **NPM** >= 9.x ou **Yarn** >= 1.22
- **MySQL** >= 8.0 ou **MariaDB** >= 10.3
- **Git** (opcional, para clonar o repositório)

### Extensões PHP Requeridas
```bash
php-curl
php-mbstring
php-xml
php-zip
php-mysql
php-gd
php-intl
```

---

## 📦 Instalação

### 1. Clone o Repositório

```bash
git clone https://github.com/seu-usuario/fruity.git
cd fruity
```

### 2. Instale as Dependências PHP

```bash
composer install
```

### 3. Instale as Dependências JavaScript

```bash
npm install
```

---

## ⚙️ Configuração

### 1. Configure o Arquivo `.env`

Copie o arquivo de exemplo:

```bash
cp .env.example .env
```

### 2. Gere a Chave da Aplicação

```bash
php artisan key:generate
```

### 3. Configure o Banco de Dados

Edite o arquivo `.env` com suas credenciais do MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fruity
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui
```

### 4. Crie o Banco de Dados

No MySQL, execute:

```sql
CREATE DATABASE fruity CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Configure o Resend (Opcional - para emails)

Obtenha uma chave API em [resend.com](https://resend.com) e adicione ao `.env`:

```env
RESEND_KEY=re_sua_chave_aqui
```

### 6. Execute as Migrations e Seeders

```bash
php artisan migrate:fresh --seed
```

Este comando irá:
- ✅ Criar todas as tabelas do banco de dados
- ✅ Popular com dados de exemplo (frutas)
- ✅ Criar usuário administrador
- ✅ Criar usuário comum para testes

### 7. Crie o Link Simbólico para Storage

```bash
php artisan storage:link
```

Isso permite que as imagens enviadas sejam acessíveis publicamente.

---

## 🚀 Executar o Projeto

### 1. Inicie o Servidor Laravel

```bash
php artisan serve
```

O servidor estará disponível em: `http://localhost:8000`

### 2. Compile os Assets (Desenvolvimento)

Em outro terminal, execute:

```bash
npm run dev
```

**OU** para produção (build otimizado):

```bash
npm run build
```

### 3. Acesse a Aplicação

Abra seu navegador e acesse:

```
http://localhost:8000
```

---

## 🔑 Credenciais de Teste

### Usuário Administrador
```
Email: admin@example.com
Senha: password123
```

**Permissões:**
- Acesso à área administrativa (`/admin`)
- CRUD completo de produtos
- Após login, é redirecionado para `/admin`

### Usuário Comum
```
Email: user@example.com
Senha: password
```

### Usuário Personalizado
```
Email: seu email
Senha: password
- Voce de criar uma uma conta para receber um email após a compra
```


**Permissões:**
- Acesso ao catálogo de frutas (`/fruits`)
- Adicionar produtos ao carrinho
- Realizar compras
- Após login, é redirecionado para `/fruits`

---

## 📁 Estrutura do Projeto

```
fruity/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      # CRUD de produtos (Admin)
│   │   │   ├── CartController.php       # Carrinho e checkout
│   │   │   ├── FruitController.php      # Listagem de frutas
│   │   │   └── Auth/                    # Controllers de autenticação
│   │   └── Middleware/
│   │       └── CheckIfAdmin.php         # Middleware de autorização admin
│   └── Models/
│       ├── User.php                     # Model de usuário
│       ├── Fruit.php                    # Model de fruta
│       └── CartItem.php                 # Model de item do carrinho
├── database/
│   ├── migrations/                      # Migrations do banco
│   └── seeders/
│       ├── AdminUserSeeder.php          # Seeder de admin
│       └── FruitSeeder.php              # Seeder de frutas
├── resources/
│   ├── js/
│   │   ├── Components/
│   │   │   └── FruitSkeleton.vue        # Componente skeleton loading
│   │   ├── Pages/
│   │   │   ├── Admin/                   # Páginas administrativas
│   │   │   │   ├── Index.vue            # Listagem de produtos
│   │   │   │   ├── Create.vue           # Criar produto
│   │   │   │   └── Edit.vue             # Editar produto
│   │   │   ├── Auth/                    # Páginas de autenticação
│   │   │   ├── Cart/                    # Páginas do carrinho
│   │   │   │   ├── Index.vue            # Carrinho
│   │   │   │   └── Success.vue          # Sucesso da compra
│   │   │   └── Fruits/
│   │   │       └── Index.vue            # Catálogo de frutas
│   │   └── app.js                       # Entry point Vue.js
│   └── views/
│       ├── app.blade.php                # Template principal
│       └── emails/
│           └── order-confirmation.blade.php  # Email de confirmação
├── routes/
│   ├── web.php                          # Rotas web
│   └── auth.php                         # Rotas de autenticação
├── public/
│   └── storage/                         # Link simbólico para uploads
├── .env.example                         # Exemplo de configuração
├── composer.json                        # Dependências PHP
├── package.json                         # Dependências JavaScript
├── vite.config.js                       # Configuração do Vite
└── tailwind.config.js                   # Configuração do Tailwind
```

---

## 🎯 Funcionalidades Detalhadas

### Sistema de Autenticação

**Rotas:**
- `/login` - Login
- `/register` - Registro
- `/forgot-password` - Recuperar senha
- `/logout` - Logout

**Redirecionamento Inteligente:**
- Admin → `/admin`
- Usuário comum → `/fruits`

### Catálogo de Frutas (`/fruits`)

**Funcionalidades:**
- Busca em tempo real
- Filtro por categoria
- Paginação (12 itens/página)
- Skeleton loading
- Adicionar ao carrinho com feedback visual

### Carrinho de Compras (`/cart`)

**Funcionalidades:**
- Visualizar itens
- Atualizar quantidade
- Remover itens
- Ver total da compra
- Checkout

### Área Administrativa (`/admin`)

**Requer:** Usuário com `is_admin = true`

**Funcionalidades:**
- Listar todos os produtos
- Criar novo produto com imagem
- Editar produto existente
- Deletar produto (com remoção de imagem)
- Upload de imagens (JPEG, PNG, JPG, GIF - max 2MB)

---

## 🛣 API e Rotas

### Rotas Públicas
```
GET  /                           # Home
GET  /login                      # Login
POST /login                      # Processar login
GET  /register                   # Registro
POST /register                   # Processar registro
```

### Rotas Autenticadas
```
GET  /fruits                     # Catálogo de frutas
GET  /cart                       # Carrinho
POST /cart/add                   # Adicionar ao carrinho
POST /cart/update                # Atualizar quantidade
DELETE /cart/{item}              # Remover do carrinho
POST /cart/checkout              # Finalizar compra
GET  /order/success              # Tela de sucesso
```

### Rotas Administrativas (Requer Admin)
```
GET  /admin                      # Dashboard admin
GET  /admin/create               # Formulário criar produto
POST /admin                      # Salvar novo produto
GET  /admin/{fruit}/edit         # Formulário editar produto
PUT  /admin/{fruit}              # Atualizar produto
DELETE /admin/{fruit}            # Deletar produto
```

---

## 🔧 Troubleshooting

### Erro: "SQLSTATE[HY000] [1049] Unknown database"

**Solução:** Certifique-se de que o banco de dados foi criado:

```sql
CREATE DATABASE fruity;
```

### Erro: "Class 'Resend' not found"

**Solução:** Instale o pacote Resend:

```bash
composer require resend/resend-php
```

### Erro: "Mix manifest not found"

**Solução:** Compile os assets:

```bash
npm run build
```

### Erro: "Storage link not found" ou imagens não aparecem

**Solução:** Crie o link simbólico:

```bash
php artisan storage:link
```

### Erro: "Class not found" após adicionar código

**Solução:** Limpe o cache do autoload:

```bash
composer dump-autoload
php artisan clear-compiled
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Página em branco ou erro 500

**Solução:** Habilite o modo debug no `.env`:

```env
APP_DEBUG=true
```

E verifique os logs em `storage/logs/laravel.log`

### Assets não atualizando

**Solução:** Pare o `npm run dev` e execute novamente:

```bash
# Ctrl+C para parar
npm run dev
```



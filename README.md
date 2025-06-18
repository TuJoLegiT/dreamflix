# 🎬 DreamFlix

**DreamFlix** é uma aplicação web voltada para o gerenciamento e exibição de filmes, séries e plataformas de entretenimento. Desenvolvida com PHP e PostgreSQL, a proposta é criar uma espécie de "bilheteria virtual", com recursos como autenticação de usuários, listagem de títulos, histórico de assistidos, e funcionalidades administrativas.

---

## 🚀 Funcionalidades

- 🔐 Login seguro com sessões em PHP
- 🎞️ Catálogo de Filmes e Séries
- 🧾 Histórico de títulos assistidos
- 🎟️ Simulação de bilheteria com reservas
- 🧩 Navegação com submenus e filtros
- 🔎 Sistema de busca em tempo real
- 🛠️ Gerenciamento de plataformas com cores e logotipos

---

## 🛠️ Tecnologias Utilizadas

| Stack | Descrição |
|-------|-----------|
| `PHP` | Lógica backend, autenticação e controle |
| `PostgreSQL` | Banco de dados relacional |
| `HTML/CSS` | Estrutura e estilo da interface |
| `JavaScript` | Interatividade dinâmica (dropdowns, filtros) |
| `PHPMailer` | Envio de e-mails (recuperação de senha) |

---

## 📦 Estrutura do Projeto
dreamflix/
├── index.php
├── login.php
├── logout.php
├── /css
│ └── styles.css
├── /js
│ └── scripts.js
├── /images
│ └── fundo.jpg
├── /vendor
│ └── phpmailer/
└── README.md
-----
-----
## ⚙️ Como executar localmente

> Requisitos: PHP, PostgreSQL, Composer

bash
# Clone o repositório
git clone https://github.com/seu-usuario/dreamflix.git
cd dreamflix

# Instale dependências do PHPMailer
composer install

# Crie o banco de dados
psql -U postgres
> CREATE DATABASE dreamflix;

# Configure a conexão em db.php
# Execute os scripts de criação das tabelas (ex: plataformas, usuarios)

# Inicie um servidor local
php -S localhost:8000
----
🧠 Conceitos em prática

Controle de sessão com PHP
Design responsivo com CSS puro
Esquema de autenticação
Gerenciamento de dados com PDO e PostgreSQL
Uso de ALTER TABLE para expansão de schema
Git e versionamento de código
------

# User API

API RESTful para gerenciamento de usuários com autenticação JWT desenvolvida em Laravel.

## 📋 Pré-requisitos

Antes de começar, certifique-se de ter instalado em sua máquina:

- **PHP** >= 8.1
- **Composer** (gerenciador de dependências PHP)
- **MySQL** >= 8.0 ou **PostgreSQL** >= 13
- **Git**

## 🚀 Configuração do Ambiente de Desenvolvimento

### 1. Clone o Repositório

```bash
git clone <url-do-repositorio>
cd conecta-test
```

### 2. Instale as Dependências

```bash
# Dependências PHP
composer install

```

### 3. Configuração do Ambiente

```bash
# Copie o arquivo de configuração
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Gere a chave secreta JWT
php artisan jwt:secret
```

### 4. Configuração do Banco de Dados

Edite o arquivo `.env` com as configurações do seu banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=conecta_test
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 5. Execute as Migrações

```bash
# Criar o banco de dados (se necessário)
php artisan migrate

# Opcional: Popular com dados de teste
php artisan db:seed
```

### 6. Inicie o Servidor de Desenvolvimento

```bash
php artisan serve
```

A API estará disponível em: `http://127.0.0.1:8000`

## 📚 Documentação da API

A documentação interativa da API está disponível em:

- **Swagger UI**: `http://127.0.0.1:8000/api/documentation`

## 🔐 Endpoints de Autenticação

| Método | Endpoint | Descrição |
|--------|----------|----------|
| POST | `/api/auth/register` | Cadastro de usuário |
| POST | `/api/auth/login` | Login do usuário |
| POST | `/api/auth/refresh` | Renovar token JWT |
| POST | `/api/auth/logout` | Logout do usuário |
| GET | `/api/auth/me` | Dados do usuário autenticado |

## 👥 Endpoints de Usuários

| Método | Endpoint | Descrição |
|--------|----------|----------|
| GET | `/api/users` | Listar usuários |
| GET | `/api/users/{id}` | Buscar usuário por ID |
| PUT | `/api/users/{id}` | Atualizar usuário |
| DELETE | `/api/users/{id}` | Deletar usuário |

## 🔧 Configurações Importantes

### JWT Configuration

As configurações do JWT estão em `config/jwt.php`:

- **TTL**: Tempo de vida do token (padrão: 60 minutos)
- **Refresh TTL**: Tempo para renovação (padrão: 20160 minutos)
- **Algorithm**: Algoritmo de criptografia (padrão: HS256)

### CORS

Para desenvolvimento frontend, configure o CORS em `config/cors.php` se necessário.

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Executar testes específicos
php artisan test --filter=AuthTest
```

## 📦 Estrutura do Projeto

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php    # Autenticação JWT
│   │   └── UserController.php    # CRUD de usuários
│   ├── Middleware/
│   └── Requests/
├── Models/
│   └── User.php                  # Model do usuário
config/
├── jwt.php                       # Configurações JWT
└── auth.php                      # Configurações de autenticação
routes/
└── api.php                       # Rotas da API
```

## 🔍 Solução de Problemas

### Erro: "JWT secret not set"
```bash
php artisan jwt:secret
```

### Erro: "Database connection failed"
- Verifique as configurações no arquivo `.env`
- Certifique-se de que o banco de dados está rodando
- Teste a conexão: `php artisan migrate:status`

### Erro: "Class not found"
```bash
composer dump-autoload
```

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 📞 Suporte

Para dúvidas ou problemas:

- Abra uma [issue](../../issues)
- Entre em contato com a equipe de desenvolvimento

---

**Desenvolvido com ❤️ usando Laravel**
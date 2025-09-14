# User API

API RESTful em PHP construída com o framework Laravel. Serve para criar, atualizar, deletar e listar todos os usuários. As informações são salvas em um banco de dados MySQL.
Os endpoints retornam os dados em formato JSON e permitem operações GET, POST, PUT e DELETE para manipular os registros de usuário.
Foram considerados aspectos como segurança, validação de entrada e tratamento de erros.

## Requisitos

Para usar o comando `php artisan`, você precisa ter um ambiente de desenvolvimento configurado com os seguintes requisitos:

- **PHP**: Certifique-se de que o PHP está instalado e funcionando corretamente na sua máquina.
- **Composer**: O Composer é necessário para gerenciar as dependências do Laravel. Você pode instalá-lo seguindo as instruções no [site oficial do Composer](https://getcomposer.org/).
- **MySQL**: Banco de dados utilizados para armazenar as informações do usuário.[site oficial do MySQL](https://www.mysql.com/).

- **Servidor de Desenvolvimento**:
É necessário utilizar um servidor de desenvolvimento como o Apache (httpd).
- **Apache (httpd)**: Certifique-se de que o Apache está instalado e configurado corretamente na sua máquina. Você pode seguir as instruções no [site oficial do Apache](https://httpd.apache.org/).

## Instruções de Uso

1. Clone o repositório do projeto:
  ```bash
  git clone https://github.com/felipemullermachado/conecta-test.git
  ```

2. Navegue até o diretório do projeto:
  ```bash
  cd conecta-test
  ```

3. Instale as dependências do Composer:
  ```bash
  composer install
  ```

4. Copie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente:
  ```bash
  cp .env.example .env
  ```

5. Configure o servidor Apache e MySQL. Certifique-se de que ambos estão rodando.

6. Crie um banco de dados MySQL para a aplicação.

7. Atualize o arquivo `.env` com as informações do banco de dados criado.

8. Gere a chave da aplicação:
  ```bash
  php artisan key:generate
  ```

9. Inicie o servidor de desenvolvimento:
  ```bash
  php artisan serve
  ```

O servidor de desenvolvimento roda por padrão na URL `http://localhost:8000`.

## Testando a API

Para testar as requisições da API, recomendamos o uso do [Postman](https://www.postman.com/). O Postman é uma ferramenta poderosa para testar e desenvolver APIs.

## Contribuição

Se você deseja contribuir com este projeto, por favor, faça um fork do repositório e envie um pull request com suas alterações.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
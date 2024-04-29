# Webservices Resful com Laravel

API RESTful em PHP para criar, atualizar, deletar e listar todos os usuários e usa JWT para autenticação na API. As informações devem ser salvas em um banco de dados MySQL.

## Requisitos  necessários 

 > PHP 7.1 
 >
 > Composer 
 >
 > Banco de dados MySQL

 ## Como executar o projeto 

   1. Primeiro realize a clonagem para sua máquina do repositório [apiRestful](https://github.com/themarcosramos/apiRestful) .

   2. Altere as variáveis de ambiente no arquivo .env 

   3. Criar um banco de dados no MySQL com o mesmo nome da variável de ambiente DB_DATABASE no arquivo .env

   4. Após isso se desloque pelo terminal até o diretório raiz do projeto e execute o seguinte : 

   ``` 
    composer install
   ```

   5. Através da Linha de comando(cmd, poweshell, bash) entrar dentro da pasta raiz do projeto e executar o comando: 

   ``` 
     php artisan migrate
   ```

  ### Para criar as tabelas

   Ainda dentro da pasta raiz, executar o comando: 

   ``` 
    php artisan db:seed
   ```
   Para popular o banco de dados


  ## Usando o sistema

 ### Autenticação na api

  **POST:** 
  
  >> http://apiRestful/api/v1/auth 
  >
  > com 2 form_params:

 >'email' => email_usuario
 >
 >'password' => senha_usuario

Retorna Json com o parâmetro token que é JWT a ser usado em todas as requisições

 ### Listar todos os produto

  **GET:** 
  
  >> http://apiRestful/api/v1/products
  >
  > O token do JWT pode ser enviado de 2 formas:
  >
  >> http://apiRestful/api/v1/products?token=jwt_gerado_no_login
 >
 ou
 >
  >> http://apiRestful/api/v1/products
  >> 
  passando o header: "Authorization: Bearer jwt_gerado_no_login"


 ### Exibir produto

  **GET:** 
  
  >> http://apiRestful/api/v1/products/id_product
  >
  > O token do JWT pode ser enviado de 2 formas:
  >
  >> http://apiRestful/api/v1/products/id_product?token=jwt_gerado_no_login
 >
 ou
 >
  >> http://apiRestful/api/v1/products/id_product
  >
  passando o header: "Authorization: Bearer jwt_gerado_no_login"

 ### Cadastrar produto

  **POST:** 
  
  >> http://apiRestful/api/v1/products
  >
  > com 2 form_params:
  >
  >> http://apiRestful/api/v1/products/id_product?token=jwt_gerado_no_login
 >
 ou
 >
  >> http://apiRestful/api/v1/products/id_product
  >
   passando o header: "Authorization: Bearer jwt_gerado_no_login"
 >
 > name' => nome_do_produto
 >
 >'description' => descricao_do_produto 
 >
 O token do JWT pode ser enviado de 2 formas:

  >> http://apiRestful/api/v1/products?token=jwt_gerado_no_login
 >
ou
  >> http://apiRestful/api/v1/products

 passando o header: "Authorization: Bearer jwt_gerado_no_login"

#### Retorna o Json contendo os dados do produto cadastrado


 ### Modificar produto

  **PUT:** 
  
  >> http://apiRestful/api/v1/products/id_product
  >
  > com 2 form_params:
  >
  > name' => nome_do_produto
  >
  >'description' => descricao_do_produto 
  >
  O token do JWT pode ser enviado de 2 formas:
  >> http://apiRestful/api/v1/products?token=jwt_gerado_no_login
 >
 ou
 >
  >> http://apiRestful/api/products

 passando o header: "Authorization: Bearer jwt_gerado_no_login"

### Retorna o Json contendo os dados do produto alterado


 ### Apagar produto

  ** DELETE:** 
  
  >> http://apiRestful/api/v1/products/id_product
  >
  >O token do JWT pode ser enviado de 2 formas:
  >
  >> http://apiRestful/api/v1/products?token=jwt_gerado_no_login
  >
  ou 
  >
  >> http://apiRestful/api/v1/products

 passando o header: "Authorization: Bearer jwt_gerado_no_login"

### Retorna true se ação for excluído ou false caso contrário.

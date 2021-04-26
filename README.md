<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


# Projeto API Laravel

## Clonar o projeto:

``` bash
git clone https://github.com/marcelorocfer/produtos_pedidos_laravel.git
``` 

## Acessar o diretório:

``` bash
cd produtos_pedidos_laravel
``` 
## Configuração do projeto

``` bash
# Instalar dependências do projeto
- Execute o comando abaixo
    - composer install

# Configurar variáveis de ambiente
- Criar o arquivo .env a partir do arquivo .env.example
    - cp .env.example .env
- Inserir as credenciais do seu banco de dados no arquivo .env
- Execute o comando abaixo
    - php artisan key:generate

# Criar diretório para imagens
- No diretório storage/app/public/ crie a pasta fotos
    - sudo mkdir storage/app/public/fotos 
    
# Criar link simbólico para o storage
- Execute o comando abaixo
    - php artisan storage:link

# Criar migrations (tabelas e Seeders)
- Execute os comandos abaixo
    - php artisan migrate
    - php artisan db:seed --class=ProdutosSeeder
``` 

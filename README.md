# Sistema Aponte

O **Sistema Aponte** foi desenvolvido com o propósito de ser uma **ponte** entre os moradores de uma determinada rua e a Prefeitura de sua cidade, bem como outras empresas da região. O objetivo é facilitar a comunicação para que os problemas relatados pelos moradores sejam resolvidos de forma mais rápida e eficiente.

## Como Usar

1. Acesse o site [Sistema Aponte](http://aponte.infinityfreeapp.com/).
2. Se ainda não for cadastrado, [cadastre-se](http://aponte.infinityfreeapp.com/register.php).
3. Se já for cadastrado, [acesse o Sistema Aponte](http://aponte.infinityfreeapp.com/login.php).

## Funcionalidades

O Sistema Aponte oferece as seguintes funcionalidades:

- **Registro de Problemas:** Os moradores podem criar posts sobre os problemas em suas ruas.
- **Feedback em Tempo Real:** Receba feedbacks sobre o andamento do problema, incluindo:
  - **Localização:** Inclusão da localização para uma melhor identificação.
  - **Fotografias:** Anexe imagens para uma compreensão mais clara.
  - **Múltiplas Solicitações:** Possibilidade de realizar várias solicitações.

## Layout

### Mobile

![Mobile Layout](asdf) <!-- Adicione aqui a imagem de baixa ou média qualidade para mobile -->

### Web

![Web Layout](asdf) <!-- Adicione aqui a imagem de baixa ou média qualidade para web -->

## Como Executar o Projeto

### Pré-requisitos

- Git
- php 8.2
- Composer
- Nodejs
- npm
- Docker compose

### Rodando o Backend (Servidor)

```bash
# Clone este repositório
$ git clone https://github.com/dawidsongru/aponte.git

# Acesse a pasta do projeto no terminal/cmd
$ cd aponte/aponte

# Rode o banco de dados
$ docker compose up -d

# Instale as dependências
$ composer install && npm install

# Migre o banco de dados. OBS: caso você tenha o mysql rodando na porta 3306,
# será necessário parar o serviço ou trocar a porta.
$ php artisan migrate --seed

# Gere a chave da aplicação
$ php artisan key:generate

# Execute a aplicação
$ npm run dev & php artisan serve
```
### Ela abrirá no localhost:8000

## Tecnologias

### WebSite

- Tailwind
- Laravel
- Nodejs
- Docker

## Contribuições

Agradecemos aos seguintes contribuidores:

- Dawidson Pereira
- Ênrell Jeronimo
- Ivan Teotônio

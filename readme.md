###### Curso: Sistemas de Informação
###### Disciplina: Programação Web II
###### Docente: Pablo Ricardo Roxo Silva
###### Período letivo: 2021.2
###### Aluno: Rogério de Oliveira Nascimento

# Sobre o trabalho
Para atender os requisitos do [trabalho oficial II](https://roxo.dev.br/programacao-para-web-ii/) desenvolvi
uma api com o objetivo realizar um CRUD de Todo List com base no usuário autenticado usando JWT.

## Startup
- `composer install` Download das dependências.
- Configurar o .env e criar o banco de dados.
- `php artisan migrate` Rodar as migrations para criar as tabelas de users e todos
- `php artisan db:seed` Execurar os seeds conficurados para criar dois usuários para realizar os testes.

Pra facilitar deixei na raiz do projeto o arquivo `requests-Insomnia.json` que pode ser importado no insomnia e os requests para teste já vai estar pronto. 

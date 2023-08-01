# Facil Consulta

Teste técnico para desenvolvedor Back-end Pleno.


Projeto criado com Docker, Laravel Sail 10 e banco de dados MySQL.

Hospedado na AWS EC2 tier gratuito.

URL de testes: http://44.217.200.121:8080/api/

phpMyAdmin: http://44.217.200.121:8081

Link para o teste:
[PDF](https://drive.google.com/drive/folders/1xgEfsnMSpv-jhE7fPIDr3X7_DllcJrY0)

## API
```
legenda das rotas:
🔓 pública
🔒 privada
```

### Cidades
Listar cidades

```js
🔓 GET  /cidades
```
### Médicos
Listar médicos
```js
🔓 GET  /medicos
```
Listar médicos de uma cidade
```js
🔓 GET  /cidades/{{id_cidade}}/medicos
```
Adicionar novo médico

```js
🔒 POST /medicos 
{
    nome: "Dra. Alessandra Moura",
    especialidade: "Neurologista",
    cidade_id: {{id_cidade}}
}
```
Vincular paciente ao médico
```js
🔒 POST /medicos/{{id_medico}}/pacientes
{
    medico_id: {{id_medico}},
    paciente_id: {{id_paciente}}
}
```
### Pacientes
Listar pacientes do médico
```js
🔒 GET  /medicos/{{id_medico}}/pacientes
```
Adicionar novo paciente
```js
🔒 POST /pacientes
{
    nome: "Matheus Henrique",
    cpf: "795.429.941-60",
    celular: "(11) 9 8432-5789"
}
```
Atualizar paciente
```js
🔒 PUT  /pacientes/{{id_paciente}}
🔒 POST /pacientes/{{id_paciente}}
{
    nome: "Luana Rodrigues Garcia",
    celular: "(11) 98484-6362"
}
```
Autenticação
```js
🔒 GET  /user
```
```js
🔒 POST /login
{
    email: "christian.ramires@example.com",
    password: "password"
}
```

### Observações sobre o teste

Existem pequenas divergências entre o PDF e as coleções do Postman
 - Na coleção existe o `POST /medicos`, que não é exigido no teste escrito
 - No PDF, 3.3.2. Atualizar paciente, exige o método `POST` e na coleção é utilizado o `PUT`
 - Ao vincular o paciente com o médico, existe a redundância do `id_medico` como parâmetro da url e no corpo da requisição
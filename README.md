# Facil Consulta

```
Teste técnico para desenvolvedor Back-end Pleno.
Projeto criado com Docker, Laravel Sail 10 e banco de dados MySQL.
Hospedado na AWS EC2 tier gratuito.
```
Link para o teste:
[PDF](https://drive.google.com/drive/folders/1xgEfsnMSpv-jhE7fPIDr3X7_DllcJrY0)

URL de testes: http://44.217.200.121:8080/api/

phpMyAdmin: http://44.217.200.121:8081

## API
```
legenda das rotas:
🔓 pública
🔒 privada - Authorization: Bearer eyJhbGciOiJIUzI1NiI...
```
### Autenticação
<details>
<summary>Listar usuário autenticado</summary>

```js
🔒 GET  /user
```
</details>

<details>
<summary>Autenticação</summary>

```js
🔒 POST /login
{
    email: "christian.ramires@example.com",
    password: "password"
}
```
</details>

### Cidades
<details>
<summary>Listar cidades</summary>

```js
🔓 GET  /cidades
```
</details>

### Médicos
<details>
<summary>Listar médicos</summary>

```js
🔓 GET  /medicos
```
</details>

<details>
<summary>Listar médicos de uma cidade</summary>

```js
🔓 GET  /cidades/{{id_cidade}}/medicos
```
</details>

<details>
<summary>Adicionar novo médico</summary>

```js
🔒 POST /medicos 
{
    nome: "Dra. Alessandra Moura",
    especialidade: "Neurologista",
    cidade_id: {{id_cidade}}
}
```
</details>

<details>
<summary>Vincular paciente ao médico</summary>

```js
🔒 POST /medicos/{{id_medico}}/pacientes
{
    medico_id: {{id_medico}},
    paciente_id: {{id_paciente}}
}
```
</details>

### Pacientes

<details>
<summary>Listar pacientes do médico</summary>

```js
🔒 GET  /medicos/{{id_medico}}/pacientes
```
</details>

<details>
<summary>Adicionar novo paciente</summary>

```js
🔒 POST /pacientes
{
    nome: "Matheus Henrique",
    cpf: "795.429.941-60",
    celular: "(11) 9 8432-5789"
}
```
</details>

<details>
<summary>Atualizar paciente</summary>

```js
🔒 PUT  /pacientes/{{id_paciente}}
🔒 POST /pacientes/{{id_paciente}}
{
    nome: "Luana Rodrigues Garcia",
    celular: "(11) 98484-6362"
}
```
</details>

## Rotina de testes
Os testes foram desenvolvidos com o node test runner
#### Teste de privacidade de rotas
```
sail node tests/rotas.js
```
#### Teste autenticação
```
sail node tests/auth.js
```
#### Teste de médicos
```
sail node tests/medicos.js
```
#### Teste de pacientes
```
sail node tests/pacientes.js
```
### Referências

https://laravel.com/docs/10.x/sail

https://jwt-auth.readthedocs.io/en/develop/auth-guard/

<details>
<summary>Observações sobre o teste técnico</summary>

Existem pequenas divergências entre o PDF e as coleções do Postman
 - Na coleção existe o `POST /medicos - Adicionar um novo médico`, que não é exigido no teste escrito
 - No PDF, 3.3.2. Atualizar paciente, exige o método `POST` e na coleção é utilizado o `PUT`
 - Ao vincular o paciente com o médico, existe a redundância do `id_medico` como parâmetro da url e no corpo da requisição

</details>

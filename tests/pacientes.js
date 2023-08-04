import test from "node:test";
import { Schema, generateCPF, login, randomInt } from "./config.js";

const $paciente = {
  "nome": "Matheus Henrique",
  "cpf": generateCPF(),
  "celular": "(11) 98432-5789"
}

test("Teste de rota: pacientes", async ($) => {
  let $axios;
  let $data;
  let id = 0;

  await $.test("Autenticação", async () => {
    $axios = await login();
  });

  await $.test("Adicionar paciente", async () => {
    try {
      let { data } = await $axios.post("/pacientes", $paciente);
      id = data.id
      $data = data
    } catch (error) {
      console.log(error.response);
    }
    Schema.paciente.parse($data);
  });

  await $.test("Atualizar paciente", async () => {
    try {
      let { data } = await $axios.put("/pacientes/" + id, {
        nome: "Luana Rodrigues Garcia",
        celular: "(11) 98484-6362"
      });
      $data = data;
    } catch (error) {
      console.log(error.response.status);
    }
    Schema.paciente.parse($data);
  });
});
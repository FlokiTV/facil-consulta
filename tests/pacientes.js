import test from "node:test";
import { Schema, login, randomInt } from "./config.js";

const $paciente = {
  "nome": "Matheus Henrique",
  "cpf": `${randomInt(111, 999)}.${randomInt(111, 999)}.${randomInt(111, 999)}-${randomInt(11, 99)}`,
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
      console.log(error.response.status);
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
import test from "node:test";
import assert from "node:assert";
import { login, randomInt } from "./config.js";

test("Teste de rota: pacientes", async ($) => {
  let $axios;
  const $paciente = {
    "nome": "Matheus Henrique",
    "cpf": `${randomInt(111, 999)}.${randomInt(111, 999)}.${randomInt(111, 999)}-${randomInt(11, 99)}`,
    "celular": "(11) 98432-5789"
  }
  let id = 0;
  await $.test("Autenticação", async () => {
    $axios = await login();
  });
  await $.test("Adicionar paciente", async () => {
    try {
      let { data } = await $axios.post("/pacientes", $paciente);
      id = data.id
    } catch (error) {
      assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
    }
  })
  await $.test("Atualizar paciente", async () => {
    try {
      await $axios.put("/pacientes/"+id, {
        nome: "Luana Rodrigues Garcia",
        celular: "(11) 98484-6362"
      });
    } catch (error) {
      assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
    }
  })
});
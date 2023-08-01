import { test } from "node:test";
import { $axios, randomInt } from "./config.js";

const $paciente = {
  "nome": "Matheus Henrique",
  "cpf": `${randomInt(111, 999)}.${randomInt(111, 999)}.${randomInt(111, 999)}-${randomInt(11, 99)}`,
  "celular": "(11) 98432-5789"
}

test("pacientes", async ($) => {
  let pacienteID;
  await $.test("Create Paciente", async () => {
    try {
      let { data } = await $axios.post("pacientes", $paciente);
      pacienteID = data.id
      console.log(data);
    } catch (error) {
      throw new Error(error.response.data.message);
    }
  })

  await $.test("Update Paciente", async () => {
    if (!pacienteID) throw new Error("pacienteID cant be null");

    let { data } = await $axios.put("pacientes/" + pacienteID, {
      "nome": "Luana Rodrigues Garcia",
      "celular": "(11) 98484-6362"
    });
    
    console.log(data)
  })
})

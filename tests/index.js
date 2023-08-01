import axios from "axios";
import { test } from "node:test";
const baseURL = "http://127.0.0.1/api/";
const $axios = axios.create({
  baseURL,
});

function randomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
}

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

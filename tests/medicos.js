import { test } from "node:test";
import { $axios, randomInt } from "./config.js";

test("medicos", async ($) => {
    await $.test("Vincular Paciente", async () => {
        try {
            let { data } = await $axios.post("/medicos/1/pacientes", {
                medico_id: 1,
                paciente_id: 1
            });
            console.log(data);
        } catch (error) {
            throw new Error(error.response.data.message);
        }
    })
})
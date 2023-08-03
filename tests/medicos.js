import test from "node:test";
import assert from "node:assert";
import { login } from "./config.js";

test("Teste de rota: médicos", async ($) => {
    let $axios;
    await $.test("Autenticação", async () => {
        $axios = await login();
    });
    await $.test("Adicionar um novo médico", async () => {
        try {
            let { data } = await $axios.post("/medicos", {
                nome: "Dra. Alessandra Moura",
                especialidade: "Neurologista",
                cidade_id: 1
            });
            // {
            //     nome: 'Dra. Alessandra Moura',
            //     especialidade: 'Neurologista',
            //     cidade_id: 1,
            //     updated_at: '2023-08-03T18:22:46.000000Z',
            //     created_at: '2023-08-03T18:22:46.000000Z',
            //     id: 10
            //   }
            console.log(data)
            // assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        } catch (error) {
            throw new Error(error.response.data.message);
        }
    });
    await $.test("Vincular Paciente", async () => {
        try {
            let { data } = await $axios.post("/medicos/1/pacientes", {
                medico_id: 1,
                paciente_id: 1
            });
            console.log(data)
        } catch (error) {
            throw new Error(error.response.data.message);
        }
    });
    await $.test("Listar pacientes do médico", async () => {
        try {
            let { data } = await $axios.get("/medicos/1/pacientes");
            console.log(data)
            // assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        } catch (error) {
            throw new Error(error.response.data.message);
        }
    });
})
import test from "node:test";
import assert from "node:assert";
import { $axios } from "./config.js";

test("Teste de rotas públicas", async ($) => {
    await $.test("Listar cidades", async () => {
        try {
            let { status, data } = await $axios.get("/cidades");
            assert.equal(status, 200, "status of response should return 200");
            let res = data[0];
            assert.equal(typeof res, "object", "type of response should be object");
            // test type with zod?
        } catch (error) {
            throw new Error(error);
        }
    })
    await $.test("Listar medicos", async () => {
        try {
            let { status, data } = await $axios.get("/medicos");
            assert.equal(status, 200, "status of response should return 200");
            let res = data[0];
            assert.equal(typeof res, "object", "type of response should be object");
        } catch (error) {
            throw new Error(error);
        }
    })
    await $.test("Listar medicos de uma cidade", async () => {
        try {
            let { status, data } = await $axios.get("/cidades/1/medicos");
            assert.equal(status, 200, "status of response should return 200");
            let res = data[0];
            assert.equal(typeof res, "object", "type of response should be object");
        } catch (error) {
            throw new Error(error);
        }
    })
})

test("Teste de rotas privadas", async ($) => {
    await $.test("Adicionar um novo médico", async () => {
        try {
            await $axios.post("/medicos", {
                nome: "Dra. Alessandra Moura",
                especialidade: "Neurologista",
                cidade_id: 1
            });
        } catch (error) {
            assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        }
    })
    await $.test("Vincular paciente ao médico", async () => {
        try {
            await $axios.post("/medicos/1/pacientes", {
                medico_id: 1,
                paciente_id: 1
            });
        } catch (error) {
            assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        }
    })
    await $.test("Listar pacientes do médico", async () => {
        try {
            await $axios.get("/medicos/1/pacientes");
        } catch (error) {
            assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        }
    })
    await $.test("Adicionar paciente", async () => {
        try {
            await $axios.post("/pacientes", {
                nome: "Matheus Henrique",
                cpf: "795.429.941-60",
                celular: "(11) 9 8432-5789"
            });
        } catch (error) {
            assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        }
    })
    await $.test("Atualizar paciente", async () => {
        try {
            await $axios.put("/pacientes/1", {
                nome: "Luana Rodrigues Garcia",
                celular: "(11) 98484-6362"
            });
        } catch (error) {
            assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        }
    })
})
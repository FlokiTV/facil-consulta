import test from "node:test";
import { login, Schema } from "./config.js";

test("Teste de rota: médicos", async ($) => {
    let $axios;
    let $data;
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
            $data = data
        } catch (error) {
            throw new Error(error.response.data.message);
        }
        Schema.medico.parse($data)
    });
    await $.test("Vincular Paciente", async () => {
        try {
            let { data } = await $axios.post("/medicos/1/pacientes", {
                medico_id: 1,
                paciente_id: 1
            });
            $data = data
        } catch (error) {
            throw new Error(error.response.data.message);
        }
        let { medico, paciente } = $data
        Schema.medico.parse(medico)
        Schema.paciente.parse(paciente)
    });
    await $.test("Listar pacientes do médico", async () => {
        try {
            let { data } = await $axios.get("/medicos/1/pacientes");
            $data = data
        } catch (error) {
            throw new Error(error.response.data.message);
        }
        let paciente = $data[0]
        Schema.paciente.parse(paciente)
    });
})
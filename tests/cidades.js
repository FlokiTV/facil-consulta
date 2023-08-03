import test from "node:test";
import { Schema, $axios } from "./config.js";

test("Teste de rota: cidades", async ($) => {
    let $data;
    await $.test("Listar cidades", async () => {
        try {
            let { data } = await $axios.get("/cidades");
            $data = data[0]
        } catch (error) {
            console.log(error.response.status);
        }
        Schema.cidade.parse($data);
    });
});
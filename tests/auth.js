import test from "node:test";
import assert from "node:assert";
import { $axios } from "./config.js";

test("Teste de autenticação", async ($) => {
    let $token = "";
    await $.test("Listar usuário sem token", async () => {
        try {
            await $axios.get("user");
        } catch (error) {
            assert.equal(error.response.status, 401, "'/medicos/1/pacientes' should return 401");
        }
    })
    await $.test("Login", async () => {
        let { data } = await $axios.post("login", {
            email: "christian.ramires@example.com",
            password: "password"
        });
        let { token } = data.data;
        $token = token;
    })
    await $.test("Listar usuário com token", async () => {
        await $axios.get("user", {
            headers: {
                Authorization: "Bearer " + $token
            }
        });
    })
})
import { z } from "zod";
import axios from "axios";
export const baseURL = "http://127.0.0.1/api/";
export const $axios = axios.create({
    baseURL,
});

export async function login() {
    let { data } = await $axios.post("login", {
        email: "christian.ramires@example.com",
        password: "password"
    });
    const { token } = data.data;
    return axios.create({
        baseURL,
        headers: {
            Authorization: "Bearer " + token
        }
    });
}

export function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

export const Schema = {
    medico: z.object({
        id: z.number(),
        nome: z.string(),
        especialidade: z.string(),
        cidade_id: z.string(),
        updated_at: z.date(),
        created_at: z.date(),
        deleted_at: z.date(),
    }),
    paciente: z.object({
        id: z.number(),
        nome: z.string(),
        cpf: z.string(),
        celular: z.string(),
        updated_at: z.date(),
        created_at: z.date(),
        deleted_at: z.date(),
    }),
    cidade: z.object({
        id: z.number(),
        nome: z.string(),
        estado: z.string(),
        updated_at: z.date(),
        created_at: z.date(),
        deleted_at: z.date(),
    })
}
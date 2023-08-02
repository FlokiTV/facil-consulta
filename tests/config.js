import axios from "axios";
import { test } from "node:test";
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
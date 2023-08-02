import { $axios } from "./config.js";

export async function login() {
    let { data } = await $axios.post("login", {
        email: "christian.ramires@example.com",
        password: "password"
    });
    const { token } = data.data;
    console.log(token)
    return token || false;
}

login()
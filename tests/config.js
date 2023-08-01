import axios from "axios";
import { test } from "node:test";
export const baseURL = "http://127.0.0.1/api/";
export const $axios = axios.create({
    baseURL,
});

export function randomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
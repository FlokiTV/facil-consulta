import axios from "axios";
import { test } from "node:test";
const baseURL = "http://127.0.0.1/api/";
const $axios = axios.create({
  baseURL,
});

$axios.post("pacientes", {
    "nome": "Matheus Henrique",
    "cpf": "795.429.940-60",
    "celular": "(11) 98432-5789"
}).then(data =>{
  console.log(data.data)
})
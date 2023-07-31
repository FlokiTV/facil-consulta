#!/bin/bash

# Verifica se o comando sail existe
if [ ! -f "./vendor/bin/sail" ]; then
    echo "O comando './vendor/bin/sail' não foi encontrado. Certifique-se de que o Sail está instalado corretamente."
    exit 1
fi

# Verifica se foram passados argumentos
if [ $# -eq 0 ]; then
    echo "Este script requer pelo menos um argumento."
    echo "Uso: $0 <argumento1> [<argumento2> ...]"
    exit 1
fi

# Executa o comando sail com os argumentos fornecidos
./vendor/bin/sail "$@"
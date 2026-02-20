# JadLog API Integration - Prova de Conceito (PoC) em PHP

Este projeto é uma **Prova de Conceito (PoC)** desenvolvida em PHP para integração com os serviços logísticos da transportadora JadLog. O objetivo é demonstrar a viabilidade técnica de automatizar fluxos de entrega diretamente em aplicações de e-commerce.

## 🚀 Funcionalidades

O projeto cobre os principais pilares da operação logística:

- **Calcular Frete**: Consulta dinâmica de prazos e valores com base em CEP e características da carga.
- **Incluir Pedido**: Registro automatizado de remessas no sistema da JadLog.
- **Cancelar Pedido**: Gestão de estornos para pedidos ainda não processados.
- **Rastrear Pedido**: Monitoramento do status de entrega em tempo real.
- **Listar Postos de Coleta**: Busca geolocalizada de pontos de postagem.

## 🛠️ Tecnologias Utilizadas

- **PHP** (v8.x recomendado)
- **cURL / Guzzle**: Para comunicação robusta com a API REST da JadLog.
- **JSON**: Para intercâmbio de dados estruturados.

## 📋 Pré-requisitos

Para rodar este projeto localmente, você precisará de:
1. Credenciais ativas na API JadLog (Token/Chave de API).
2. Servidor local com PHP configurado (XAMPP, Docker ou similar).

## 🔧 Configuração e Uso

1. Clone o repositório ou faça download do zip
   
2. Renomeie o ficheiro `example.env` para `.env`.

3. Adicione a sua chave de API:

    ```

    JADLOG_API_KEY=sua_api_key_jadlog

    ```

---

Desenvolvido por Ejiraia (Eliton Aranda)
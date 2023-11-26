
# Teste Técnico

Teste técnico para laravel junior

Feito com Docker, Laravel e Blade

## Requisitos

- [git](https://git-scm.com/downloads)
- [Docker](https://www.docker.com/)

## Endpoints

#### Home

```
  GET /
```

Página inicial. 
Contém um form que ativa a busca de entregas por cpf.
Um submit com o campo vazio busca todas as entregas


#### Lista de Entregas

```
  GET /entregas
```

| Parâmetro | Tipo     | Descrição                |
| :-------- | :------- | :------------------------- |
| `cpf`     | `string` |  Busca entrega por cpf     |


Página que mostra a lista de entregas baseado no cpf informado.
Clicar em uma das entregas abre um novo endpoint que mostra mais dados da mesma.


#### Dados da Entrega

```
  GET /entrega/${id}
```

|  Parâmetro  | Tipo |  Descrição                               |
|  :--------  | :--- | :--------------------------------------- |
|    `id`     |`int` | **Required**. Mostra os dados da entrega |

Mostra todos os dados relacionados a entrega com o ID informado, 
incluindo dados do cliente, transportadora e remetente.

## Criando o ambiente dev

1- Crie uma pasta onde os arquivos do projeto serão colocados

2- Inicialize o git nessa pasta
```bash
  git init
```

3- Adicione o link do repositório
```bash
  git remote add origin https://github.com/medalzzz/teste_tecnico
```

4- Localize os dados da branch main
```bash
   git fetch origin
```

5- Puxe os dados da branch main
```bash
  git pull origin main
```

6- Monte o container
```bash
  docker-compose up -d
```
7- Projeto agora acessível no link:
```bash
  http://localhost:9000
```
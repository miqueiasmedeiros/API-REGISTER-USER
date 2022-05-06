<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

----

## 📝️ Descrição
> Um REST Full API de cadastro de usuários usando o framework <a href="https://laravel.com/" target="_blank">PHP Laravel</a>, neste exemplo eu criei uma API CRUD. CRUD é a sigla em inglês de "Create, Read, Update, and Delete" (Criar, ler, atualizar e excluir). Nossa API terá os seguintes endpoints:

`GET /api/students` retornará todos os alunos e aceitará solicitações `GET`.

`GET /api/students/{id}` retornará um registro de aluno fazendo referência a seu id e aceitando solicitações `GET`.

`POST /api/students` criará um novo registro de alunos e aceitará solicitações `POST`.

`PUT /api/students/{id}` atualizará um registro existente de aluno fazendo referência a seu `id` e aceitando solicitações `PUT`.

`DELETE /api/students/{id}` excluirá um registro de aluno fazendo referência a seu id e aceitando solicitações `DELETE`.

O registro do aluno conterá apenas `name` e `course` como detalhes.

----
## 📥️ Instalação

### Pré-Requisitos 

   * PHP 7.1 ou superior
   * Composer
   * MySql
   * Laravel 5.6 ou posterior
   * Insomnia ou Postman

> Pode baixar o pacote completo com o <a href="https://github.com/leokhoa/laragon/releases/download/5.0.0/laragon-wamp.exe" target="_blank">Laragon</a>.

## 🛠️ Criando e configurando o APP Laravel

Precisamos criar um aplicativo Laravel, para isso abra o terminal e digite o seguinte comando:

```bash
# Criando o projeto
$ composer create-project laravel/laravel house
```
`house` é o nome do meu projeto depois do `laravel/laravel` você pode escolher o nome que quiser para seu projeto. Aguarte terminar o processo. 

Agora navegue até a pasta do seu novo projeto criado com o seguinte comando:

```bash
$ cd house
```
Depois, inicie o servidor do Laravel caso ele ainda não esteja em execução:
```bash
$ php artisan
```
Você poderá visitar seu aplicativo em https://localhost:8000
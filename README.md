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
`house` é o nome do meu projeto depois do `laravel/laravel` você pode escolher o nome que quiser para seu projeto. Aguarde terminar o processo. 

Agora navegue até a pasta do seu novo projeto criado com o seguinte comando:

```bash
$ cd house
```
Depois, inicie o servidor do Laravel caso ele ainda não esteja em execução:
```bash
$ php artisan serve
```
----
Você poderá visitar seu aplicativo em https://localhost:8000

<img src="https://raw.githubusercontent.com/miqueiasmedeiros/API-REGISTER-USER/main/images/localhost.png">

Depois, executei o seguinte comando para criar um banco de dados no aplicativo:

```bash
$ mysql -u root -p
```
Haverá uma solicitação para você digitar sua senha do MySQL se tiver definido uma ao fazer a autenticação com o MySQL. Execute este comando para criar um banco de dados chamado `house`:
Por padrão do MySQL o usuário é root e a senha é em `branco`.

### Criando o Banco de Dados

```bash
mysql> CREATE DATABASE ´house´;
```
Saia do banco para criarmos a migration.

```bash
mysql> exit
```
---
Agora vou criar um modelo juntamente com a migration:

```bash
$ php artisan make:model Student -m
```
Um novo arquivo chamado `Student.php` será criado no diretório `app.`

Modifiquei o arquivo para especificar a tabela do banco de dados e os campos que poderão ser escritos.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $table = 'students';

    protected $fillable = ['name', 'course'];
}
```

Além disso, um arquivo de migration (migração) foi criado no diretório `database/migrations` para gerar nossa tabela. Você terá que modificar o arquivo de migration (migração) para `name` e `course` que aceitará valores de string.

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Student;

class CreateStudentsTable extends Migration
{
   
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('course');
            $table->timestamps();
        });
    }
```
Em seguida, você pode abrir a pasta do projeto em seu editor de texto preferido e modificar o arquivo `.env` para inserir suas credenciais de banco de dados adequadas. Isso permitirá que o aplicativo se conecte corretamente ao banco de dados recém-criado:

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=house
DB_USERNAME=root
DB_PASSWORD=

```
Em seguida, você executará a migração usando o seguinte comando:

```php
$ php artisan migrate
```
## ⚙️ Configurando as rotas
Agora que temos a noção básica da configuração do aplicativo, podemos executar o seguinte comando para continuar a criar um controlador que conterá os métodos da nossa API:

```php
$ php artisan make:controller HouseController
```
Você encontrará um novo arquivo chamado `HouseController.php` no diretório `app\http\controllers`. Em seguida, podemos adicionar os seguintes métodos:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class HouseController extends Controller
{
    public function getAllStudents() {
      $students = Student::get()->toJson(JSON_PRETTY_PRINT);
      return response($students, 200);
      }
  
      public function createStudent(Request $request) {        
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();
    
        return response()->json([
            "message" => "student record created"
        ], 201);
      }
  
      public function getStudent($id) {
        if (Student::where('id', $id)->exists()) {
          $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($student, 200);
        } else {
          return response()->json([
            "message" => "Student not found"
          ], 404);
        }
        
      }
  
      public function updateStudent(Request $request, $id) {
        if (Student::where('id', $id)->exists()) {
          $student = Student::find($id);
          $student->name = is_null($request->name) ? $student->name : $request->name;
          $student->course = is_null($request->course) ? $student->course : $request->course;
          $student->save();
  
          return response()->json([
              "message" => "records updated successfully"
          ], 200);
          } else {
          return response()->json([
              "message" => "Student not found"
          ], 404);
        }

      }
  
      public function deleteStudent ($id) {
        if(Student::where('id', $id)->exists()) {
          $student = Student::find($id);
          $student->delete();
  
          return response()->json([
            "message" => "records deleted"
          ], 202);
        } else {
          return response()->json([
            "message" => "Student not found"
          ], 404);
        }
      
      }
}

```

Vá para o diretório `routes`, abra o arquivo `api.php` e crie os endpoints que referenciarão os métodos criados anteriormente no HouseController.

```php
<?php

Route::get('students', 'HouseController@getAllStudents');
Route::get('students/{id}', 'HouseController@getStudent');
Route::post('students', 'HouseController@createStudent');
Route::put('students/{id}', 'HouseController@updateStudent');
Route::delete('students/{id}','HouseController@deleteStudent');

```

<strong>Nota:</strong> todas as rotas em `api.php` são prefixadas com `/api` por padrão.

### Importante verificar se as rotas estão funcionando:

* Inicie o servidor do Laravel:

```bash
$ php artisan serve
```
* Em seguida execute o seguinte comando:

```bash
$ php artisan route:list
```
> Este é o resultado esperado:
<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/routes%20expectative.png?raw=true">

### :no_entry: Caso retorne com o seguinte erro:

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/routeError.png?raw=true">

### ✅ Solução:

* Navegue até a pasta Providers e procure o arquivo `RouteServiceProvider.php`:

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/solucion.png?raw=true">

* Procure por `// protected $namespace = 'App\\Http\\Controllers';` e Remova a `//` . Este procedimento vai resolver o erro de rota.

```php
.
.
.
class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

.
.
.
```

> Execute novamente o comando:
```bash
$ php artisan route:list
```
## ⚙️ Configurando o Postman 

* Abra o Postman, vá até `Environments` e faça a seguinte configuração:

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/EnvironmentsPostman.png?raw=true">

* Agora abra o `Collections` clique no sinal de `+` e renomeie como preferir, neste exemplo vou colocar o nome `API-REGISTER-USER`.

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/Collections.png?raw=true">

* Vamos adicionar nossa primeira `Request` com o método `POST`: 
* Importante verificar a `variável de ambiente, método do tipo POST, formato do Body e a rota.`

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/CreateStudent.png?raw=true"> 

# 🧪 Testando a API 🧪

## 📮 POST
Para testar o primeiro endpoint, abra o Postman e faça uma solicitação `POST` para `http://localhost:8000/api/students`.

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/POST.png?raw=true"> 

* Ele funcionou se retornar a mensagem de sucesso junto com o código de resposta `201`.

## 🗃️ Vamos verificar no Banco de Dados
---
<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/db.png?raw=true"> 

---

## 📥 GET

### Retornar todos os registros de alunos

Agora, vamos visitar o method (método) getAllStudents no HouseController

* Com o app em execução, faça uma solicitação `GET` para o endpoint `/api/students` no Postman.

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/GET.png?raw=true"> 

## 📥 GET

### Retornar um registro de aluno

Agora vou fazer uma solicitação `GET` para o endpoint `/api/students/{id}.` `{id}` vai ser id de um registro existente no banco de dados. A solicitação deve retornar apenas um registro específico.

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/GetStudent.png?raw=true">

Como visto na imagem acima, fiz uma solicitação para `http://localhost:8000/api/students/9` e os detalhes do aluno atribuído a esse `id` foram retornados. 

## 🔄 PUT

### Atualizar um registro de aluno

Este método tem como objetivo atualizar um registro de aluno em nosso banco de dados.

<img src="https://github.com/miqueiasmedeiros/API-REGISTER-USER/blob/main/images/PUT.png?raw=true">
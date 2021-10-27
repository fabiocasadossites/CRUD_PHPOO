# CRUD system with PHP 7.4, PDO and JWT authentication

<hr>

## Important

- Open-source software system developed and maintained by:

  #### Fabio Augusto

  <p>Full PHP developer, Creator no Experts Club na Rocketseat.</p>

  [Github](https://github.com/fabiocasadossites).
  [Linkedin](https://www.linkedin.com/in/fabioasa/).
  [Rocketseat](https://app.rocketseat.com.br/me/fabio-augusto).

#### We are still going to develop (Coming soon)

- Authentication with JWT;
- Rest API system;
- Componentization with Json;
- Among other things;

## About

CRUD system (Register, Change, Read, Delete) with database, in PDO/PHPOO, with MySQL, but it can be changed to any database.

<p>
Developed with generic functions to be used with or without the creation of specific classes for each case and with the security of PDO.
</p>

## Integrações

- Composer;
- Configuration of the getenv();
- Convention do /Vendor;
- Folder Structure for Projects;

## Functionalities

After cloning the repository, don't forget to create the .env inside the /app folder;

###### file .env

```

#CONFIGURAÇÕES DO BANCO DE DADOS
HOST= HOST DO BANCO DE DADOS
USER= USUÁRIO
PASS= SENHA
DBSA= NOME DO BANDO
#CONFIGURAÇÕES DE E-MAIL
MAILUSER= E-MAIL DE ENVIO
MAILPASS= SENHA DO ENVIO
MAILPORT= PORTA
MAILHOST= HOST / MAIL
ANSWER= E-MAIL DE RESPOSTA
#CHAVE JWT
JWT= CHAVE DO JWT
#TOKEN
TOKEN= TOKEN DE IDENTIFICAÇÃO DO PROJETO
#OUTRAS INFORMAÇÕES
HOME= ENDEREÇO CO PROJETO
NAME= MOME DO PROJETO
IMAGENS= ENTEREÇO DAS IMAGENS

```

Don't forget to change and update the composer.json

```
composer update
```

## Examples

```php

require __DIR__ . '/Bootstrap/app.php';
use \App\Db\Database;

// Register in the database

  //Under development


// read from database

$where = 'status=1';
$order = '';
$limit = '';
$lista = (new Database('BANK_TABLE'))->select($where)->fetchAll(PDO::FETCH_CLASS);
  if (!$lista) {
      echo 'There are no users in the bank';
    } else {
      foreach ($lista as $vaga) {
    }
  }


// Read in free database to mount select

$select = 'SELECT * from BANK_TABLE';
$lista = (new Database())->fullSelect($select)->fetchAll(PDO::FETCH_CLASS);
  if (!$lista) {
     echo 'does not exist';
   } else {
     foreach ($lista as $vaga) {
     }
    echo '<pre>';
    print_r($vaga);
    echo '</pre>';
   }



// Update the database

$data = [
   'nome' => 'Fabio',
   'data_nasc' => '10/07/1981',
   ];
$id = '9';
$update = (new Database('BANK_TABLE'))->update('id = ' . $id, $data);
  if ($update >= 1) {
   echo '<pre>';
   print_r($update);
   echo '</pre>';
  } else {
   echo 'error updating';
  }



// Delete from database

$id = '11';
$delete = (new Database('BANK_TABLE'))->delete('id = ' . $id);
  if ($delete >= 1) {
   echo '<pre>';
   print_r($delete);
   echo '</pre>';
  } else {
   echo 'not deleted';
  }


```

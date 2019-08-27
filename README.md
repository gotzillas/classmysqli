# PDO MYSQL GOTZILLAS

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

DB is a Mysql PDO easy CRUD.

  - Query
  - Insert
  - Update
  - Delete

# New Features!

  - Proted
  - DateThai
  - Datethaitime
  - encode_key
  - decode_key

You can also:
  - git clone https://github.com/gotzillas/classmysqli
  - use new DB 
  - create new php file
  - include DB.php file and new class <?php incude('DB.php'); $db = new DB(); ?>
  - $db->select("table_name",['columnd__where' => 'value_where' , 'ccolumnd__where_and','value_where']);
  - $db->insert("table_name",['columnd_insert' => 'value_insert']);
  - $db->update("table_name",['columnd_update' => 'value_update'],"id=xxx");

### Installation

DB requires [PHP 5.6]

Install the dependencies and devDependencies and start the server.

```sh
$ git clone https://github.com/gotzillas/classmysqli
$ echo <?php incude('DB.php'); $DB = new DB(); $DB->query("select * from table_name"); ?>
$ php -S 0.0.0.0:8080
```

License
----
MIT
**Free Software, Hell Yeah!**

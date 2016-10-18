<?php
date_default_timezone_set('Asia/Bangkok');
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', '');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

class db
{
    
    public $db = null;
    public $model = null;
    function __construct()
    {
        try {
             $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            exit('ไม่สามารถเชื่อมต่อ Database ได้.');
        }
    }

    public  $data_key = 'ADASBDNMBSMDNBKASOPEJRLKE=HACKPORMUNGTAI=DEVELOPERTHAI855';

    public function proted($data)
    {
      $new_string = preg_replace('~[^a-zA-Z0-9]+~', '', $data);

      return $new_string;
    }


    public function query($str_command)
    {
        $query = $this->db->prepare($str_command);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query->execute();
        return $query->fetchAll();
    }


    public function select($table_name,$where = null , $other = null)
    {
      $sql = "SELECT * from "."`$table_name`";
      if($where != null)
      {
       $sql .= " WHERE ";
       $index = 0 ;
       foreach ($where as $key => $value) {
           $sql .=  "$key" . ' = ' . ":$key";
           if (sizeof($where) > 1 && $index != (sizeof($where)-1) ) {
               $sql .= " AND ";
           }
           $index++;
       }

       if($other != null)
       {
        $sql .= " ".$other;
       }

       $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
       $query = $this->db->prepare($sql);
       $parameters = array();
       foreach ($where as $key => $value) {
           $parameters[':'.$key] = "{$value}";
       }
       $query->execute($parameters);
      }
      else
      {
         $query = $this->db->prepare($sql);
         $query->execute();
      }

      return $query->fetchAll();

    }


    public function insert($tableName,$data)
    {
        $keys = array_keys($data);
        $sql = "INSERT INTO " . "$tableName" .'(' ;
        for($i=0;$i<sizeof($keys);$i++){
           $sql .= $keys[$i] ;
           if ($i != (sizeof($keys)-1) ) {
               $sql .= ",";
           }
       }

       $sql .= ') VALUES (';
       for($i=0;$i<sizeof($keys);$i++){
           $sql .= ':'.$keys[$i];
           if ($i != (sizeof($keys)-1) ) {
               $sql .= ",";
           }
       }
       $sql .= ')';

        $index = 0;
        $parameters = array();
       foreach ($data as $key => $value) {
           $parameters[':'.$key] = "{$value}";
           $index ++ ;
       }
       $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        
        return $this->db->lastInsertId();
    }


    public function delete($tableName,$data)
    {
        $keys = array_keys($data);
       $sql="DELETE FROM " . "`$tableName`" ." WHERE ";
       $index = 0 ;

       foreach ($data as $key => $value) {
           $sql .=  "$key" . ' = ' . ":$key";
           if (sizeof($data) > 1 && $index != (sizeof($data)-1) ) {
               $sql .= " AND ";
           }
           $index++;
       }
        $query = $this->db->prepare($sql);
        $index = 0;
        $parameters = array();
       foreach ($data as $key => $value) {
           $parameters[':'.$key] = "{$value}";
           $index ++ ;
       }

       $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query->execute($parameters);
    }


     public function update($tableName,$data,$where){

        $keys = array_keys($data);
        
        $sql="UPDATE ".$tableName." SET ";
        
        $index = 0 ;
        
        foreach ($data as $key => $value) {
           $sql .= $key . ' = ' . ":{$key}" ;
           if ($index != (sizeof($data) -1)) {
               $sql .= ',';
           }
            $index++;
        }
        $index = 0 ;
        $keys = array_keys($where);
        $sql .= " WHERE ";
        foreach ($where as $key => $value) {
            $sql .= $key . ' = ' . ":{$key}";
            if ($index < 1 && $index != ( sizeof($where)- 1)) {
                $sql .= " AND ";
            }
            $index++;
        }
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query = $this->db->prepare($sql);
        $parameters = array();
          foreach ($data as $key => $value) {
            $parameters[':'.$key] = $value;

             foreach ($where as $key2 => $value2) {
                $parameters[':'.$key2] = $value2;
             }
        }

        $query->execute($parameters);
     }



      public function DateThai($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

    $strMonthThai=$strMonthCut[$strMonth];

    return "$strDay $strMonthThai $strYear";

    }

    public function Datethaitime($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
  }


  public function encode_key($str,$key)
  {

      $key = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key),$str, MCRYPT_MODE_CBC, md5(md5($key))));

      return $key;
  }

  public function decode_key($str,$key)
  {
      $key = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($str), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

      return $key;
  }



}

<?php

class defaultModel
{
	public function getList()
	{
	    $db = $this->dbConnect();
      	$list = array();
      	if($db) {
         $query = 'SELECT DISTINCT
               rates.part AS part,
               groups.id AS group_id,
               groups.title AS group_title,
               students.id AS student_id,
               students.name AS student_name,
               students.surname AS student_surname,
               students.group_id AS student_group_id,
               students.birth AS student_birth,
               students.email AS student_email,
               students.ip AS student_ip,
               students.time AS student_time,
               ROUND(AVG(rates.rate), 2) AS average,
               students.comment AS student_comment
             FROM
               rates
               INNER JOIN students ON (rates.student_id = students.id)
               INNER JOIN groups ON (students.group_id = groups.id)
               INNER JOIN subjects ON (rates.subject_id = subjects.id)
            GROUP BY
               part,
               student_id,               
               group_title';

         if ($result = $db->query($query)) {

             while ($row = $result->fetch_object()) {
                 $list[] = $row;
             }
         }
      }

      return $list;	
	}

	public function getRates()
	{
		$db = $this->dbConnect();
	    $rates = array();
	      
	      if($db) {
	         
	         $query = '
	            SELECT DISTINCT
	               rates.part AS part,
	               students.id AS student_id,
	               subjects.subject AS subject_name,
	               rates.rate AS rate,
	               ROUND(AVG(rates.rate), 2) AS average
	             FROM
	               rates
	               INNER JOIN students ON (rates.student_id = students.id)
	               INNER JOIN groups ON (students.group_id = groups.id)
	               INNER JOIN subjects ON (rates.subject_id = subjects.id)
	            GROUP BY
	               part,
	               student_id,
	               subject_name';

	         if ($result = $db->query($query)) {

	             while ($row = $result->fetch_object()) {
	                 $rates[] = $row;
	             }
	         }
	      }

	      return $rates;
	}

	private function dbConnect() 
	{
      
      require 'config.conf';

      $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);

      if ($mysqli->connect_error) {
         //die('Ошибка подключения (' . $db_server->connect_errno . ') '. $db_server->connect_error);
         return false;
      }

      return $mysqli;
    }

    public function updateRow($data)
	{
        $db = $this->dbConnect();


        if($db) {
         
            $query = 'UPDATE  students.students SET  `group_id` =  '.$data['edit_group'].' WHERE students.id = '.$data['student_id'].';';
        
	        if($result = $db->query($query)){
	            return true;
	        } else {
	            $error = "Ошибка: %s\n" . $db->error;

	            return $error;
	        }
        } else {
            $error = "Ошибка: %s\n" . $db->error;

	        return $error;
        }
	}

	public function addStudent($data)
	{
        $db = $this->dbConnect();

	    if($db) {
	         //insert values from form
	         $query_1 = 'INSERT INTO students (name, surname, group_id, birth, email, ip, time)
	         VALUES ("'.$data['name'].'", "'.$data['surname'].'","'.$data['group'].'", "'.$data['birth_date'].'", "'.$data['email'].'", "'.$data['ip'].'", "'.$data['date'].'")';
	         
	         if ($result_1 = $db->query($query_1)) {
	            //insert random rates
	            $query_2 = 'INSERT INTO rates (part, student_id, subject_id, rate)
	         VALUES ("'.mt_rand(1, 8).'", LAST_INSERT_ID(), "'.mt_rand(1, 4).'", "'.mt_rand(2, 5).'")';

	            if($result_2 = $db->query($query_2)){
	               //var_dump($result_1);
	               //var_dump($query_1);
	              echo 'Student add sucess!';

	            } else {
	            printf("Ошибка: %s\n", $db->error);
	            }
	         } else {
	            printf("Ошибка: %s\n", $db->error);
	         }
	      }
	}

	public function getTop($count)
	{
	    $db = $this->dbConnect();
	    $top = array();
	    if($db) {
	        $query = 'SELECT DISTINCT
	        students.name AS student_name,
	        students.surname AS student_surname,
	        groups.title AS group_title,
	        students.email AS student_email,
	        ROUND(AVG(rates.rate), 2) AS average
	      FROM
	        rates
	        INNER JOIN students ON (rates.student_id = students.id)
	        INNER JOIN groups ON (students.group_id = groups.id)
	        INNER JOIN subjects ON (rates.subject_id = subjects.id)
	        INNER JOIN rates rates1 ON (students.id = rates1.student_id)
	        AND (subjects.id = rates1.subject_id)
	        INNER JOIN groups groups1 ON (students.group_id = groups1.id)
	      GROUP BY
	        student_name,
	        student_surname,
	        group_title,
	        student_email
	      ORDER BY
	        average DESC
	      LIMIT '.$count.' ;';

	         if ($result = $db->query($query)) {

	             while ($row = $result->fetch_object()) {
	                 $top[] = $row;
	             }
	         }
	      }

	      return $top;	
	}

	public function getRow($id)
	{
	    $db = $this->dbConnect();

	    if($db) {
	        $query = 'SELECT students.id AS student_id,
               students.name AS student_name,
               students.surname AS student_surname,
               students.group_id AS student_group_id,
               students.birth AS student_birth,
               students.email AS student_email,
               students.ip AS student_ip,
               students.time AS student_time,
				groups.title
			FROM `students`, `groups` 
			WHERE students.id = '.$id.' 
			AND groups.id = students.group_id';

	         if ($result = $db->query($query))
	         	$row = $result->fetch_object();
	      }

	      return $row;	
	}

	public function getGroups()
	{
	    $db = $this->dbConnect();
	    $groups = array();

	    if($db) {
	        $query = 'SELECT * FROM `groups`';

	         if ($result = $db->query($query)) {

	             while ($row = $result->fetch_object()) {
	                 $groups[] = $row;
	             }
	         }
	      }

	      return $groups;	
	}
}
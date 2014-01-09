<?php

/*
CREATE TABLE deputes (
deputes_id int(11) NOT NULL AUTO_INCREMENT,
nom varchar(255) DEFAULT NULL,
prenom varchar(255) DEFAULT NULL,
civilite varchar(255) DEFAULT NULL,
groupe varchar(255) DEFAULT NULL,
departement varchar(255) DEFAULT NULL,
circonscription TINYINT DEFAULT NULL,
commission varchar(255) DEFAULT NULL,
contact TEXT,
PRIMARY KEY (deputes_id)
)
*/

class database {
	const DB_HOST = 'localhost';
  const DB_NAME = 'AN';
  const DB_USER = 'root';
  const DB_PASSWORD = 'root';

	private $conn = null;

	/**
	 * Open the database connection
	 */
	public function __construct(){
		$connectionString = sprintf("mysql:host=%s;dbname=%s",
				database::DB_HOST,
				database::DB_NAME);
		try {
			$this->conn = new PDO($connectionString,
					database::DB_USER,
					database::DB_PASSWORD);
		} catch (PDOException $pe) {
			die($pe->getMessage());
		}
	}


  /**
   * update an existing task in the tasks table
   * @param string $nom
   * @param string $prenom
   * @return mixed returns false on failure
   */
  public function update($id,$subject,$description,$startDate,$endDate) {
      $task = array(
							':taskid' => $id,
              ':subject' => $subject,
              ':description' => $description,
              ':start_date' => $startDate,
              ':end_date' => $endDate);

      $sql = 'UPDATE tasks
          SET subject = :subject,
              start_date = :start_date,
              end_date = :end_date,
              description = :description
          WHERE task_id = :taskid';

      $q = $this->conn->prepare($sql);

      return $q->execute($task);
  }

  /**
   * Perform a request in db
   * @param string $sql
   * @return array indexed by column name
   */
  public function queryArrayFetch($sql) {
    $q = $this->conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
    return $q;
  }

  /**
   * Request every lines in db
   * @return array indexed by column name
   */
  public function queryArrayFetchAll() {
    $q = $this->conn->query('SELECT * from deputes;');
    $q->setFetchMode(PDO::FETCH_ASSOC);
    return $q;
  }

  /**
   * insert a new task into the tasks table
   * @param string $nom
   * @param string $description
   * @return mixed returns false on failure
   */
  function insertSingleRow($civilite,$prenom,$nom,$groupe,$departement,$circonscription,$commission,$contact) {
      $task = array(
				':civilite' => $civilite,
        ':prenom' => $prenom,
				':nom' => $nom,
				':groupe' => $groupe,
				':dpt' => $departement,
				':circ' => $circonscription,
				':commission' => $commission,
				':contact' => $contact);
      $sql = 'INSERT INTO deputes
        (civilite,prenom,nom,groupe,departement,circonscription,commission,contact)
        VALUES
        (:civilite,:prenom,:nom,:groupe,:dpt,:circ,:commission,:contact)';
      $q = $this->conn->prepare($sql);
      return $q->execute($task);
  }


  /**
   * close the database connection
   */
  function __destruct() {
      $this->conn = null;
  }

}
?>
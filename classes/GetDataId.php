<?php

/**
 * GetArticleId
 * 
 * A piece of writing for publication by identifying the id
 */
class GetDataId
{
    public $id;
    public $customer_name;
    public $room_type;
    public $booking_date;
    public $booking_time;


    /**
     * Get the article record based on the ID
     * 
     * @param object $conn connection to the database
     * @param integer $id the article ID
     * 
     * @return mixed An object of this class, or null if not found
     */

    public static function getDataById($conn, $id){
        // This GETS an article row from the database by id
        // in PDO we can use "?" or ":id" but the latter is best, any name can be used other than "id" jsyk 
        $sql = "SELECT * FROM rooms_record WHERE id = :id"; 

        // Prepares a statement for execution and returns a PDOstatement object
        $stmt = $conn->prepare($sql);

        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that was used to prepare the statement. 
        // NB: PARAM_INT for int type of parameter, PARAM_STR for string type of parameter, PARAM_BOOL for boolean type of parameter
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Set the default fetch mode for this statement
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'GetDataId');

        // Executes a PDO prepared statement
        $result = $stmt->execute();

        if ($result === true) {
            
            // Fetches the next row from a result set in an object format
            return $stmt->fetch();
        }
    }

    


     /**
     * Update the article with its current property values
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the update was successful, false otherwise
     */
     
    public function updateData($conn)
    {
            
        // update the data into the database server
        $sql = "UPDATE rooms_record 
                SET customer_name = :customer_name, 
                    room_type = :room_type,  
                    booking_date = :booking_date, 
                    booking_time = :booking_time
                WHERE id = :id";

        // Prepares the statement for execution
        $stmt = $conn->prepare($sql);

        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that was used to prepare the statement. 
        // NB: PARAM_INT for int type of parameter, PARAM_STR for string type of parameter, PARAM_BOOL for boolean type of parameter
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':customer_name', $this->customer_name, PDO::PARAM_STR);
        $stmt->bindValue(':room_type', $this->room_type, PDO::PARAM_STR);
        $stmt->bindValue(':booking_date', $this->booking_date, PDO::PARAM_STR);
        $stmt->bindValue(':booking_time', $this->booking_time, PDO::PARAM_STR);

        // Executes a PDO prepared statement
        $result = $stmt->execute();

        return $result;
       
    }


    
    /**
     * Delete the current article
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the delete was successful, false otherwise
     */

    public function deleteData($conn)
    {
        // update the data into the database server
        $sql = "DELETE FROM rooms_record 
                WHERE id = :id";

        // Prepares the statement for execution
        $stmt = $conn->prepare($sql);

        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that 
        // was used to prepare the statement
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        // Executes a PDO prepared statement
        $result = $stmt->execute();

        return $result;
    }



     /**
     * Insert a new the article with its current property values
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the insert was successful, false otherwise
     */
     
     public function newData($conn)
     {
             
        // Update the data into the database server
        $sql = "INSERT INTO rooms_record (customer_name, room_type, booking_date, booking_time)
                VALUES (:customer_name, :room_type, :booking_date, :booking_time)";
 
        // Prepares the statement for execution
        $stmt = $conn->prepare($sql);
 
        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that was used to prepare the statement. 
        $stmt->bindValue(':customer_name', $this->customer_name, PDO::PARAM_STR);
        $stmt->bindValue(':room_type', $this->room_type, PDO::PARAM_STR);
        $stmt->bindValue(':booking_date', $this->booking_date, PDO::PARAM_STR);
        $stmt->bindValue(':booking_time', $this->booking_time, PDO::PARAM_STR);
 
        // Executes a PDO prepared statement
        $result = $stmt->execute();
 
        if ($result){
            // gets the last id
            $this->id = $conn->lastInsertId();
            return true;

        }
        /*
        if ($result) {
            // gets the last id
            $id = $conn->lastInsertId();
            return $id;
        }*/
 
     }

}
<?php

/**
 * Article
 * 
 * A piece of writing for publication
 */
class GetAll
{
    
    /**
     * Get all the articles
     * @param object $conn Connection to the database
     * @return array An associative array of all the article records
     */

    public static function getAll($conn)
    {

        // READING FROM THE DATABASE AND CHECKING FOR ERRORS
        $sql = "SELECT * 
                FROM rooms_record
                ORDER BY booking_date, booking_time DESC;";

        // Execute the sql statement, returning a result set as a PDOStatement object
        $results = $conn->query($sql); 

        $data = $results->fetchAll(PDO::FETCH_ASSOC);
        //print_r($data);  prints an associative array

        return $data;
    }
    
}
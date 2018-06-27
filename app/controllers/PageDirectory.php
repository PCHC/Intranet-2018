<?php

namespace App;

use Sober\Controller\Controller;

class PageDirectory extends Controller
{
  public $db;
  public $query = 'SELECT * FROM EmployeeContactInfo';
  private $queryResults;

  public function __construct() {
    $this->db = $this->dbConnect();
    //mssql_select_db('pchc', $this->link);
  }

  private function doQuery($clause = '') {
    if( $clause ) {
      $clause = ' ' . $clause;
    }

    //$this->dirQueryResults = mssql_query($this->dirQuery . $clause, $this->link, 1000);

    $sth = $this->db->prepare($this->query . $clause);
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
  }

  private function getLocations($locationFilter = '') {
    if($locationFilter) {
      $locations[] = $locationFilter;
    } else {
      $locations = $this->allLocations();
    }
    return $locations;
  }

  public static function returnResults($locationFilter = null, $search = null) {
    if( $search ) {
      return $this->search($search);
    }

    $locations = $this->getLocations( $locationFilter );
    foreach($locations as $location) {
      if($location == NULL) continue;
      $results[$location] = $this->getLocationEmployees($location);
    }
    return $results;
  }

  public function allLocations() {
    $locationsQuery = $this->db->query('SELECT DISTINCT BranchName FROM EmployeeContactInfo');
    while( $location = $locationsQuery->fetch() ) {
      $locations[] = $location[0];
    }
    return $locations;
  }

  private function getLocationEmployees($location='') {
    $results = $this->doQuery('WHERE BranchName="'.$location.'" ORDER BY LN, FN');
    return $results;
  }

  private function search($search = '') {
    return $this->doQuery('WHERE LN LIKE "%' . $search . '%" OR FN LIKE "%' . $search . '%" ORDER BY LN, FN');
  }

  private function filterEmail($email) {
    $email = str_replace('@pchcbangor.org', '@pchc.com', $email);
    return $email;
  }

  private function dbConnect() {
    /** The name of the database */
    $EE_DB_NAME = 'pchc';

    /** SQL database username */
    $EE_DB_USER = 'Intranet';

    /** SQL database password */
    $EE_DB_PASSWORD = 'Intranet';

    /** SQL hostname */
    $EE_DB_HOST = 'ps-daily-rpt.pchc.local';
    $EE_DB_HOST_IP = '10.1.2.35';

    // Connect to MSSQL
    try {
      $db = new \PDO("sqlsrv:Server=".$EE_DB_HOST.";Database=".$EE_DB_NAME, $EE_DB_USER, $EE_DB_PASSWORD);
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }

    return $db;
  }
}

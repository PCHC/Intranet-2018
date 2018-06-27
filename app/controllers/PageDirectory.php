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

  public function doQuery($clause = '') {
    if( $clause ) {
      $clause = ' ' . $clause;
    }

    //$this->dirQueryResults = mssql_query($this->dirQuery . $clause, $this->link, 1000);

    $query = $this->db->query($this->query . $clause);
    $this->$queryResults = $query->fetch();
  }

  public function results($clause = '') {
    return $this->employees();
    $this->doQuery($clause);
  }

  public function allLocations() {
    $locationsQuery = $this->db->query('SELECT DISTINCT BranchName FROM EmployeeContactInfo');
    while( $location = $locationsQuery->fetch() ) {
      $locations[] = $location[0];
    }
    return $locations;
  }

  public function locations($locationFilter = '') {
    if($locationFilter) {
      $allLocations[] = $locationFilter;
    } else {
      $allLocations = $this->allLocations();
    }
    return $allLocations;

  }

  public function search($search = '') {
    $this->results('WHERE LN LIKE "%' . $search . '%" OR FN LIKE "%' . $search . '%" ORDER BY LN, FN');
  }

  protected function employees() {
    return $this->$queryResults;
  }

  protected function filterEmail($email) {
    $email = str_replace('@pchcbangor.org', '@pchc.com', $email);
    return $email;
  }

  protected function dbConnect() {
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

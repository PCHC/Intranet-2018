<?php

namespace App;

use Sober\Controller\Controller;

class PageDirectory extends Controller
{
  private $db;
  private $connectionOptions = array(
    "Database" => "pchc",
    "Uid" => "Intranet",
    "PWD" => "Intranet",
  );
  public $locationFilter = null;
  public $search = null;
  private $baseQuery = "SELECT * FROM EmployeeContactInfo";

  public function __construct()
  {
    $this->db = $this->dbConnect();
    $this->locationFilter = !empty($_GET['BranchName']) ? $_GET['BranchName'] : '';
    $this->search = !empty($_GET['search']) ? $_GET['search'] : '';
  }

  private function doQuery($clause = '')
  {
    $query = $this->baseQuery;
    if ($clause) {
      $query = $query . ' ' . $clause;
    }

    $sth = $this->db->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
  }

  public function getLocations()
  {
    if ($this->locationFilter) {
      $locations[] = $this->locationFilter;
    } else {
      $locations = $this->getAllLocations();
    }
    return $locations;
  }

  public function getAllLocations()
  {
    $query = $this->db->prepare("SELECT DISTINCT BranchName FROM EmployeeContactInfo");
    $query->execute();
    while ($location = $query->fetch()) {
      $locations[] = $location[0];
    }
    return $locations;
  }

  public function getEmployees($location = null, $sort = null)
  {
    if ($this->search) {
      $employees['header'] = 'Search results for "' . $this->search . '"';
      $employees['employees'] = $this->doSearch($this->search);
      return $employees;
    }

    $branchName = $this->locationFilter ? $this->locationFilter : $location;
    if ($branchName) {
      $employees['header'] = $branchName;
      $employees['employees'] = $this->doQuery("WHERE BranchName='".$branchName."' ORDER BY LN, FN");
    }
    return $employees;


    $locations = $this->getLocations();
    foreach ($locations as $location) {
      if ($location == null) {
          continue;
      }
      $allEmployees[$location] = $this->getLocationEmployees($location);
    }
    return $allEmployees;
  }

  private function getLocationEmployees($location = '')
  {
    $results = $this->doQuery("WHERE BranchName='".$location."' ORDER BY LN, FN");
      return $results;
  }

  private function doSearch($search = '')
  {
    $searchQuery = $this->doQuery("WHERE LN LIKE '%".$search."%' OR FN LIKE '%".$search."%' ORDER BY LN, FN");
      return $searchQuery;
  }

  private function dbConnect()
  {
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

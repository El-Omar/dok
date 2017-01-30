<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'EventDAO.php';

class EventsController extends Controller {

  private $eventDAO;

  function __construct() {
    $this->eventDAO = new EventDAO();
  }

  public function index() {
    $allEvents = $this->eventDAO->selectAll();
    $upcomingEvents = [];

    for ($i = 0; $i < 3; $i++) {
      $event = $allEvents[$i];
      if ($tags = $this->eventDAO->selectTagsByEventId($event["id"])) {
        $event["tags"] = $tags;
      }
      $upcomingEvents[$event["id"]] = $event;
    }

    $this->set('events', $upcomingEvents);

    // $conditions = array();

    //example: search on title
    // $conditions[0] = array(
    //   'field' => 'title',
    //   'comparator' => 'like',
    //   'value' => 'schoen'
    // );

    //example: search on location_id
    // $conditions[0] = array(
    //   'field' => 'location_id',
    //   'comparator' => '=',
    //   'value' => 4
    // );

    //example: search on location name
    // $conditions[0] = array(
    //   'field' => 'location',
    //   'comparator' => 'like',
    //   'value' => 'strand'
    // );

    //example: search on organiser id
    // $conditions[0] = array(
    //   'field' => 'organiser_id',
    //   'comparator' => '=',
    //   'value' => '1'
    // );

    //example: search on organiser id
    // $conditions[0] = array(
    //   'field' => 'organiser',
    //   'comparator' => 'LIKE',
    //   'value' => 'gent'
    // );

    //example: search on tag name
    // $conditions[0] = array(
    //   'field' => 'tag',
    //   'comparator' => '=',
    //   'value' => 'gastvrijheid'
    // );

    //example: events ending in may 2017
    // $conditions[0] = array(
    //   'field' => 'end',
    //   'comparator' => '>=',
    //   'value' => '2017-05-01 00:00:00'
    // );
    // $conditions[1] = array(
    //   'field' => 'end',
    //   'comparator' => '<',
    //   'value' => '2017-06-01 00:00:00'
    // );

    //example: events happening on march first
    // $conditions[0] = array(
    //   'field' => 'start',
    //   'comparator' => '<=',
    //   'value' => '2017-03-01 00:00:00'
    // );
    // $conditions[1] = array(
    //   'field' => 'end',
    //   'comparator' => '>=',
    //   'value' => '2017-03-01 00:00:00'
    // );

    //example: search on location, with certain end date + time
    // $conditions[0] = array(
    //   'field' => 'location',
    //   'comparator' => 'like',
    //   'value' => 'voortuin'
    // );
    // $conditions[1] = array(
    //   'field' => 'end',
    //   'comparator' => '=',
    //   'value' => '2017-05-01 19:00'
    // );

    // $events = $this->eventDAO->search($conditions);

  }

  public function schedule() {
    $this->setMonths();
    $this->setEvents();
    $this->monthSubmit();
  }

  private function setMonths() {
    $eventMonths = $this->eventDAO->selectMonths();
    $months = [];

    foreach ($eventMonths as $month) {
      $monthName = "";
      switch ($month["month"]) {
        case 1:
        $monthName = "Jan";
        break;
        case 2:
        $monthName = "Feb";
        break;
        case 3:
        $monthName = "Maa";
        break;
        case 4:
        $monthName = "Apr";
        break;
        case 5:
        $monthName = "Mei";
        break;
        case 6:
        $monthName = "Jun";
        break;
        case 7:
        $monthName = "Jul";
        break;
        case 8:
        $monthName = "Aug";
        break;
        case 9:
        $monthName = "Sept";
        break;
        case 10:
        $monthName = "Oct";
        break;
        case 11:
        $monthName = "Nov";
        break;
        case 12:
        $monthName = "Dec";
        break;
      }
      $months[$month["month"]] = $monthName;
    }

    $this->set('months', $months);
  }

  private function setEvents() {
    $allEvents = $this->eventDAO->selectAll();
    $events = [];

    foreach ($allEvents as $event) {
      if ($tags = $this->eventDAO->selectTagsByEventId($event["id"])) {
        $event["tags"] = $tags;
      }
      $events[$event["id"]] = $event;
    }

    if ($this->isAjax) {
      header('Content-Type: application/json');
      echo json_encode($events);
      exit();
    }

    $this->set('events', $events);
  }

  private function monthSubmit() {
    if (isset($_GET["month"])) {
      //echo "<script>alert(".$_GET["month"].")</script>";
    }
  }
}

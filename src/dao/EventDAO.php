<?php
require_once __DIR__ . '/DAO.php';
class EventDAO extends DAO {

  public function selectById($id) {
    $sql = "SELECT * FROM `ma3_dok_events` WHERE `id` = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function selectAll() {
    $sql = "SELECT * FROM `ma3_dok_events` WHERE `end` > NOW() ORDER BY `start`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectMonths() {
    $sql = "SELECT MONTH(`start`) AS month FROM `ma3_dok_events` WHERE `end` > NOW() GROUP BY month";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectEventsByMonth($month) {
    $sql = "SELECT * FROM `ma3_dok_events` WHERE MONTH(`start`) = :month";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':month', $month);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectTagsByEventId($id) {
    $sql = "SELECT
      ma3_dok_tags.*,
      ma3_dok_events_tags.event_id
      FROM `ma3_dok_tags`
      RIGHT OUTER JOIN `ma3_dok_events_tags` ON ma3_dok_events_tags.tag_id = ma3_dok_tags.id
      WHERE ma3_dok_events_tags.event_id = :id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectTags() {
    $sql = "SELECT * FROM `ma3_dok_tags`";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function search($conditions = array()) {
    $sql = "SELECT DISTINCT
      ma3_dok_events.*,
      ma3_dok_organisers.name as organiser
      FROM `ma3_dok_events`
      INNER JOIN `ma3_dok_organisers` ON ma3_dok_events.organiser_id = ma3_dok_organisers.id
      LEFT OUTER JOIN `ma3_dok_events_locations` ON ma3_dok_events.id = ma3_dok_events_locations.event_id
      LEFT OUTER JOIN `ma3_dok_locations` ON ma3_dok_locations.id = ma3_dok_events_locations.location_id
      LEFT OUTER JOIN `ma3_dok_events_tags` ON ma3_dok_events.id = ma3_dok_events_tags.event_id
      LEFT OUTER JOIN `ma3_dok_tags` ON ma3_dok_tags.id = ma3_dok_events_tags.tag_id
      WHERE 1
    ";
    $conditionSqls = array();
    $conditionParams = array();
    //handle the conditions
    $conditionsSqls = array();
    $i = 0;
    foreach($conditions as &$condition) {
      if(empty($condition['comparator'])) {
        $condition['comparator'] = '=';
      }
      $comparator = DAO::getSanitizedComparator($condition['comparator']);
      $columnName = DAO::getSanitizedColumnName($condition['field']);
      //special columns?
      if($columnName == 'tag_id' || $columnName == 'tag') {
        //skip tags
        continue;
      }
      if($columnName == 'location_id') {
        $columnName = 'ma3_dok_locations.id';
      } else if($columnName == 'location') {
        $columnName = 'ma3_dok_locations.name';
      } else if($columnName == 'organiser') {
        $columnName = 'ma3_dok_organisers.name';
      }
      //handle functions
      if(!empty($condition['function'])) {
        $function = DAO::getSanitizedFunction($condition['function']);
        $columnName = "{$function}({$columnName})";
      }
      $conditionSqls[] = "{$columnName} {$comparator} :{$i}";
      if($comparator == 'like') {
        $conditionParams[$i] = '%' . $condition['value'] . '%';
      } else {
        $conditionParams[$i] = $condition['value'];
      }
      $i++;
    }
    if(!empty($conditionSqls)) {
      $sql .= 'AND ' . implode(' AND ', $conditionSqls);
    }

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($conditionParams);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(empty($result)) {
      return $result;
    }
    $eventIds = $this->_getEventIdsFromResult($result);
    $tagsByEventId = $this->_getTagsForEventIds($eventIds);
    $locationsByEventId = $this->_getLocationsForEventIds($eventIds);
    //handle the tags & locations in the foreach loop - we want to see all tags for a given event
    $return = array();
    foreach($result as &$row) {
      $skipRow = false;
      $row['tags'] = array();
      if(!empty($tagsByEventId[$row['id']])) {
        $row['tags'] = $tagsByEventId[$row['id']];
      }
      $row['locations'] = array();
      if(!empty($locationsByEventId[$row['id']])) {
        $row['locations'] = $locationsByEventId[$row['id']];
      }
      //tag filtering - check conditions
      foreach($conditions as &$condition) {
        $columnName = DAO::getSanitizedColumnName($condition['field']);
        if($columnName == 'tag') {
          //create array with tag names
          $tagNames = array();
          foreach($row['tags'] as &$tag) {
            $tagNames[] = $tag['tag'];
          }
          //tag needs to be present in array
          if(!in_array($condition['value'], $tagNames)) {
            $skipRow = true;
          }
        }
      }
      if(!$skipRow) {
        $return[] = $row;
      }
    }
    return $return;
  }

  private function _getEventIdsFromResult(&$result) {
    $eventIds = array();
    foreach($result as &$row) {
      $eventIds[] = $row['id'];
    }
    return $eventIds;
  }

  private function _getLocationsForEventIds($eventIds) {
    $locationsByEventId = array();
    $eventIdsImploded = implode(', ', $eventIds);
    $sql = "SELECT
      ma3_dok_locations.*,
      ma3_dok_events_locations.event_id
      FROM `ma3_dok_locations`
      RIGHT OUTER JOIN `ma3_dok_events_locations` ON ma3_dok_events_locations.location_id = ma3_dok_locations.id
      WHERE ma3_dok_events_locations.event_id IN ({$eventIdsImploded})
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      if(empty($locationsByEventId[$row['event_id']])) {
        $locationsByEventId[$row['event_id']] = array();
      }
      $locationsByEventId[$row['event_id']][] = $row;
    }
    return $locationsByEventId;
  }

  private function _getTagsForEventIds($eventIds) {
    $tagsByEventId = array();
    $eventIdsImploded = implode(', ', $eventIds);
    $sql = "SELECT
      ma3_dok_tags.*,
      ma3_dok_events_tags.event_id
      FROM `ma3_dok_tags`
      RIGHT OUTER JOIN `ma3_dok_events_tags` ON ma3_dok_events_tags.tag_id = ma3_dok_tags.id
      WHERE ma3_dok_events_tags.event_id IN ({$eventIdsImploded})
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      if(empty($tagsByEventId[$row['event_id']])) {
        $tagsByEventId[$row['event_id']] = array();
      }
      $tagsByEventId[$row['event_id']][] = $row;
    }
    return $tagsByEventId;
  }

}

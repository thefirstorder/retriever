<?php

declare(strict_types=1);

namespace Retriever\Application;

class Saver
{
  public function __construct(ISaver $whosaves)
  {

    //HERE we will get a factory because anyone knows who saves
    // but for now i'm a sun on the beach
    unlink('mibdsqlite.db');
    $bd = new SQLite3('../../assets/dbsqlite.db');
  }

  public function save($uri, $document): boolval
  {
    try {
      $sentence = $bd->prepare('INSERT INTO sites (url, value) VALUES (:url, :value)');
      $sentence->bindValue(':url', $url);
      $sentence->bindValue(':value', $document);
  
      return $result = $sentence->execute();
    } catch(Exception $e) {
      print_r($e->getMessage());
    }
  }
}
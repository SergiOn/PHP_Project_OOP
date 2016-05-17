<?php
/**
 * Created by PhpStorm.
 * User: Sergio
 * Date: 10.05.2016
 * Time: 12:30
 */

namespace core;


class Model {
    protected $db;

    public function __construct() {
        $this->db = new \core\DB();
    }

}
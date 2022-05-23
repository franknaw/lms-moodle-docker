<?php  // Moodle configuration file
unset($CFG);
global $CFG;
$CFG = new stdClass();

// $CFG->lang = 'en';
// $CFG->theme='boost';

$CFG->dbtype    = 'pgsql';
$CFG->dblibrary = 'native';
// DEV
//$CFG->dbhost    = 'lms-rds-aurora-cluster.cluster-zzzzzzzzzzzzzztr.us-gov-west-1.rds.amazonaws.com';


$CFG->dbname    = 'moodledb';
$CFG->dbuser    = 'someuser';
$CFG->dbpass    = 'somepass';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 5432,
  'dbsocket' => '',
);

$CFG->wwwroot   = 'http://example.com/moodle';

$CFG->dataroot  = '/var/www/moodledata';
$CFG->admin     = 'admin';
$CFG->localcachedir = '/var/www/moodlecache';
$CFG->alternative_component_cache = '/local/core_component.php';
$CFG->directorypermissions = 0777;
$CFG->sslproxy=1; //#don’t forget to turn this on when we start serving https over load balancer
require_once(__DIR__ . '/lib/setup.php');
// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local language pack from https://train.edgesource.net/moodle
 *
 * @package    core
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['firsttime'] = 'Is this your first time here?';
$string['newusernewpasswordtext'] = 'Hi {$a->firstname}, 

Welcome to the Cybersecurity Training provided by the Academic Branch of Capacity Building within CISA. In addition to the cybersecurity content we will be delivering in Adobe Connect, the {$a->sitename} (CVLE) will provide a safe and secure environment in which to practice the skills you learned during our training.

A new account has been created for you in the {$a->sitename} and you have been issued with a new temporary password. 

Your current login information is now
*username:* {$a->username} 
*password:* {$a->newpassword} 
(Please note, you will have to change your password when you log in for the first time) 

To go to the {$a->sitename} dashboard, visit {$a->link} 


Thanks from the {$a->sitename} administrator,
{$a->signoff}';

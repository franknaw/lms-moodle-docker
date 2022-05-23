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
 * CISA Users, child of boost.
 *
 * @package    auth_cisasignup
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2021081901;
$plugin->release = 'v0.6'; // Based on Moodle 3.10.3+
$plugin->requires  = 2020110300;
$plugin->component = 'auth_cisasignup';
$plugin->dependencies = [
    'auth_email' => '2020110900'   
];

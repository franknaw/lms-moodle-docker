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
 *
 * @package    auth_cisasignup
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/authlib.php');
require_once($CFG->dirroot . '/auth/email/auth.php');

//namespace auth_cisasignup\core; 
class auth_plugin_cisasignup extends auth_plugin_email {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->authtype = 'cisasignup';
        $this->config = get_config('auth_email');
    }

    /**
     * Return a form to capture user details for account creation.
     * This is used in /login/signup.php.
     * @return moodle_form A form which edits a record from the user table.
     */
    function signup_form() {
        global $CFG;

        require_once('classes/login/form.php');
        return new auth_cisasignup\login\form(null, null, 'post', '', array('autocomplete'=>'on'));
    }

}

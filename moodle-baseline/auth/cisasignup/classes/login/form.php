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
 * @package    auth_cisasignup_form
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_cisasignup\login;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/user/profile/lib.php');
require_once($CFG->dirroot . '/user/editlib.php');
require_once($CFG->dirroot . '/login/lib.php');
require_once($CFG->dirroot . '/login/signup_form.php');

/**
     * REPLACING THE FUNCTION FROM 'WEBLIB.PHP' IN ORDER TO ADD BULLETS
    * Returns a localized sentence in the current language summarizing the current password policy
    *
    * @todo this should be handled by a function/method in the language pack library once we have a support for it
    * @uses $CFG
    * @return string
    */
function cisa_print_password_policy() {
    global $CFG;

    $message = '';
    if (!empty($CFG->passwordpolicy)) {
        $messages = array();
        if (!empty($CFG->minpasswordlength)) {
            $messages[] = get_string('informminpasswordlength', 'auth', $CFG->minpasswordlength);
        }
        if (!empty($CFG->minpassworddigits)) {
            $messages[] = get_string('informminpassworddigits', 'auth', $CFG->minpassworddigits);
        }
        if (!empty($CFG->minpasswordlower)) {
            $messages[] = get_string('informminpasswordlower', 'auth', $CFG->minpasswordlower);
        }
        if (!empty($CFG->minpasswordupper)) {
            $messages[] = get_string('informminpasswordupper', 'auth', $CFG->minpasswordupper);
        }
        if (!empty($CFG->minpasswordnonalphanum)) {
            $messages[] = get_string('informminpasswordnonalphanum', 'auth', $CFG->minpasswordnonalphanum);
        }

        // Fire any additional password policy functions from plugins.
        // Callbacks must return an array of message strings.
        $pluginsfunction = get_plugins_with_function('print_password_policy');
        foreach ($pluginsfunction as $plugintype => $plugins) {
            foreach ($plugins as $pluginfunction) {
                $messages = array_merge($messages, $pluginfunction());
            }
        }
        // Check if messages is empty before formatting or outputting any text
        if ($messages != '') {
             //$messages = join(', ', $messages); // old method for splitting up messages
            // Wrap each item in messages
            foreach ($messages as &$item) {
                $item = '<li>' . $item . '</li>';
            }
            array_unshift($messages, '<ul>'); // add ul to beginning of messages
            $messages[] = '</ul>'; // add /ul to the end
            $messages = join(' ', $messages); // turn into string
            $message = get_string('informpasswordpolicy', 'auth', $messages);
        }
    }
    return $message;
}

/**
 * Adds code snippet to a moodle form object for custom profile fields that
 * should appear on the signup page
 * @param moodleform $mform moodle form object
 */
function cisa_profile_signup_fields($mform) {
    $displayed = false;
    if ($fields = profile_get_signup_fields()) {
        foreach ($fields as $field) {
            // Check if we change the categories.
            if (!isset($currentcat) || $currentcat != $field->categoryid) {
                 $currentcat = $field->categoryid;
                 $mform->addElement('header', 'category_'.$field->categoryid, format_string($field->categoryname));
            };
            if (!$displayed) { // for first category in list
                // add string with SID info
                $mform->addElement('static', null, '', get_string('sid_description','auth_cisasignup'));
                $displayed = true; // only once
            }
            $field->object->edit_field($mform);
        }
    }
}

class form extends \login_signup_form  {

    function definition() {
        global $USER, $CFG;

        $mform = $this->_form;

        $mform->addElement('header', 'createuserandpass', get_string('createuserandpass'), '');


        $mform->addElement('text', 'username', get_string('username'), 'maxlength="100" size="12" autocapitalize="none"');
        $mform->setType('username', PARAM_RAW);
        $mform->addRule('username', get_string('missingusername'), 'required', null, 'client');

        if (!empty($CFG->passwordpolicy)){
            $mform->addElement('static', 'passwordpolicyinfo', '', cisa_print_password_policy());
        }
        $mform->addElement('password', 'password', get_string('password'), 'maxlength="32" size="12"');
        $mform->setType('password', \core_user::get_property_type('password'));
        $mform->addRule('password', get_string('missingpassword'), 'required', null, 'client');
        
        cisa_profile_signup_fields($mform);
/*
        $mform->addElement('header', 'supplyinfo', get_string('supplyinfo'),'');
*/
        $mform->addElement('text', 'email', get_string('email'), 'maxlength="100" size="25"');
        $mform->setType('email', \core_user::get_property_type('email'));
        $mform->addRule('email', get_string('missingemail'), 'required', null, 'client');
        $mform->setForceLtr('email');

        $mform->addElement('text', 'email2', get_string('emailagain'), 'maxlength="100" size="25"');
        $mform->setType('email2', \core_user::get_property_type('email'));
        $mform->addRule('email2', get_string('missingemail'), 'required', null, 'client');
        $mform->setForceLtr('email2');

        $namefields = useredit_get_required_name_fields();
        foreach ($namefields as $field) {
            $mform->addElement('text', $field, get_string($field), 'maxlength="100" size="30"');
            $mform->setType($field, \core_user::get_property_type('firstname'));
            $stringid = 'missing' . $field;
            if (!get_string_manager()->string_exists($stringid, 'moodle')) {
                $stringid = 'required';
            }
            $mform->addRule($field, get_string($stringid), 'required', null, 'client');
        }

        $mform->addElement('text', 'city', get_string('city'), 'maxlength="120" size="20"');
        $mform->setType('city', \core_user::get_property_type('city'));
        if (!empty($CFG->defaultcity)) {
            $mform->setDefault('city', $CFG->defaultcity);
        }

        $country = get_string_manager()->get_list_of_countries();
        $default_country[''] = get_string('selectacountry');
        $country = array_merge($default_country, $country);
        $mform->addElement('select', 'country', get_string('country'), $country);

        if( !empty($CFG->country) ){
            $mform->setDefault('country', $CFG->country);
        }else{
            $mform->setDefault('country', '');
        }

        if (signup_captcha_enabled()) {
            $mform->addElement('recaptcha', 'recaptcha_element', get_string('security_question', 'auth'));
            $mform->addHelpButton('recaptcha_element', 'recaptcha', 'auth');
            $mform->closeHeaderBefore('recaptcha_element');
        }

        // Hook for plugins to extend form definition.
        core_login_extend_signup_form($mform);

        // Add "Agree to sitepolicy" controls. By default it is a link to the policy text and a checkbox but
        // it can be implemented differently in custom sitepolicy handlers.
        $manager = new \core_privacy\local\sitepolicy\manager();
        $manager->signup_form($mform);

        // buttons
        $this->add_action_buttons(true, get_string('createaccount'));

    }
}

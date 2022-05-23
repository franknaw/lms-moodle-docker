<?php
/**
 * Core renderer extension added to support CISA needs. First requirement for 'welcome message' and button in header for Dashboard.
 * 
 * 
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/outputrenderers.php');

class auth_cisasignup_core_renderer extends \core_renderer  {
    
    public function render_auth_cisasignup_login_form($form) {
        global $SITE;

        $context = $form->export_for_template($this);
        $url = $this->get_logo_url();
        if ($url) {
            $url = $url->out(false);
        }
        $context['logourl'] = $url;
        $context['sitename'] = format_string($SITE->fullname, true,
                ['context' => context_course::instance(SITEID), "escape" => false]);

        return $this->render_from_template('core/login/form_layout', $context);
    }

}
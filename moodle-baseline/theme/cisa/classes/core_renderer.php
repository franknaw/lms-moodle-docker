<?php
/**
 * Core renderer extension added to support CISA needs. First requirement for 'welcome message' and button in header for Dashboard.
 * 
 * 
 */
class theme_cisa_core_renderer extends \theme_boost\output\core_renderer  {
    
    public function welcome_message($user = null) {
        global $USER, $CFG;
        require_once($CFG->dirroot . '/user/lib.php');

        if (is_null($user)) {
            $user = $USER;
        }

        $returnstr = "";

        $loginpage = $this->is_login_page();
        $loginurl = get_login_url();
        // If not logged in, show the typical not-logged-in string.
        if (!isloggedin()) {
            $returnstr = get_string('loggedinnot', 'moodle');
            if (!$loginpage) {
                $returnstr .= " (<a href=\"$loginurl\">" . get_string('login') . '</a>)';
            }
            return html_writer::span(
                $returnstr,
                'login'
            );

        }

        // If logged in as a guest user, show a string to that effect.
        if (isguestuser()) {
            $returnstr = get_string('loggedinasguest');
            if (!$loginpage) {
                $returnstr .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
            }

            return html_writer::span(
                $returnstr,
                'login'
            );
        }

        // Finally, if regular user, just get their first name.
        $firstname = null;
        if (isset($user->firstname)) {
            $firstname = $user->firstname;
            $returnstr = get_string('welcome', 'theme_cisa', $firstname);
            return html_writer::span(
                $returnstr, 
                'welcome'
            );
        } else {
            return $returnstr;
        }

    }
    
    /* Print out a link to the current Course Catalog page
    */
    public function catalog_button() {
        global $OUTPUT, $CFG;
        $catalogurl = new moodle_url("$CFG->wwwroot/course/index.php");
        $catalogstring = get_string('coursecatalog_btn', 'theme_cisa');
        $catalogbutton = $OUTPUT->single_button($catalogurl, $catalogstring);
        return $catalogbutton;
    }

    /**
     * Returns the Help Desk link
     *
     */
    public function help_desk_link($text = null, $link = null) {
        $complete_link = '';
        if ($text === null) {
            $text = get_string('helplinktext','theme_cisa');
        }
        if ($link === null) {
            $link = get_string('helpdesklink','theme_cisa');
        }
        $complete_link = html_writer::link(
            $link, $text, array('class' => 'helplink')
        );
        $help_text = html_writer::span(
            get_string('helpdesktext','theme_cisa'), 'helptext'
        );
        return html_writer::div(
            $help_text . '<br />' . $complete_link, 'helpdiv'
        );
    }

    /** Footer Branding block
     * 
     */
    public function footer_branding() {
        $text = get_string('footertext','theme_cisa');
        $textblock = html_writer::div(
            $text, 'textblock'
        );
        return html_writer::div(
            $textblock, 'brandingblock'
        );
    }

    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header, 'welcome' version replaces normal full_header
     */
    public function full_header_welcome() {



        if ($this->page->include_region_main_settings_in_header_actions() &&
                !$this->page->blocks->is_block_present('settings')) {
            // Only include the region main settings if the page has requested it and it doesn't already have
            // the settings block on it. The region main settings are included in the settings block and
            // duplicating the content causes behat failures.
            $this->page->add_header_action(html_writer::div(
                $this->region_main_settings_menu(),
                'd-print-none',
                ['id' => 'region-main-settings-menu']
            ));
        }

        $header = new stdClass();
        $header->settingsmenu = $this->context_header_settings_menu();
        $header->contextheader = $this->context_header();
        $header->hasnavbar = empty($this->page->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->haswelcome = isset($this->page->layout_options['welcome']);
        $header->welcomemessage = $this->welcome_message();
        $header->hascatalogbtn = isset($this->page->layout_options['catalogbtn']);
        $header->catalogbtn = $this->catalog_button();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        $header->headeractions = $this->page->get_header_actions();
        return $this->render_from_template('core/full_header_welcome', $header);
    }

    /* Minor change to message text requires our own copy of this core Moodle function :(
    */

    public function context_header($headerinfo = null, $headinglevel = 1) {
        global $DB, $USER, $CFG, $SITE;
        require_once($CFG->dirroot . '/user/lib.php');
        $context = $this->page->context;
        $heading = null;
        $imagedata = null;
        $subheader = null;
        $userbuttons = null;

        // Make sure to use the heading if it has been set.
        if (isset($headerinfo['heading'])) {
            $heading = $headerinfo['heading'];
        } else {
            $heading = $this->page->heading;
        }

        // The user context currently has images and buttons. Other contexts may follow.
        if (isset($headerinfo['user']) || $context->contextlevel == CONTEXT_USER) {
            if (isset($headerinfo['user'])) {
                $user = $headerinfo['user'];
            } else {
                // Look up the user information if it is not supplied.
                $user = $DB->get_record('user', array('id' => $context->instanceid));
            }

            // If the user context is set, then use that for capability checks.
            if (isset($headerinfo['usercontext'])) {
                $context = $headerinfo['usercontext'];
            }

            // Only provide user information if the user is the current user, or a user which the current user can view.
            // When checking user_can_view_profile(), either:
            // If the page context is course, check the course context (from the page object) or;
            // If page context is NOT course, then check across all courses.
            $course = ($this->page->context->contextlevel == CONTEXT_COURSE) ? $this->page->course : null;

            if (user_can_view_profile($user, $course)) {
                // Use the user's full name if the heading isn't set.
                if (empty($heading)) {
                    $heading = fullname($user);
                }

                $imagedata = $this->user_picture($user, array('size' => 100));

                // Check to see if we should be displaying a message button.
                if (!empty($CFG->messaging) && has_capability('moodle/site:sendmessage', $context)) {
                    $userbuttons = array(
                        'messages' => array(
                            'buttontype' => 'message',
                            'title' => get_string('messageuser', 'theme_cisa'),
                            'url' => new moodle_url('/message/index.php', array('id' => $user->id)),
                            'image' => 'message',
                            'linkattributes' => \core_message\helper::messageuser_link_params($user->id),
                            'page' => $this->page
                        )
                    );

                    if ($USER->id != $user->id) {
                        $iscontact = \core_message\api::is_contact($USER->id, $user->id);
                        $contacttitle = $iscontact ? 'removefromyourcontacts' : 'addtoyourcontacts';
                        $contacturlaction = $iscontact ? 'removecontact' : 'addcontact';
                        $contactimage = $iscontact ? 'removecontact' : 'addcontact';
                        $userbuttons['togglecontact'] = array(
                                'buttontype' => 'togglecontact',
                                'title' => get_string($contacttitle, 'message'),
                                'url' => new moodle_url('/message/index.php', array(
                                        'user1' => $USER->id,
                                        'user2' => $user->id,
                                        $contacturlaction => $user->id,
                                        'sesskey' => sesskey())
                                ),
                                'image' => $contactimage,
                                'linkattributes' => \core_message\helper::togglecontact_link_params($user, $iscontact),
                                'page' => $this->page
                            );
                    }

                    $this->page->requires->string_for_js('changesmadereallygoaway', 'moodle');
                }
            } else {
                $heading = null;
            }
        }

        if ($this->should_display_main_logo($headinglevel)) {
            $sitename = format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID)]);
            // Logo.
            $html = html_writer::div(
                html_writer::empty_tag('img', [
                    'src' => $this->get_logo_url(null, 150),
                    'alt' => get_string('logoof', '', $sitename),
                    'class' => 'img-fluid'
                ]),
                'logo'
            );
            // Heading.
            if (!isset($heading)) {
                $html .= $this->heading($this->page->heading, $headinglevel, 'sr-only');
            } else {
                $html .= $this->heading($heading, $headinglevel, 'sr-only');
            }
            return $html;
        }

        $contextheader = new context_header($heading, $headinglevel, $imagedata, $userbuttons);
        return $this->render_context_header($contextheader);
    }

}
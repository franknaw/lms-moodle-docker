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
 * Theme functions.
 *
 * @package    theme_cisa
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// functions and vars below from boost. Didn't duplicated the deprecated function (directly below).
// also file locations still in boost theme as we are a child and depending on boost's css / scss for sources
// Other functions duplicated so we can use our own settings to set cisa presets, etc.

/**
 * Post process the CSS tree - this was cut as it seems boost-only and is covering deprecated functionality
 *
 * @param string $tree The CSS tree.
 * @param theme_config $theme The theme config object.

function theme_boost_css_tree_post_processor($tree, $theme) {
    error_log('theme_boost_css_tree_post_processor() is deprecated. Required' .
        'prefixes for Bootstrap are now in theme/boost/scss/moodle/prefixes.scss');
    $prefixer = new theme_boost\autoprefixer($tree);
    $prefixer->prefix();
}
 */
/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_cisa_get_extra_scss($theme) {
    $content = '';
    $imageurl = $theme->setting_file_url('backgroundimage', 'backgroundimage');

    // Sets the background image, and its settings.
    if (!empty($imageurl)) {
        $content .= 'body { ';
        $content .= "background-image: url('$imageurl'); background-size: cover;";
        $content .= ' }';
    }

    // Always return the background image with the scss when we have it.
    return !empty($theme->settings->scss) ? $theme->settings->scss . ' ' . $content : $content;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_cisa_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'logo' || $filearea === 'backgroundimage')) {
        $theme = theme_config::load('cisa');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_cisa_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_cisa', 'preset', 0, '/', $filename))) {
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    return $scss;
}

/**
 * Get compiled css.
 *
 * @return string compiled css
 */
function theme_cisa_get_precompiled_css() {
    global $CFG;
    return file_get_contents($CFG->dirroot . '/theme/boost/style/moodle.css');
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return array
 */
function theme_cisa_get_pre_scss($theme) {
    global $CFG;

    $scss = '';
    $configurable = [
        // Config key => [variableName, ...].
        'brandcolor' => ['primary'],
    ];

    // Prepend variables first.
    foreach ($configurable as $configkey => $targets) {
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;
        if (empty($value)) {
            continue;
        }
        array_map(function($target) use (&$scss, $value) {
            $scss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    // Prepend pre-scss.
    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }

    return $scss;
}

// New function to save images added through settings to our theme root
function theme_cisa_update_settings_images($settingname) {                                                                         
    global $CFG;                                                                                                                    
 
    // The setting name that was updated comes as a string like 's_theme_cisa_dashboardbannerimage'.                                                                                                                        
    $parts = explode('_', $settingname);                                                                                                                                                                        
    $settingname = end($parts);                                                                                                     
 
    // Admin settings are stored in system context.                                                                                 
    $syscontext = context_system::instance();                                                                                       
    // This is the component name the setting is stored in.                                                                         
    $component = 'theme_cisa';                                                                                                     
 
    // This is the value of the admin setting which is the filename of the uploaded file.                                           
    $filename = get_config($component, $settingname);                                                                               
    // We extract the file extension because we want to preserve it.                                                                
    $extension = substr($filename, strrpos($filename, '.') + 1);                                                                    
 
    // This is the path in the moodle internal file system.                                                                         
    $fullpath = "/{$syscontext->id}/{$component}/{$settingname}/0{$filename}";                                                      
    // Get an instance of the moodle file storage.                                                                                  
    $fs = get_file_storage();                                                                                                       
    // This is an efficient way to get a file if we know the exact path.                                                            
    if ($file = $fs->get_file_by_hash(sha1($fullpath))) {                                                                           
        // We got the stored file - copy it to dataroot.                                                                            
        // This location matches the searched for location in theme_config::resolve_image_location.                                 
        $pathname = $CFG->dataroot . '/pix_plugins/theme/cisa/' . $settingname . '.' . $extension;                                 
 
        // This pattern matches any previous files with maybe different file extensions.                                            
        $pathpattern = $CFG->dataroot . '/pix_plugins/theme/cisa/' . $settingname . '.*';                                          
 
        // Make sure this dir exists.                                                                                               
        @mkdir($CFG->dataroot . '/pix_plugins/theme/cisa/', $CFG->directorypermissions, true);                                      
 
        // Delete any existing files for this setting.                                                                              
        foreach (glob($pathpattern) as $filename) {                                                                                 
            @unlink($filename);                                                                                                     
        }                                                                                                                           
 
        // Copy the current file to this location.                                                                                  
        $file->copy_content_to($pathname);                                                                                          
    }                                                                                                                               
 
    // Reset theme caches.                                                                                                          
    theme_reset_all_caches();                                                                                                       
}
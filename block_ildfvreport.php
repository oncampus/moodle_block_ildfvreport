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
 * @package block_ildfvreport
 * @copyright 2016 Fachhochschule Lübeck ILD
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_ildfvreport extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_ildfvreport');
    }

    public function get_content() {
        global $CFG;
        require_once($CFG->dirroot . '/blocks/ildfvreport/lib.php');

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;

        if (!empty($this->config->text)) {
            $this->content->text = $this->config->text;
        } else {
            $this->content->text = '';
        }

        $this->content->text .= block_ildfvreport_get_evaluation_report($this->page->course->idnumber);

        return $this->content;
    }

    function has_config() {
        return false;
    }

    public function instance_allow_multiple() {
        return false;
    }

    public function applicable_formats() {
        return array(
            'site' => true,
            'course-view' => true,
            'my' => false
        );
    }
}
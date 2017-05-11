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

function block_ildfvreport_get_evaluation_report($cidnumber) {
    $report_url = '';
    $download_url = $report_url . '';
    $postfields = array('course' => $cidnumber);

    $evaluations = block_ildfvreport_curlPost($report_url, $postfields);

    if ($evaluations != false) {
        $output = '';
        $evaluations = (array)unserialize($evaluations);

        foreach ($evaluations as $key => $evaluation) {
            $output .= '<a href="' . $download_url . $evaluation . '">' . $key . '</a><br/>';
        }
    } else {
        $output = '';
    }

    return $output;
}

function block_ildfvreport_curlPost($url, $postfields = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    if ($postfields != null) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
    }

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
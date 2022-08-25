<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * MySQLi Utility Class
 *
 * @category	Database
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/database/
 */
class CI_DB_mysqli_utility extends CI_DB_utility {

    /**
     * List databases
     *
     * @access	private
     * @return	bool
     */
    function _list_databases() {
        return "SHOW DATABASES";
    }

    // --------------------------------------------------------------------

    /**
     * Optimize table query
     *
     * Generates a platform-specific query so that a table can be optimized
     *
     * @access	private
     * @param	string	the table name
     * @return	object
     */
    function _optimize_table($table) {
        return "OPTIMIZE TABLE " . $this->db->_escape_identifiers($table);
    }

    // --------------------------------------------------------------------

    /**
     * Repair table query
     *
     * Generates a platform-specific query so that a table can be repaired
     *
     * @access	private
     * @param	string	the table name
     * @return	object
     */
    function _repair_table($table) {
        return "REPAIR TABLE " . $this->db->_escape_identifiers($table);
    }

    // --------------------------------------------------------------------

    /**
     * MySQLi Export
     *
     * @access	private
     * @param	array	Preferences
     * @return	mixed
     */
    function old_backup($params = array()) {
        // Currently unsupported
        return $this->db->display_error('db_unsuported_feature');
    }

    /**
     * MySQLi Export
     *
     * @access private
     * @param array Preferences
     * @return mixed
     */
    function _backup($params = array()) {
        /*
          // Currently unsupported
          return $this->db->display_error('db_unsuported_feature');
         */
        if (count($params) == 0) {
            return FALSE;
        }

        // Extract the prefs for simplicity
        extract($params);

        // Build the output
        $output = '';
        foreach ((array) $tables as $table) {
            // Is the table in the "ignore" list?
            if (in_array($table, (array) $ignore, TRUE)) {
                continue;
            }

            // Get the table schema
            $query = $this->db->query("SHOW CREATE TABLE `" . $this->db->database . '`.`' . $table . '`');

            // No result means the table name was invalid
            if ($query === FALSE) {
                continue;
            }

            // Write out the table schema
            $output .= '#' . $newline . '# TABLE STRUCTURE FOR: ' . $table . $newline . '#' . $newline . $newline;

            if ($add_drop == TRUE) {
                $output .= 'DROP TABLE IF EXISTS ' . $table . ';' . $newline . $newline;
            }

            $i = 0;
            $result = $query->result_array();
            foreach ($result[0] as $val) {
                if ($i++ % 2) {
                    $output .= $val . ';' . $newline . $newline;
                }
            }

            // If inserts are not needed we're done...
            if ($add_insert == FALSE) {
                continue;
            }

            // Grab all the data from the current table
            $query = $this->db->query("SELECT * FROM $table");

            if ($query->num_rows() == 0) {
                continue;
            }

            // Fetch the field names.
            // We are going to surround all values with single quotes
            // and hope that mysql would be able to make type conversion...
            $field_str = '';
            foreach ($query->row() as $field_name => $field_value)
                $field_str .= '`' . $field_name . '`, ';

            // Trim off the end comma
            $field_str = preg_replace("/, $/", "", $field_str);

            // Build the insert string
            foreach ($query->result_array() as $row) {
                $val_str = '';

                $i = 0;
                foreach ($row as $v) {
                    // Is the value NULL?
                    if ($v === NULL) {
                        $val_str .= 'NULL';
                    } else {
                        $val_str .= $this->db->escape($v);
                    }

                    // Append a comma
                    $val_str .= ', ';
                    $i++;
                }

                // Remove the comma at the end of the string
                $val_str = preg_replace("/, $/", "", $val_str);

                // Build the INSERT string
                $output .= 'INSERT INTO ' . $table . ' (' . $field_str . ') VALUES (' . $val_str . ');' . $newline;
            }

            $output .= $newline . $newline;
        }

        return $output;
    }

}

/* End of file mysqli_utility.php */
/* Location: ./system/database/drivers/mysqli/mysqli_utility.php */
<?php

class Migration_Add_blog extends CI_Migration
{
    public function up()
    {
        // query for fetching the user options
        // select first for header
        // SELECT optionid, b.header as header, b.link as link
        // FROM `tbl_useroption` a, tbl_option b, tbl_option_header c
        // WHERE userid = 130 AND a.optionid = b.id AND b.header = c.id
        // GROUP BY header
        // ORDER by c.priors,b.id

        // then select for option of that header
        // SELECT * FROM tbl_option
        // WHERE tbl_useroption.optionid = tbl_option.id
        // AND tbl_useroption.userid = 130
        // AND tbl_option.header = header 
        // ORDER BY id

        //$this->drop_fields_useroption();

        $fields = array(
            'header' => array('type' => 'INT')
        );
        $this->dbforge->add_column('tbl_option', $fields);

        $fields = array(
            'priors' => array('type' => 'INT')
        );
        $this->dbforge->add_column('tbl_option_header', $fields);
    }

    public function drop_fields_useroption()
    {
        $fields = array('header', 'priors', 'optionid');

        foreach ($fields as $field) {
            $this->dbforge->drop_column('tbl_useroption', $field);
        }
    }

    public function down()
    {

    }
}

<?php 

class Test_edp extends CI_Controller
{
	function get_cur($coursemajor)
    {
        $systemVal  = $this->api->systemValue();
        $sy         = $systemVal['phaseterm'];
        $this->numberOfStudents = $systemVal['numberofstudent'];

        $this->db->where('id', $sy);
        $tt     = $this->db->get('tbl_academicterm')->row_array();
        $term   = $tt['term'];

        $acamd  = $this->db->query("SELECT * FROM `tbl_academicterm` WHERE systart <= {$tt['systart']} ORDER BY systart DESC,term")->result_array();

        $cur1 = 0;
        foreach($acamd as $acams)
        {
            $c = $this->db->query("SELECT tbl_curriculum.id as id FROM tbl_curriculum,tbl_coursemajor WHERE
                tbl_coursemajor.id = tbl_curriculum.coursemajor AND
                tbl_coursemajor.course = $coursemajor AND academicterm = {$acams['id']}");
            
            if($c->num_rows() > 0)
            {
                $cur    = $c->row_array();
                $cur1   = $cur['id'];
                break;
            }
        }
        echo $cur1;
    }

        // test function
    function tryap()
    {
        $stud = $this->db->query("SELECT * FROM out_exception where comment = 'no curriculum tbl_registration' GROUP by student")->result_array();

        foreach ($stud as $val) {

            $reg 	= $this->db->query("SELECT academicterm,registration,coursemajor,id,student FROM tbl_enrolment WHERE student = {$val['student']} AND academicterm = 49 GROUP BY coursemajor")->row_array();
            $reg_id = 0;
            $reg_id = $reg['registration'];

            if ($reg_id == 0) {
                $reg_id = $this->cre_reg($reg['student'], $reg['coursemajor']);
            }

            $this->db->where('id', $reg_id);

            $gg     = $this->db->get('tbl_registration')->row_array();
            $course = $gg['coursemajor'];
            $t      = $this->db->query("SELECT * FROM tbl_academicterm ORDER BY systart ASC,term")->result_array();

            foreach ($t as $acam) {

                $c = $this->db->query("SELECT * FROM tbl_curriculum
                    WHERE coursemajor = $course
                    AND academicterm = {$acam['id']}");

                if ($c->num_rows() > 0) {
                    $cur    = $c->row_array();
                    $dat['curriculum'] = $cur['id'];
                    $this->db->where('id',$reg_id);
                    $this->db->update('tbl_registration',$dat);
                    break;
                }

            }
        }

    }

    function tryap1($id)
    {
        //22518
        echo $this->api->yearLevel($id);
    }

    // test function
    function tryap2($id)
    {
        $this->db->where('coursemajor', $id);
        $q = $this->db->get('tbl_enrolment')->result_array();
        foreach ($q as $val) {

            $this->db->where('enrolment', $val['id']);
            $qq = $this->db->get('tbl_studentgrade')->result_array();

            foreach ($qq as $val1) {
                $this->db->where('id', $val1['classallocation']);
                $s = $this->db->get('tbl_classallocation')->row_array();

                $this->db->where('subject', $s['subject']);
                $this->db->where('coursemajor', $id);
                $i = $this->db->count_all_results('out_c');
                if ($i < 1) {
                    $db['subject']      = $s['subject'];
                    $db['coursemajor']  = $id;
                    $this->db->insert('out_c', $db);
                }
            }
        }
    }

    function tt()
    {
        $this->db->where('comment', 'not found tbl_registration');
        $t = $this->db->get('out_exception')->result_array();

        foreach ($t as $val) {
            $tt = $this->db->query("SELECT * FROM tbl_enrolment
                WHERE academicterm = (SELECT MIN(academicterm)
                FROM tbl_enrolment WHERE student = {$val['student']})
                AND student = {$val['student']} LIMIT 1")->row_array();

            $acam           = $tt['academicterm'];
            $coursemajor    = $tt['coursemajor'];
            $t1             = $this->db->query("SELECT * FROM tbl_academicterm
                                ORDER BY systart ASC,term")->result_array();

            foreach ($t1 as $k) {
                $this->db->where('coursemajor',$coursemajor);
                $this->db->where('academicterm',$k['id']);
                $c = $this->db->get('tbl_curriculum');

                if ($c->num_rows() > 0) {
                    $ff                     = $c->row_array();
                    $data['student']        = $val['student'];
                    $data['coursemajor']    = $coursemajor;
                    $data['curriculum']     = $ff['id'];
                    $this->db->insert('tbl_registration', $data);
                    $reg_id = $this->db->insert_id();

                    $d['registration'] = $reg_id;
                    $this->db->where('student', $val['student']);
                    $this->db->update('tbl_enrolment', $d);
                    break;
                }

            }

        }

    }

    function up()
    {
        $this->db->where('comment', 'no curriculum tbl_registration');
        $r = $this->db->get('out_exception')->result_array();
        foreach ($r as $key) {
            $this->db->where('student', $key['student']);
            $this->db->where('coursemajor', 22);
            $g = $this->db->count_all_results('tbl_registration');
            if($g > 0) {
                $d['coursemajor'] = 8;
                $this->db->where('student', $key['student']);
                $this->db->update('tbl_registration', $d);
            }
        }
    }

    function nocur()
    {
        $this->db->where('comment', 'no valid academicterm tbl_registration');
        $q = $this->db->get('out_exception')->result_array();

        foreach ($q as $key) {
            $t = $this->db->query("SELECT min(academicterm) as ac,student
                FROM tbl_enrolment WHERE student = {$key['student']} LIMIT 1")->row_array();

            $acam = $t['ac'];

            $f['academicterm'] = $acam;
            $this->db->where('student', $key['student']);
            $this->db->update('tbl_registration', $f);

        }
    }

    // test function
    function update_reg()
    {
        $r = $this->db->get('out_secondary')->result_array();
        foreach ($r as $key) {
            $data['coursemajor'] = 2;
            $this->db->where('id', $key['registration']);
            $this->db->update('tbl_registration', $data);
        }
    }

    private function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

    function ListUsers()
    {
        $this->head();
        $this->load->view('edp/list_users');
        $this->load->view('templates/footer');
    }

    function ClassroomList()
    {
        $this->head();
        $this->load->view('edp/list_classroom');
        $this->load->view('templates/footer');
    }

    function CalculateSubjectSection()
    {
        $this->head();
        $this->load->view('edp/calculate_subjectsection');
        $this->load->view('templates/footer');
    }

    function ClassAllocation()
    {
        $this->head();
        $this->load->view('edp/classRooms');
        $this->load->view('templates/footer');
    }
}
<?php
/*
| -------------------------------------
| @file  : Curriculum.php
| @date  : 05/11/2015
| @author: Greg
| -------------------------------------

*/
/**
*
*/
class Lc_curriculum extends CI_Controller
{
	function viewcurriculum($partyid, $date, $coursemajor)
	{
		$this->api->userMenu();
		$this->load->model('registrar/common');

        $data['partyid'] 		= $partyid;
        $data['date'] 			= $date;
        $data['coursemajor'] 	= $coursemajor;

        $this->load->view('curriculum/curriculum', $data);
		$this->load->view('templates/footer');
	}
    function addsubcur($yearlevel, $coursemajor, $academicterm, $currid, $major)
	{
        $this->load->model('registrar/common');
        $this->api->userMenu();

        $data['coursemajor'] 	= $coursemajor;
        $data['yearlevel'] 		= $yearlevel;
        $data['academicterm'] 	= $academicterm;
        $data['currid'] 		= $currid;
        $data['m'] 				= $major;

        $this->load->view('dean/add_subcurr', $data);
        $this->load->view('templates/footer');
    }
    function insertcurr()
	{
        $suc 			= '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $alerts 		= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $accad_id 		= $this->input->post('acad_id');
        $coursemajor 	= $this->input->post('coursemajor');
        $remarks 		= $this->input->post('remarks');
        $yearlevel 		= $this->input->post('yearlevel');
        $result 		= $this->db->query("SELECT COUNT(*) as totalcount FROM tbl_curriculum WHERE coursemajor = '$coursemajor' AND academicterm = '$accad_id'");
        $x 				= $result->row_array();
		
        if ($accad_id == 0) {
           $this->session->set_flashdata('message', $alerts . 'Please Select Effectivity.</div>');
        } elseif ($coursemajor == 0) {
            $this->session->set_flashdata('message', $alerts . 'Please Select Course.</div>');
        } elseif ($yearlevel == 0) {
            $this->session->set_flashdata('message', $alerts . 'Please Select Year Level.</div>');
        } else {
			
            if ($x['totalcount'] == 0) {
	            $data = array(	
						'description' 	=> $remarks,
	                	'coursemajor' 	=> $coursemajor,
	                	'academicterm' 	=> $accad_id,
	                	'yearlevel' 	=> $yearlevel
					);
				
	            $this->db->insert('tbl_curriculum', $data);
				
				$cur_id = $this->db->insert_id();
				$this->update_year_units($cur_id);
	            $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Curriculum Added.</div>');
            } elseif($remarks == '') {
                $this->session->set_flashdata('message', $alerts . 'Please Input Remarks.</div>');
            } else {
                 $this->session->set_flashdata('message', $alerts . 'Curriculum Already Exist.</div>');
            }
			
        }

        $data3 = array('ac' => $accad_id,
            'cou' 			=> $coursemajor,
            'rem' 			=> $remarks,
            'lev' 			=> $yearlevel
		);
        $_SESSION['curr'] = $data3;
       redirect('/menu/dean-add_curriculum');
    }
    function deletecur($currid)
	{
        $suc = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $this->db->delete('tbl_curriculum', array('id' => $currid));
        $this->db->delete('tbl_curriculumdetail', array('id' => $currid));
        $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Curriculum Deleted.</div>');
        redirect('/menu/dean-add_curriculum');
    }
    function insertsubj()
	{
        $suc 		= '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $alerts 	= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $subid 		= $this->input->post('subid');
        $yearlevel 	= $this->input->post('yearlevel');
        $term 		= $this->input->post('term');
        $currid 	= $this->input->post('currid');
        $url 		= $this->input->post('url');

        /*if ($x['totalcount'] == 0) {
           $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Subject Added.</div>');
        } else*/

        $data = array('sub' => $subid,
            'year' 			=> $yearlevel,
            'ter' 			=> $term);

        $_SESSION['params'] = $data;
        if($subid == 0)
		{
            $this->session->set_flashdata('message', $alerts . 'Select Subject.</div>');
        }
		elseif($yearlevel == 0)
		{
            $this->session->set_flashdata('message', $alerts . 'Please Select Year Level.</div>');
        }
		elseif($term == 0)
		{
            $this->session->set_flashdata('message', $alerts . 'Please Select Term.</div>');
        }
		else
		{
              $row = $this->db->query("SELECT COUNT(*) as totalcount FROM tbl_curriculumdetail WHERE subject = '$subid' AND yearlevel = '$yearlevel'
                AND term = '$term' AND curriculum = '$currid'");
                 $x = $row->row_array();
                 if ($x['totalcount'] == 0)
				 {
                    $data2 = array(	'curriculum' 	=> $currid,
                					'subject' 		=> $subid,
                					'yearlevel' 	=> $yearlevel,
                					'term' 			=> $term);

					$this->update_year_units($currid, $yearlevel);

                    $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Subject Added.</div>');
                   unset($_SESSION['params']);
                }
				else
				{
                    $this->session->set_flashdata('message', $alerts .'Subject Already Exist.</div>');
                }

        }
        redirect('/lc_curriculum/addsubcur/' . $url);
    }
    function deletesub($id, $yearlevel, $coursemajor, $academicterm, $currid, $m)
	{
        $suc = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $this->db->where('id', $id);
        $this->db->delete('tbl_curriculumdetail');
		$this->update_year_units($currid, $yearlevel);
        $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Subject Deleted.</div>');
        $url = $yearlevel . '/' . $coursemajor . '/' . $academicterm . '/' . $currid . '/' . $m;
        redirect('/lc_curriculum/addsubcur/' . $url);
    }

	function update_year_units($cur_id, $yearlevel = 0)
	{
		$this->db->where('curriculum', $cur_id);
		$c = $this->db->count_all_results('tbl_year_units');
		if ($c > 0 AND $yearlevel != 0) {
			$r 		= $this->db->query("SELECT SUM(units) as unit FROM tbl_curriculumdetail a,tbl_subject b
									WHERE a.subject = b.id AND a.curriculum = $cur_id AND a.yearlevel = $yearlevel")->row_array();
			$unit['totalunits'] = $r['unit'];
			$this->db->where('curriculum', $cur_id);
			$this->db->where('yearlevel', $yearlevel);
			$this->db->update('tbl_year_units', $unit);
		} else {
			$w = $this->db->query("SELECT curriculum, yearlevel, SUM(units) AS unit
							FROM tbl_curriculumdetail,tbl_subject WHERE
							curriculum = $cur_id AND subject = tbl_subject.id GROUP BY yearlevel ORDER BY yearlevel")->result_array();
			
			foreach ($w as $year_units) {
				$data['curriculum'] = $year_units['curriculum'];
				$data['yearlevel'] 	= $year_units['yearlevel'];
				$data['totalunits'] = $year_units['unit'];
				$this->db->insert('tbl_year_units', $data);
			}
		}

	}
    function copycurr()
	{
        $suc 	= '<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';
        $alerts = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:red"><span aria-hidden="true">&times;</span></button>';

        echo $coursedesc 	= $this->input->post('currdesc');
        echo $yearlevel 	= $this->input->post('yearlevel');
        echo $coursemajor 	= $this->input->post('coursemajor');
        echo $accad_id 		= $this->input->post('acad_id');
        echo $currcid 		= $this->input->post('curricid');

        $check 	= $this->db->query("SELECT COUNT(*) as totalcount FROM tbl_curriculum WHERE coursemajor = '$coursemajor' AND academicterm = '$accad_id' AND yearlevel = '$yearlevel'");
        $x 		= $check->row_array();

        if ($x['totalcount'] == 0)
		{
            $data = array('description' => $coursedesc,
                'yearlevel' 			=> $yearlevel,
                'coursemajor' 			=> $coursemajor,
                'academicterm' 			=> $accad_id);
            $this->db->insert('tbl_curriculum', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">' . $suc .  'Curriculum Added.</div>');

        }
		else
		{
            $this->session->set_flashdata('message', $alerts .'Academic Term Already Exist.</div>');
        }

        $checks 		= $this->db->query("SELECT id as curriculumid FROM tbl_curriculum WHERE coursemajor = '$coursemajor' AND academicterm = '$accad_id' AND yearlevel = '$yearlevel'");
        $x 				= $checks->row_array();
        $curriculumid 	= $x['curriculumid'];

        $x 				= $this->db->query("SELECT subject, yearlevel, term FROM tbl_curriculumdetail WHERE curriculum = '$currcid'");
        $xy 			= $x->result_array();

        foreach ($xy as $key => $value) {
            extract($value);
            $data = array(
                'curriculum' => $curriculumid,
                'subject' => $subject,
                'yearlevel' => $yearlevel,
                'term' => $term,
                );
            $this->db->insert('tbl_curriculumdetail', $data);
        }
		$this->update_year_units($curriculumid, $yearlevel);
       redirect('/menu/dean-add_curriculum');
    }
}

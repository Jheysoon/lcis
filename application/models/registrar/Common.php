<?php 
	/**
	* 
	*/
	class Common extends CI_Model
	{
		function select_student($id){
			$data = array('legacyid' => $id);
			$this->db->order_by('date', 'DESC');
			$result = $this->db->get_where('view_studinfo', $data);
			return $result->row_array();
		}
		function selectOther($partyid){
			$result = $this->db->query("SELECT * FROM tbl_student WHERE id = '$partyid'");
			return $result->row_array();
		}
		function selectElem($elementary, $p){
			$result = $this->db->query("SELECT firstname as elementary, (SELECT completionelementary FROM tbl_student WHERE `elementary` = '$elementary' AND id = '$p') as completionelementary FROM tbl_party WHERE tbl_party.id = '$elementary'");
			return $result->row_array();
		}
		function selectSec($secondary, $p){
			
			$result = $this->db->query("SELECT firstname as `secondary`, (SELECT completionsecondary FROM tbl_student WHERE `secondary` = '$secondary' AND id = '$p') as completionsecondary FROM tbl_party WHERE `id` = '$secondary'");
			return $result->row_array();
		}
		function selectTertiary($primary, $p){
			$result = $this->db->query("SELECT firstname as `primary`, (SELECT completionprimary FROM tbl_student WHERE `primary` = '$primary' AND id = '$p') as completionprimary FROM tbl_party WHERE `id` = '$primary'");
			return $result->row_array();
		}
		function get_school($partyid){
			$result = $this->db->query("SELECT school, firstname as sch
				FROM tbl_enrolment, tbl_party where student = '$partyid' 
				AND tbl_party.id = tbl_enrolment.school GROUP BY school");
				return $result->result_array();
		}
		function select_schoolyear($partyid, $school){
			$this->db->select('academicterm');
			$this->db->where('student', $partyid);
			$this->db->where('school', $school);
			$this->db->group_by('academicterm');
			$this->db->order_by('academicterm');
			$result = $this->db->get('tbl_enrolment');
			return $result->result_array();
		}
		function select_academicterm($academicterm){
			
		$result = $this->db->query("SELECT systart, syend, tbl_academicterm.term,description 
				FROM tbl_academicterm, tbl_term WHERE tbl_academicterm.id = '$academicterm' 
				AND tbl_term.id = tbl_academicterm.term");
				return $result->row_array();
		}
		function select_enrolmentid($academicterm, $partyid){
			$this->db->select('id as enrolmentid');
			$this->db->where('student', $partyid);
			$this->db->where('academicterm', $academicterm);
			$result = $this->db->get('tbl_enrolment');
			/*$result = $this->db->query("SELECT id as enrolmentid FROM tbl_enrolment WHERE student = '$partyid' 
				AND academicterm = '$academicterm'");*/
				return $result->result_array();
		}
		function get_all_grades($enrolmentid){
			$data = array('enrolment' => $enrolmentid);
			$result = $this->db->get_where('views_studentgrade', $data);
			return $result->result_array();

		}
		function theflag($partyid){
			$this->db->where('id',$partyid);
			$this->db->where('status', 'C');
			$q = $this->db->count_all_results('tbl_party');
			return $q;
		}
		function selectcurr($partyid, $date, $coursemajor, $term, $yearlevel){
				$getAc = $this->db->query("SELECT coursemajor, `date`, student, academicterm FROM tbl_registration WHERE coursemajor = '$coursemajor' AND student = '$partyid' AND `date` = '$date'");
				$x = $getAc->row_array();
				 $acad = $x['academicterm'];
				$result = $this->db->query("SELECT tbl_curriculum.id as curr, `description` as currdescription, coursemajor, academicterm, curriculum, subject, `units`, yearlevel, term,  tbl_subject.id as subid, `code`, descriptivetitle 
				FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject WHERE (tbl_curriculum.academicterm = '$acad' AND tbl_curriculum.coursemajor = '$coursemajor') AND
				 tbl_curriculum.id = curriculum AND tbl_subject.id = subject AND term = '$term' AND yearlevel = '$yearlevel' GROUP BY `code`, descriptivetitle ORDER BY curr, academicterm, yearlevel, term");
			return $result->result_array();
		}
		function getCurin($partyid, $date, $coursemajor){
				$getAc = $this->db->query("SELECT coursemajor, `date`, student, academicterm FROM tbl_registration WHERE coursemajor = '$coursemajor' AND student = '$partyid' AND `date` = '$date'");
				$x = $getAc->row_array();
				 $acad = $x['academicterm'];
				$result = $this->db->query("SELECT  tbl_course.description as coursedescription,CONCAT(systart, '-', syend) as effectivity
				FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject, tbl_coursemajor, tbl_course, tbl_academicterm WHERE (tbl_curriculum.academicterm = '$acad'
				 AND tbl_curriculum.coursemajor = '$coursemajor') AND tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND 
				tbl_curriculum.id = curriculum GROUP BY coursedescription ORDER BY academicterm, yearlevel, tbl_curriculumdetail.term");
				return $result->row_array();
		}
		function getYearTerm($partyid, $date, $coursemajor){
				$getAc = $this->db->query("SELECT coursemajor, `date`, student, academicterm FROM tbl_registration WHERE coursemajor = '$coursemajor' AND student = '$partyid' AND `date` = '$date'");
				$x = $getAc->row_array();
				 $acad = $x['academicterm'];

			$result = $this->db->query("SELECT coursemajor, academicterm, curriculum, yearlevel, tbl_curriculumdetail.term as term,  tbl_subject.id as subid, course, tbl_course.description as coursedescription,syend,systart
										FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject, tbl_coursemajor, tbl_course, tbl_academicterm WHERE (tbl_curriculum.academicterm = '$acad' AND tbl_curriculum.coursemajor = '$coursemajor')
										 AND tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND 
										tbl_curriculum.id = curriculum GROUP BY term, yearlevel ORDER BY academicterm, yearlevel, term");
			return $result->result_array();
		}

		function get_schools(){
			$result = $this->db->query("SELECT tbl_party.id, shortname, firstname, registrarname, primary, seconday, elementary, tertiary
				FROM tbl_school, tbl_party where  
				tbl_party.id = tbl_school.id");
				return $result->result_array();
		}
		function insertcurr(){
			echo 1;
		}
	}

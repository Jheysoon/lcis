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
					for ($i=$acad; $i > 0 ; $i--) { 
                            $a = $this->curriculum->getMatch($i,$coursemajor);
                            if($a != 'repeat')
                            {
                                $ac = $i;
                                break;
                            }
                        }

				$result = $this->db->query("SELECT tbl_curriculum.id as curr, `description` as currdescription, coursemajor, academicterm, curriculum, subject, `units`, tbl_curriculumdetail.yearlevel, term,  tbl_subject.id as subid, `code`, descriptivetitle 
				FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject WHERE (tbl_curriculum.academicterm = '$ac' AND tbl_curriculum.coursemajor = '$coursemajor') AND
				 tbl_curriculum.id = curriculum AND tbl_subject.id = subject AND term = '$term' AND tbl_curriculumdetail.yearlevel = '$yearlevel' GROUP BY `code`, descriptivetitle ORDER BY curr, academicterm, tbl_curriculumdetail.yearlevel, term");
			return $result->result_array();
		}
		function getCurin($partyid, $date, $coursemajor){
				$this->load->model('registrar/curriculum');
				$getAc = $this->db->query("SELECT coursemajor, `date`, student, academicterm FROM tbl_registration WHERE coursemajor = '$coursemajor' AND student = '$partyid' AND `date` = '$date'");
				$ac = 0;
				$x = $getAc->row_array();
				$acad = $x['academicterm'];
					for ($i=$acad; $i > 0 ; $i--) { 
                            $a = $this->curriculum->getMatch($i,$coursemajor);
                            if($a != 'repeat')
                            {
                            	echo $i;
                                $ac = $i;
                                break;
                            }
                        }


				$result = $this->db->query("SELECT  tbl_course.description as coursedescription,CONCAT(systart, '-', syend) as effectivity
				FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject, tbl_coursemajor, tbl_course, tbl_academicterm WHERE (tbl_curriculum.academicterm = '$ac'
				 AND tbl_curriculum.coursemajor = '$coursemajor') AND tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND 
				tbl_curriculum.id = curriculum GROUP BY coursedescription ORDER BY academicterm, tbl_curriculumdetail.yearlevel, tbl_curriculumdetail.term");
				return $result->row_array();
		}
		function getYearTerm($partyid, $date, $coursemajor){
					$this->load->model('registrar/curriculum');
				$getAc = $this->db->query("SELECT coursemajor, `date`, student, academicterm FROM tbl_registration WHERE coursemajor = '$coursemajor' AND student = '$partyid' AND `date` = '$date'");
				$x = $getAc->row_array();
				$ac = 0;
				 $acad = $x['academicterm'];
				 for ($i=$acad; $i > 0 ; $i--) { 
                            $a = $this->curriculum->getMatch($i,$coursemajor);
                            if($a != 'repeat')
                            {
                                $ac = $i;
                                break;
                            }
                        }
			$result = $this->db->query("SELECT coursemajor, academicterm, curriculum, tbl_curriculumdetail.yearlevel as yearlevel, tbl_curriculumdetail.term as term,  tbl_subject.id as subid, course, tbl_course.description as coursedescription,syend,systart
										FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject, tbl_coursemajor, tbl_course, tbl_academicterm WHERE (tbl_curriculum.academicterm = '$ac' AND tbl_curriculum.coursemajor = '$coursemajor')
										 AND tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND 
										tbl_curriculum.id = curriculum GROUP BY term, tbl_curriculumdetail.yearlevel ORDER BY academicterm, tbl_curriculumdetail.yearlevel, term");
			return $result->result_array();
		}

		function get_schools(){
			$result = $this->db->query("SELECT tbl_party.id as sch_id, shortname, firstname, registrarname
				FROM tbl_school, tbl_party WHERE  
				tbl_party.id = tbl_school.id");
				return $result->result_array();
		}

		function get_school_detail($id){
			$result = $this->db->query("SELECT tbl_party.id as sch_id, shortname, address1, firstname, registrarname, `primary`, secondary, elementary, tertiary
				FROM tbl_school, tbl_party WHERE  
				tbl_party.id = tbl_school.id AND tbl_school.id = '$id'");
				return $result->row_array();
		}

		function insertcurr(){
			echo 1;
		}
		function getsub(){
			$result = $this->db->query("SELECT `id`,code, descriptivetitle FROM tbl_subject WHERE tbl_subject.id NOT IN (SELECT subject FROM tbl_curriculumdetail)");
			return $result->result_array();
		}
		function getC($coursemajor, $acad){
				$result = $this->db->query("SELECT tbl_curriculum.id as currid, tbl_curriculum.coursemajor, tbl_curriculum.academicterm, tbl_coursemajor.course as coursid, 
					tbl_course.description as coursedescription, CONCAT(systart, '-', syend) as effectivity FROM tbl_curriculum, tbl_coursemajor, tbl_course, tbl_academicterm 
					WHERE tbl_curriculum.coursemajor = '$coursemajor' AND tbl_curriculum.academicterm = '$acad' AND tbl_coursemajor.id = '$coursemajor' AND tbl_course.id = course AND tbl_academicterm.id = tbl_curriculum.academicterm");
				return $result->row_array();





			/*$result = $this->db->query("SELECT  tbl_course.description as coursedescription,CONCAT(systart, '-', syend) as effectivity
				FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject, tbl_coursemajor, tbl_course, tbl_academicterm WHERE (tbl_curriculum.academicterm = '$acad'
				 AND tbl_curriculum.coursemajor = '$coursemajor') AND tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND 
				tbl_curriculum.id = curriculum GROUP BY coursedescription ORDER BY academicterm, tbl_curriculum.yearlevel, tbl_curriculumdetail.term");
			return $result->row_array();*/
		}
		function getHeaderYear($academicterm, $coursemajor){
			$result = $this->db->query("SELECT coursemajor, academicterm, curriculum, tbl_curriculumdetail.yearlevel as yearlevel, tbl_curriculumdetail.term as term,  tbl_subject.id as subid, course, tbl_course.description as coursedescription,syend,systart
										FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject, tbl_coursemajor, tbl_course, tbl_academicterm WHERE (tbl_curriculum.academicterm = '$academicterm' AND tbl_curriculum.coursemajor = '$coursemajor')
										 AND tbl_coursemajor.id = coursemajor AND tbl_course.id = course AND tbl_academicterm.id = academicterm AND 
										tbl_curriculum.id = curriculum GROUP BY term, tbl_curriculumdetail.yearlevel ORDER BY academicterm, tbl_curriculumdetail.yearlevel, term");
			return $result->result_array();
		}
		function getsubcur($acad, $major,$term, $yearlevel){
				$result = $this->db->query("SELECT tbl_curriculum.id as curr, `description` as currdescription, coursemajor, academicterm, curriculum, subject, `units`, tbl_curriculumdetail.yearlevel as yearlevel, tbl_curriculumdetail.term,  tbl_subject.id as subid, `code`, descriptivetitle 
				FROM tbl_curriculum, tbl_curriculumdetail, tbl_subject WHERE (tbl_curriculum.academicterm = '$acad' AND tbl_curriculum.coursemajor = '$major') AND
				tbl_curriculum.id = curriculum AND tbl_subject.id = subject AND tbl_curriculumdetail.term = '$term' AND tbl_curriculumdetail.yearlevel = '$yearlevel' GROUP BY `code`, descriptivetitle ORDER BY curr, academicterm, tbl_curriculumdetail.yearlevel, term");
				return $result->result_array();
		}
		function getM($coursemajor, $acad){
			$result = $this->db->query("SELECT tbl_curriculum.id as currid, tbl_curriculum.coursemajor, tbl_curriculum.academicterm, tbl_coursemajor.course as coursid, 
					CONCAT(tbl_course.description, ' (', tbl_major.description, ')') as coursedescription, CONCAT(systart, '-', syend) as effectivity FROM tbl_curriculum, tbl_coursemajor, tbl_course, tbl_academicterm, tbl_major 
					WHERE tbl_curriculum.coursemajor = '$coursemajor' AND tbl_curriculum.academicterm = '$acad' AND tbl_coursemajor.id = '$coursemajor' AND tbl_course.id = course 
					AND tbl_academicterm.id = tbl_curriculum.academicterm AND tbl_major.id = tbl_coursemajor.major");
				return $result->row_array();

		}

		function check_school($id){
	        $query = $this->db->query("SELECT * FROM tbl_school, tbl_student 
	                          WHERE (
	        				  	tbl_student.primary = '$id' OR
	        				  	tbl_student.secondary = '$id' OR
	        				  	tbl_student.elementary = '$id'
	                          ) 
	        				  AND (
	                          	tbl_school.id = tbl_student.primary
	                          	OR tbl_school.id = tbl_student.secondary
	                          	OR tbl_school.id = tbl_student.elementary
	        				  )");
	        return $query->num_rows();
		}

		function delete_school($id){

	        $this->db->where('id', $id);
	        $this->db->delete('tbl_school');

	        $this->db->where('id', $id);
	        $this->db->delete('tbl_party');

		}
	}

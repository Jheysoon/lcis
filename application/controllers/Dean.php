<?php
/*
| -------------------------------------
| @file  : Dean.php
| @date  : 3/26/2015
| @author: JOG Developers
| -------------------------------------
*/

class Dean extends CI_Controller
{
    public $sample;
    public $message;
    public $message1;
    public $ret;
    public $error;

    private function head()
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/student'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

    function listSubjectSectioning()
    {
        $this->head();
        $this->load->view('dean/list_subjectsectioning');
        $this->load->view('templates/footer');
    }

    function ClassAllocation()
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

        $this->load->view('dean/dean_classAllocation');
        $this->load->view('templates/footer');
    }
    function qwe()
    {
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

        $this->load->view('edp/edpScheduling');
        $this->load->view('templates/footer');
    }

    function adddelete_Section()
    {
        $this->head();
        $this->load->view('dean/adddelete_section');
        $this->load->view('templates/footer');
    }

    function PreEnrolment()
    {
        $this->head();
        $this->load->view('dean/dean_preEnroll');
        $this->load->view('templates/footer');
    }

    function enrolmentLegacyGrouping(){
        $this->load->model('dean/group');
        $this->load->view('dean/enrolment_grouping');
        $this->load->view('templates/footer');
    }

    function updateStudentLoad()
    {
        $this->head();
        $this->load->view('dean/update_studentload');
        $this->load->view('templates/footer');
    }

    function listGradingList()
    {
        $this->head();
        $this->load->view('dean/grading_list');
        $this->load->view('templates/footer');
    }

    function listINCsubject()
    {
        $this->head();
        $this->load->view('dean/incsubject_list');
        $this->load->view('templates/footer');
    }

    function listAttest()
    {
        $this->head();
        $this->load->view('dean/attest_list');
        $this->load->view('templates/footer');
    }

    function listCompletedINC()
    {
        $this->head();
        $this->load->view('dean/completedinc_list');
        $this->load->view('templates/footer');
    }

    function listSubject()
    {
        $this->head();
        $this->load->view('dean/subject_list');
        $this->load->view('templates/footer');
    }

    function listCurriculum()
    {
        $this->head();
        $this->load->view('dean/curriculum_list');
        $this->load->view('templates/footer');
    }

    function edit_subject($sid, $param = '')
    {
        if(!empty($sid) AND is_numeric($sid))
        {
            $this->load->model(array(
                'dean/subject',
                'dean/group',
                'dean/college'
            ));

            $this->api->userMenu();

            $sub                        = $this->subject->find($sid);
            extract($sub);
            $data['code']               = $code;
            $data['descriptivetitle']   = $descriptivetitle;
            $data['units']              = $units;
            $data['shortname']          = $shortname;
            $data['majorsubject']       = $majorsubject;
            $data['hours']              = $hours;
            $data['bookletcharge']      = $bookletcharge;
            $data['sid']                = $sid;
            $data['owner']              = $owner;
            $data['comp']               = $computersubject;
            $data['ge']                 = $gesubject;
            $data['academic']           = $nonacademic;
            $data['error']              = '';
            $data['param']              = $param;

            $this->load->view('dean/subjects', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            show_error('Did you type the url by yourself ?');
        }
    }

    function add_subject()
    {
        $this->load->model(array(
            'dean/subject',
            'dean/group',
            'dean/college'
        ));

        $this->load->library('form_validation');
        $this->load->helper('form');

        // rules
        $this->form_validation->set_rules('code', 'Subject Code', 'trim|required');
        $this->form_validation->set_rules('title', 'Descriptive Title', 'trim|required');
        $this->form_validation->set_rules('units', 'Subject Units', 'trim|required|integer');
        $this->form_validation->set_rules('hours', 'Subject Hours', 'trim|required|integer');

        if($this->form_validation->run() === FALSE)
        {
            $this->api->userMenu();
            $this->load->view('dean/add_subject');
            $this->load->view('templates/footer');
        }
        else
        {
            $data['code']               = strtoupper($this->input->post('code'));
            $data['descriptivetitle']   = strtoupper($this->input->post('title'));
            $data['shortname']          = trim($this->input->post('shortname'));
            $data['units']              = $this->input->post('units');
            $data['hours']              = $this->input->post('hours');
            $data['bookletcharge']      = $this->input->post('booklet');
            $data['majorsubject']       = $this->input->post('major');
            $data['group']              = $this->input->post('group');
            $data['owner']              = $this->input->post('owner');
            $data['nonacademic']        = $this->input->post('academic');
            $data['gesubject']          = $this->input->post('ge');
            $data['computersubject']    = $this->input->post('comp');

            // check if the subject code already exists

            $this->db->where('code', $data['code'])
            ->where('descriptivetitle', $data['descriptivetitle'])
            ->where('units', $data['units']);
            $c = $this->db->count_all_results('tbl_subject');
            if($c < 1)
            {
                $this->subject->insert($data);
                $this->session->set_flashdata('message',
                '<div class="alert alert-success" style="margin:20px;">
                    Subject Successfully Inserted
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect(base_url('menu/dean-subject_list'));
            }
            else
            {
                $this->api->userMenu();
                $d['error'] = '<div class="alert alert-danger">Subject already exists</div>';
                $this->load->view('dean/add_subject', $d);
                $this->load->view('templates/footer');
            }

        }
    }

    function save_subject()
    {

        $data['code']               = strtoupper($this->input->post('code'));
        $data['descriptivetitle']   = strtoupper($this->input->post('title'));
        $data['shortname']          = trim($this->input->post('shortname'));
        $data['units']              = $this->input->post('units');
        $data['hours']              = $this->input->post('hours');
        $data['bookletcharge']      = $this->input->post('booklet');
        $data['majorsubject']       = $this->input->post('major');
        $data['group']              = $this->input->post('group');
        $data['owner']              = $this->input->post('owner');
        $data['nonacademic']        = $this->input->post('academic');
        $data['gesubject']          = $this->input->post('ge');
        $data['computersubject']    = $this->input->post('comp');
        $id                         = $this->input->post('sid');

        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/subject',
            'dean/group','dean/college'
        ));

        $this->load->library('form_validation');
        $this->load->helper('form');

        $rules = array(
                    array('field' => 'title', 'label' => 'Descriptive Title', 'rules' => 'trim|required'),
                    array('field' => 'units', 'label' => 'Subject Units' ,    'rules' => 'trim|required|integer'),
                    array('field' => 'hours', 'label' => 'Subject Hours',     'rules' => 'trim|required|integer')
                );

        $this->form_validation->set_rules($rules);

        $q = $this->subject->whereCode($data['code']);
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/header_title2');
            $this->load->view('dean/ed_subj');
            $this->load->view('templates/footer');
        }
        elseif($q > 0)
        {
            $q = $this->subject->count($data['code']);
            if($q['id'] == $id)
            {
                $this->subject->update($id,$data);
                $this->session->set_flashdata('message','<div class="alert alert-success">
                        Subject Successfully Updated
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="color:#000;">&times;</span>
                        </button>
                    </div>');
                redirect(base_url('dean/edit_subject/'.$id));
            }
            else
            {
                $d['error'] = '<div class="alert alert-danger">Subject Code Already Exists</div>';
                $this->load->view('templates/header');
                $this->load->view('templates/header_title2');
                $this->load->view('dean/ed_subj',$d);
                $this->load->view('templates/footer');
            }
        }
        else
        {
            $this->subject->update($id,$data);
            $this->session->set_flashdata('message','<div class="alert alert-success">
                    Subject Successfully Updated
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true" style="color:#000;">&times;</span>
                    </button>
                </div>');
            redirect(base_url('dean/edit_subject/'.$id));
        }

    }
    function delete_subject()
    {
        $id = $this->input->post('value');
        $this->db->where('id',$id);
        $this->db->delete('tbl_subject');
    }
    function search_subject($sid)
    {
        $this->load->model(array(
            'dean/subject',
            'dean/common_dean'
        ));

        $sid        = urldecode($sid);
        $college    = $this->api->getUserCollege();
        $s          = $this->subject->search($sid,$college);
        $data       = array();

        foreach ($s as $r)
        {
            $data[] = array('value' => $r['code'], 'name' => $r['descriptivetitle']);
        }
        echo json_encode($data);
    }
    function search()
    {
        $code   = $this->input->post('search');
        $url    = $this->input->post('url');
        $q      = $this->subject->whereCode($code);

        $this->load->model('dean/subject');
        if($q > 0)
        {
            $sid = $this->subject->count($code);
            redirect(base_url('edit_subject/'.$sid['id']));
        }
        else
        {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger" style="margin:20px;">
                    Subject Not Found
                </div>');
            redirect($url);
        }
    }
    function load_sub()
    {
        $sid                = $this->input->post('value');
        $data['college']    = $sid;
        $this->load->model('dean/subject');
        $this->load->view('dean/ajax/tbl_subject',$data);
    }

//----------------------------------------------------------------------
// Function for evaluation process.
//----------------------------------------------------------------------

    function evaluation($id){
        $this->head();
        $data['id'] = $id;

        // Load required models.
        $this->load->model('edp/edp_classallocation');

        // Load required helper ( form helper for sticky input data ).
        $this->load->helper('form');

        // Check for form submission.
        // This section is ignored during start of evaluation process.
        if ($this->input->post('btn')) {
            $r1 = $this->saveEvaluation();
            if($r1 == true){
                redirect('/dean_evaluation/'.$this->input->post('legid'));
            }
        }

        //  Prepare data and start loading evaluation UI.
        $data['message'] = $this->message1;
        $data['sample'] = $this->sample;
        $data['ret'] = $this->ret;

        $this->load->view('dean/dean_preEnroll', $data);
        $this->load->view('templates/footer');
    }

    function ident_subj($id)
    {
        $college    = $this->api->getUserCollege();
        $s          = $this->subject->find($id);

        if($s['owner'] == $college)
        {
            redirect(base_url('edit_subject/'.$id));
        }
        else
        {
            redirect(base_url('edit_subject/'.$id.'/view'));
        }
    }

    function searchStud()
    {
        $this->load->model('dean/student');

        $id  = $this->input->post('search');
        $col = $this->input->post('col');
        $id1 = $this->student->existsID($id);

        if ($id1)
        {
            extract($id1);
            if ($cid == $col) {
                redirect('/dean_evaluation/' . $id);
            }
            else{
                $this->session->set_flashdata('message', '<div class="alert alert-warning">Unable to evaluate! Student belong to <strong>'.$description.'</strong>.</div>');
                redirect($this->input->post('cur_url'));
            }
        }
        else
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Unable to find student id</div>');
            redirect($this->input->post('cur_url'));
        }
    }

    function search_student_det($sid)
    {
        $sid = urldecode($sid);
        $this->load->model(array(
            'dean/student'
        ));

        $college    = $this->api->getUserCollege();
        $s          = $this->student->getStudent($sid,$college);
        $data       = array();

        foreach ($s as $r)
        {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['lastname'].' '.$r['firstname']);
        }
        echo json_encode($data);
    }
    function calculatebill($enid){
        $this->load->model('dean/student');
        return $this->student->getCalculation($enid);
    }

    function addClassAlloc1()
    {
        $id                 = $this->input->post('out_section_id');
        $data['section']    = $this->input->post('sections');

        $this->db->where('id', $id);
        $this->db->update('out_section', $data);
    }

    // leave it as is..
    function addClassAlloc()
    {
        $this->load->model('dean/out_section');

        $data['coursemajor']    = $this->input->post('course_major');
        $nxt                    = $this->api->systemValue();
        $data['academicterm']   = $nxt['nextacademicterm'];
        $data['subject']        = $this->input->post('subject');
        $data['section']        = $this->input->post('sections');
        $data['yearlevel']      = $this->input->post('yearlevel');
        $is_ajax                = $this->input->post('is_ajax');

        if($is_ajax != 0)
            $data['studentcount'] = $this->input->post('studentcount');

        //$c = $this->out_section->whereCount($data['academicterm'],$data['coursemajor'],$data['subject'],$data['yearlevel']);
        $id = $this->input->post('out_section_id');
        if($id == NULL)
            $this->db->insert('out_section', $data);
        else
        {
            $this->db->where('id',$id);
            $this->db->update('out_section', $data);
        }

        if($is_ajax == 0)
            redirect(base_url('non_exist'));
    }

//-------------------------------------------------------------------------
// function for saving evaluation
//-------------------------------------------------------------------------

    function saveEvaluation(){
        $this->load->model('dean/student');
        $this->load->model('edp/edp_classallocation');
        $ctr = $this->input->post('count');
        $ctr2 = 1;
        $unit = 0;
        $subCount = 0;

        // Putting all selected schedules into schedule array.

        while ( $ctr != 0) {
            if ($this->input->post('rad-'.$ctr) !== NULL) {
                $names['var'.$ctr2] = $this->input->post('rad-'.$ctr);
                $un = $this->student->getUnits($this->input->post('rad-'.$ctr));
                extract($un);
                $unit = $unit + $units;
                $subCount++;
                $ctr2++;
            }
            $ctr--;
        }

        // Check if there is additional subject/s and put it on schedule array.

        if($this->input->post('additional')){
            $this->ret = $this->input->post('additional');
            $add = array();
            foreach ($this->ret as $key => $cid) {

                // Get subject ID for duplicate verification.
                $sub = $this->student->getSubject($cid);

                // Check if there are any duplicate subjects in additional subject table.
                if (in_array($sub['code'], $add)) {
                    $this->message1 = '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Duplicate subject <strong>'.$sub['code'].'</strong> in additional subject table.</d><br/>';
                    return false;
                }
                else{
                    $names['var'.$ctr2] = $cid;
                    $un = $this->student->getUnits($cid);
                    extract($un);
                    $unit = $unit + $units;
                    $subCount++;
                    $ctr2++;
                }
                $add[] = $sub['code'];
            }
        }

        // Check if schedule array is set.

        if (isset($names)) {
            extract($names);
            $ctr2 = $ctr2-1;
            $i = $ctr2;

            // Separating multi-scheduled class allocations/subjects
            // into individual schedules (eg. ENG 103, T/TH, 8:00-9:00/9:00-10:00)
            // and put them in a new array for conflict checking.

            while ($ctr2 != 0) {
                $ii = $i;
                $p = $this->edp_classallocation->getPeriod(${'var'.$ctr2});
                $d = $this->edp_classallocation->getDayShort(${'var'.$ctr2});
                $contains = strrpos($p, '/');
                if($contains !== false){
                    $period1 = explode(' / ', $p);
                    $day1 = explode(' / ', $d);
                    foreach ($period1 as $count1 => $val1) {
                        $individual[] = ${'var'.$ctr2}.",".$day1[$count1].",".$val1;
                    }
                }
                else{
                    $individual[] = ${'var'.$ctr2}.",".$d.",".$p;

                }
                $ctr2--;
            }
            $compare = $individual;
            $message = '';

            //Checking conflicts.
            $dup = array();
            foreach ($individual as $key => $value) {
                $p = explode(",", $value);
                foreach ($compare as $key2 => $value2) {
                    $p2 = explode(",", $value2);
                    if ($key != $key2 && !in_array($value2, $dup)) {
                        if ($p[1] == $p2[1]) {
                            $t1 = explode("-", $p[2]);
                            $t2 = explode("-", $p2[2]);
                            $res = $this->api->intersectCheck($t1[0], $t2[0], $t1[1], $t2[1]);
                            if($res == TRUE){
                                $sub1 = $this->student->getSubs($p[0]);
                                $sub2 = $this->student->getSubs($p2[0]);
                                $message = $message.$sub1['code']." ".$p[1]." ".$p[2]."  -  ".$sub2['code']." ".$p2[1]." ".$p2[2]."<br/>";
                            }
                        }
                    }
                }

                // Array that holds checked schedules.
                // Used to avoid checking schedules that are already checked.
                $dup[] = $value;
            }

            // If there are no conflicts proceed to saving.
            if ($message == '') {

                $student        = $this->input->post('student');
                $coursemajor    = $this->input->post('coursemajor');
                $registration   = $this->input->post('registration');
                $academicterm   = $this->input->post('academicterm');

                // Checking if student is already evaluated.
                $eval = $this->student->checkEvaluation($student, $academicterm);
                if ($eval) {
                    $Evalue = $this->student->getEvaluation($eval['id']);
                    foreach ($Evalue as $key => $value) {
                        $res = $this->student->getReserved($value['classallocation']);
                        $res = $res['reserved'] - 1;
                        $this->student->updateReserved($value['classallocation'], $res);
                    }
                    $this->student->deleteEvaluation($eval['id']);
                    $enid = $eval['id'];
                    $this->student->updateEnrolment($enid, $unit, $subCount);
                }
                else{
                    $status = 'R';
                    $enid = $this->student->addEnrolment($subCount, $student, $coursemajor, $registration, $academicterm, $unit, $status);
                }

                // Adding new records to student grade
                foreach ($names as $key => $value) {
                    $res = $this->student->getReserved($value);
                    $res = $res['reserved'] + 1;
                    $this->student->addInitialGrade($value, $enid);
                    $this->student->updateReserved($value, $res);
                }

                // Call billing method.
                $this->calculatebill($enid);

                // Success message
                $this->message1 = '<div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Evaluation successfuly saved</strong><br/>
                </div>';
                return false;
            }
            else{
                $this->message1 = '<div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Conflict/s are found!</strong><br/>
                  '.$message.'
                </div>';
                return false;
            }
        }
        else{

            $this->message1 = '<div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              No schedule selected.
            </div>';
            return false;
        }

    }

    function addSubjAlloc()
    {
        $this->api->userMenu();

        $this->load->model(array(
            'dean/subject',
            'registrar/course',
            'registrar/classallocation'
        ));

        $this->load->library('form_validation');
        $this->load->helper('form');
        $systemVal = $this->api->systemValue();

        $this->form_validation->set_rules('sections','Section','required|integer');
        $data['error'] = '';

        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('dean/add_non_subject', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $subject    = $this->input->post('subject');
            $cmajor     = $this->input->post('course_major');
            $q          = $this->db->query("SELECT * FROM out_section WHERE coursemajor = $cmajor AND subject = $subject")->num_rows();
            if($q > 0)
            {
                $data['error'] = '<div class="alert alert-danger">You have already assigned this subject with this course</div>';
                $this->load->view('dean/add_non_subject', $data);
                $this->load->view('templates/footer');
            }
            else
            {
                $db['subject']      = $subject;
                $db['coursemajor']  = $cmajor;
                $db['section']      = $this->input->post('sections');
                $db['academicterm'] = $systemVal['nextacademicterm'];
                $db['studentcount'] = 0;
                $db['yearlevel']    = $this->input->post('yearlevel');
                $this->db->insert('out_section', $db);
                redirect('/non_exist');
            }
        }
    }

    function add_day_period($cid)
    {
        $this->api->userMenu();
        $this->load->model(array(
            'edp/edp_classallocation',
            'dean/subject'
        ));

        $this->load->helper('form');

        if($this->input->post('day'))
        {
            $ret = $this->ass_subj();
            if($ret == TRUE)
            {
                redirect('/menu/dean-add_day_period');
            }
        }

        $data['error']  = $this->error;
        $data['cid']    = $cid;
        $this->load->view('dean/assigned_subj', $data);
        $this->load->view('templates/footer');
    }

    function edp_override($id)
    {
        $this->api->userMenu();
        $this->load->model(array(
            'edp/classroom',
            'edp/edp_classallocation',
            'dean/subject'
        ));
        $this->load->helper('form');

        if($this->input->post('day'))
        {
            $valid = $this->ass_subj();
            if($valid)
            {
                redirect('/assign_room/'.$cid);
            }
        }
        $data['error']  = $this->error;
        $data['cid']    = $id;
        $this->load->view('edp/assign_subj_room', $data);
        $this->load->view('templates/footer');
    }

    // function in adding day period
    function ass_subj()
    {
        $day        = $this->input->post('day');
        $cid        = $this->input->post('class_id');
        $url        = $this->input->post('url');

        $days       = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

        foreach($day as $key => $value)
        {
            $start_time = $this->input->post('start_time'.$value);
            $end_time   = $this->input->post('end_time'.$value);

            // check if the user select the noon break time period
            if($start_time != 11 AND $end_time != 12)
            {
                //end time period must be greater than the start time period
                if($end_time > $start_time)
                {
                    // check if schedule overlaps
                    if( ($start_time >= 1 AND $end_time <= 11) OR ($start_time >= 12 AND $end_time <= 27) )
                    {
                        // delete first the days and period before inserting
                        $this->db->query("DELETE FROM tbl_dayperiod WHERE classallocation = $cid");

                        $data['classallocation']    = $cid;
                        $data['day']                = $value;
                        $data['from_time']          = $start_time;
                        $data['to_time']            = $end_time;
                        $this->db->insert('tbl_dayperiod', $data);
                    }
                    else
                    {

                        $this->error = '<div class="alert alert-danger" style="text-align:center">Overlaps Schedule in '.$days[$value - 1].'</div>';
                        return FALSE;
                    }
                }
                else
                {
                    $this->error = '<div class="alert alert-danger" style="text-align:center">End Time Period must be greater than Start Time in '.$days[$value - 1].'</div>';
                    return FALSE;
                }
            }
            else
            {
                $this->error = '<div class="alert alert-danger" style="text-align:center">Time Period must not 12:00 am - 1:00 pm in '.$days[$value - 1].'</div>';
                return FALSE;
            }
        }
        $this->api->set_session_message('success','Successfully added');
        return TRUE;
    }

//------------------------------------------------------------------------
// Searching function for adding subject in evaluation method
// (called through ajax @ views/dean/ajax/evaluation.js).
// A table of searched subjects is displayed after execution.
//------------------------------------------------------------------------

    function ajaxEvaluation(){
        $this->load->model('dean/student');

        $term        = $this->input->post('term');
        $student     = $this->input->post('student');
        $course      = $this->input->post('course');
        $subject     = $this->input->post('subject');

        $param = array(
            'term' => $term,
            'student' => $student,
            'course' => $course,
            'subject' => $subject
        );

        $this->load->view('dean/ajax/modal_evaluation', $param);
    }

    function ajaxSched(){
        $this->load->model('edp/edp_classallocation');
        $this->load->model('dean/student');
        $this->load->helper('form');

        $term        = $this->input->post('term');
        $subject     = $this->input->post('subject');

        $param = array(
            'term' => $term,
            'subject' => $subject
        );

        $this->load->view('dean/ajax/tbl_AddSubSched', $param);
    }

//-------------------------------------------------------------------------
// Function for adding subject to additional subject table in evaluation
// (called through ajax @ views/dean/ajax/evaluation.js)
//-------------------------------------------------------------------------

    function appendSubject(){
        $this->load->model('edp/edp_classallocation');
        $this->load->model('dean/student');
        $this->load->helper('form');

        if ($this->input->post('choose')) {
            $cid = $this->input->post('choose');
            $sub = $this->student->getSubject($cid);

            $p = $this->edp_classallocation->getPeriod($cid);
            $d = $this->edp_classallocation->getDayShort($cid);
            $r = $this->edp_classallocation->getRoom($cid);

            $reserved = $this->student->getReserved($cid);
            $enrolled = $this->student->getEnrolled($cid);

            $append = "
            <tr>
                <input type='hidden' name='additional[]' value='".$cid."'>
                <td>".$sub['code']."</td>
                <td>".$d."</td>
                <td>".$p."</td>
                <td>".$r['room']."</td>
                <td>".$r['location']."</td>
                <td>".$reserved['reserved']."</td>
                <td>".$enrolled['enrolled']."</td>
                <td>
                    <a class='a-table label label-danger remove' data-param='".$sub['code']."'>Remove
                    <span class='glyphicon glyphicon-trash'></span></a>
                </td>
            </tr>";
            echo $append;
        }
    }
    // function to delete classallocation
    function delete_classalloc($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_classallocation');
        $this->db->where('classallocation', $id);
        $this->db->delete('tbl_dayperiod');
        redirect('/menu/dean-add_day_period');
    }

     // function to create classallocation
    function add_classalloc()
    {
        $data['subject']        = $this->input->post('subj');
        $data['coursemajor']    = $this->input->post('course_major');
        $this->db->insert('tbl_classallocation', $data);
        redirect('/menu/dean-add_day_period');
    }

    // function to update/insert in tbl_completion
    function add_task_comp($stage,$status,$id = '')
    {
        $uid                    = $this->session->userdata('uid');
        $systemVal              = $this->api->systemValue();
        $data['academicterm']   = $systemVal['currentacademicterm'];
        $data['stage']          = $stage;
        $data['completedby']    = $uid;
        $data['status']         = $status;
        $data['statusdate']     = date('Y-m-d');
        if(empty($id))
        {
            $this->db->where('stage', $stage);
            $this->db->where('completedby', $uid);
            $r = $this->db->get('tbl_completion');
            if($r->num_rows() < 1)
            {
                $this->db->insert('tbl_completion', $data);
            }
            else
            {
                $rr = $r->row_array();
                $this->db->where('id', $rr['id']);
                $this->db->update('tbl_completion', $data);
            }
            //check if all the dean has already submitted
            $this->chkDeanActivity($stage);
            redirect(base_url());
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->update('tbl_completion', $data);
        }
    }

    function chkDeanActivity($stage)
    {
        $this->db->where('stage', $stage);
        $q = $this->db->count_all_results('tbl_completion');
        if($q == COLLEGE_COUNT)
        {
            // then change the classallocation status in tbl_systemvalue
            $r = $this->db->get('tbl_systemvalues')->row_array();
            $d['classallocationstatus'] = $r['classallocationstatus'] + 1;
            $this->db->update('tbl_systemvalues', $d);
        }
    }

    function chkDayPeriod()
    {
        $owner = $this->api->getUserCollege();
        $this->load->model(array('edp/edp_classallocation'));

        $su = $this->edp_classallocation->getAlloc($systemVal['nextacademicterm'], $owner);
    }

    function save_instructor()
    {
        $data['instructor'] = $this->input->post('instructor');
        if($data['instructor'] != 0)
        {
            $cl_id      = $this->input->post('cl_id');

            $this->db->where('id', $cl_id);
            $this->db->update('tbl_classallocation', $data);
        }
    }

    function sorts()
    {
        $this->load->model(array(
            'edp/edp_classallocation',
            'dean/subject'
        ));

        $owner 		= $this->api->getUserCollege();
        $this->db->where('id', $owner);
        $col = $this->db->get('tbl_college')->row_array();
        $user 		= $this->session->userdata('uid');
        $systemVal 	= $this->api->systemValue();

        // $data['cl'] 		= $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a,tbl_subject b
        //     WHERE a.subject = b.id
        //     AND b.owner = $owner
        //     AND academicterm = {$systemVal['currentacademicterm']}")->result_array();

        $data['instruc']    = $this->db->get_where('tbl_academic', array('college' => $owner))->result_array();
        $data['cl']         = $this->db->query("SELECT b.code as code,b.descriptivetitle as title,a.id as cl_id,coursemajor,instructor FROM tbl_classallocation a, tbl_subject b WHERE a.subject = b.id AND academicterm = {$systemVal['currentacademicterm']}")->result_array();
        $input              = $this->input->post('sort');

        if($input == 0)
        {
            $this->load->view('dean/ajax/assigned_ins', $data);
            $this->load->view('dean/ajax/not_ass_ins', $data);
        }
        elseif($input == 1)
        {
            $this->load->view('dean/ajax/assigned_ins', $data);
        }
        elseif($input == 2)
        {
            $this->load->view('dean/ajax/not_ass_ins', $data);
        }
    }

    // function to fill up classallocation
    function fill_classallocation()
    {
        $room = $this->db->get('tbl_classroom')->result_array();

        $t = $this->db->get('tbl_time')->result_array();
        //$c = $this->db->get('tbl_classallocation')->result_array();

        $c = $this->db->query("SELECT * FROM tbl_classallocation WHERE academicterm = 50")->result_array();


        $d = $this->db->get('tbl_day')->result_array();

        $univ = 0;
        $univ_day = 0;
        $r = 0;
        $ctr2 = 0;
        foreach ($c as $cl)
        {
            $this->db->query("DELETE FROM tbl_dayperiod WHERE classallocation = {$cl['id']}");

            $this->db->where('id', $cl['subject']);

            $s          = $this->db->get('tbl_subject')->row_array();
            $units      = $s['units'];
            $units_heap = $units;
            $ctr        = 0;
            $ctr1       = 0;

            if($univ == 28)
            {
                $univ       = 0;
                $univ_day   = $univ_day + 1;
                //$ctr2++;
            }

            $o = $univ + $units_heap;

            if($o >= 28)
            {
                $univ = 0;
                $univ_day++;
                if($univ_day >= 3)
                {
                    $univ_day = 0;
                }
                if($r >= 69)
                {
                    $r = 0;
                }
                $o = $univ + $units_heap;
            }

            $start = $t[$univ]['id'];

            $end = $t[$o]['id'];

            $univ = $univ + $units_heap;

            if($univ_day == 0)
            {
                $data['classallocation'] = $cl['id'];
                $data['from_time']  = $start;
                $data['to_time']    = $end;
                $data['day']        = 1;
                $data['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data);

                $data1['classallocation'] = $cl['id'];
                $data1['from_time']  = $start;
                $data1['to_time']    = $end;
                $data1['day']        = 3;
                $data1['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data1);
            }
            elseif($univ_day == 1)
            {
                $data['classallocation'] = $cl['id'];
                $data['from_time']  = $start;
                $data['to_time']    = $end;
                $data['day']        = 2;
                $data['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data);

                $data1['classallocation'] = $cl['id'];
                $data1['from_time']  = $start;
                $data1['to_time']    = $end;
                $data1['day']        = 4;
                $data1['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data1);
            }
            elseif($univ_day == 2)
            {
                $data['classallocation'] = $cl['id'];
                $data['from_time']  = $start;
                $data['to_time']    = $end;
                $data['day']        = 5;
                $data['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data);

                $data1['classallocation'] = $cl['id'];
                $data1['from_time']  = $start;
                $data1['to_time']    = $end;
                $data1['day']        = 6;
                $data1['classroom']  = $room[$r]['id'];
                $this->db->insert('tbl_dayperiod', $data1);
                $r++;
                if($r >= 69)
                {
                    $r = 0;
                }
            }

            if($r >= 69)
            {
                $r = 0;
            }
            if($univ_day >= 3)
            {
                $univ_day = 0;
            }
        }
    }

    function group(){

        $subcode = $this->api->get_subcode();

        $checked = $this->input->post('checked');

        if ($checked) {
            $this->load->model('dean/group');
            $group = $this->group->get_group_no();
            $group = $group['gr'] + 1;
            $gr = array('grouping'=> $group);

            foreach ($checked as $key => $value) {
                $rr = explode('|', $checked[$key]);
                $this->group->group_sub($rr[0], $rr[1], $rr[2], $gr);
            }

            $this->session->set_flashdata('message',
            '<div class="alert alert-success">
                <strong>Subjects grouped!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }
        else{
            $this->session->set_flashdata('message',
            '<div class="alert alert-danger">
                <strong>Please select subjects to group!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        }
        redirect(base_url('enrolment_grouping'));
    }

    function ungroup($gr){
        $this->load->model('dean/group');
        $data['grouping'] = 0;
        $this->group->ungroup($gr, $data);

        $this->session->set_flashdata('message',
        '<div class="alert alert-success">
            <strong>Subject ungrouped!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        redirect(base_url('enrolment_grouping'));
    }

    // --------------------------------------------------------------------------------------

    function create_reg()
    {
        $leg = $this->db->query("SELECT * FROM tbl_enrolment_legacy
                        GROUP BY IDNO , COURSE ORDER BY SCH_YR,SEMESTER")->result_array();

        $template = '';
        $template .= '<table>
                        <tr>
                            <td>Party ID</td>
                            <td>Academicterm</td>
                            <td>Date</td>
                            <td>COURSE</td>
                            <td>SCH_YR</td>
                            <td>Semester</td>
                            <td>Curriculum</td>
                            <td>Coursemajor</td>
                            <td style="text-align:center">NAME</td>
                        </tr>
        ';
        foreach($leg as $legacy)
        {
            $semester   = ($legacy['SEMESTER'] == 'S') ? '3' : $legacy['SEMESTER'];
            $year       = explode('-', $legacy['SCH_YR']);
            $s          = explode('/', $legacy['DATE_ENROL']);
            $s1         = explode('-', $legacy['IDNO']);
            $d          = '';
            $p          = $this->db->get_where('tbl_party', array('legacyid' => $legacy['IDNO']))->row_array();
            $systart = '';
            $syend = '';
            if($s1[0] == $s[2])
            {
                $d          = $s[2].'-'.$s[1].'-'.$s[0];
                $systart = $year[0];
                $syend = $year[1];
                //$sy         = $this->db->get_where('tbl_academicterm', array('systart' => $year[0], 'syend' => $year[1], 'term' => $semester))->row_array();
            }
            else
            {

                $this->db->where('student', $p['id']);
                $i = $this->db->count_all_results('tbl_registration');
                if($i > 0)
                {
                    $d          = $s[2].'-'.$s[1].'-'.$s[0];
                    $systart = $s[2];
                    $syend = $systart + 1;
                }
                else {
                    if($semester == 1){
                        $d = $s1[0].'-06-01';
                    }
                    elseif($semester == 2){
                        $d = $s1[0].'-11-01';
                    }

                    else{
                        $d = $s1[0].'-04-01';
                    }
                    $systart = $s1[0];
                    $syend = $systart + 1;
                }
            }

            $sy    = $this->db->get_where('tbl_academicterm', array('systart' => $systart, 'syend' => $syend, 'term' => $semester))->row_array();

            if($legacy['COURSE'] == 'BSOA' OR $legacy['COURSE'] == 'BSC')
            {
                $coursemajor = 7;
            }
            elseif ($legacy['COURSE'] == 'BEED') {
                $coursemajor = 18;
            }
            elseif ($legacy['COURSE'] == 'BSA') {
                $coursemajor = 21;
            }
            elseif ($legacy['COURSE'] == 'BSBA') {
                // for temporary
                $coursemajor = 25;
            }
            elseif ($legacy['COURSE'] == 'BSCRIM') {
                $coursemajor = 5;
            }
            elseif ($legacy['COURSE'] == 'LLB')
            {
                $coursemajor = 19;
            }
            elseif($legacy['COURSE'] == 'AB')
            {
                $coursemajor = 16;
            }

            $acamd  = $this->db->query("SELECT * FROM `tbl_academicterm` WHERE systart <= $systart ORDER BY systart DESC,term")->result_array();

            $cur1 = 0;
            if($legacy['COURSE'] == 'BSED')
            {
                $coursemajor = 17;
                $cur1 = 55;
            }
            else {
                foreach($acamd as $acams)
                {
                    $c = $this->db->query("SELECT id FROM tbl_curriculum WHERE
                        coursemajor = $coursemajor AND academicterm = {$acams['id']}");
                    if($c->num_rows() > 0)
                    {
                        $cur    = $c->row_array();
                        $cur1   = $cur['id'];
                        break;
                    }
                }
            }

            if($cur1 == 0)
            {
                if($coursemajor == 21)
                {
                    $cur1 = 0;
                }
                else {
                    $cur = $this->db->query("SELECT * FROM tbl_curriculum a,tbl_academicterm b WHERE coursemajor = $coursemajor and b.id = a.academicterm ORDER BY b.systart ASC LIMIT 1 ")->row_array();
                    $cur1 = $cur['id'];
                }

            }

            $template .= '<tr>
                            <td style="width:100px;">'.$p['id'].'</td>
                            <td style="width:100px;">'.$sy['id'].'</td>
                            <td style="width:100px;">'.$d.'</td>
                            <td style="width:100px;">'.$legacy['COURSE'].'</td>
                            <td style="width:100px;">'.$legacy['SCH_YR'].'</td>
                            <td style="width:100px;">'.$legacy['SEMESTER'].'</td>
                            <td style="width:100px;">'.$cur1.'</td>
                            <td style="width:100px;">'.$coursemajor.'</td>
                            <td style="width:300px;text-align:justify">'.$legacy['LNAME'].' , '.$legacy['FNAME'].'</td>
                        </tr>';
            $data = array('coursemajor' => $coursemajor, 'curriculum' => $cur1, 'date' => $d, 'student' => $p['id'], 'academicterm' => $sy['id'], 'status' => 'A');
            $this->db->insert('tbl_registration', $data);
        }
        $template .= '</table>';

        echo $template;
    }
}

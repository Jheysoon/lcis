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

    function edit_subject($sid,$param = '')
    {
        if(!empty($sid) AND is_numeric($sid))
        {
            $this->load->model(array(
                'dean/subject',
                'dean/group',
                'dean/college'
            ));

            $this->api->userMenu();

            $sub = $this->subject->find($sid);
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

            $this->load->view('dean/subjects',$data);
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
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/subject',
            'dean/group','dean/college'
        ));

        $this->load->library('form_validation');
        $this->load->helper('form');

        // rules
        $this->form_validation->set_rules('code','Subject Code','trim|required|is_unique[tbl_subject.code]',
            array('is_unique'=>'Subject Code already exists'));
        $this->form_validation->set_rules('title','Descriptive Title','trim|required');
        $this->form_validation->set_rules('units','Subject Units','trim|required|integer');
        $this->form_validation->set_rules('hours','Subject Hours','trim|required|integer');

        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/header_title2');
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
        if(!empty($id) AND is_numeric($id))
        {
            $college    = $this->api->getUserCollege();
            $s          = $this->subject->find($id);
            if($college == 0 OR $s['owner'] == 0)
            {
               redirect(base_url('edit_subject/'.$id.'/view'));
            }
            elseif($s['owner'] == $college)
            {
                redirect(base_url('edit_subject/'.$id));
            }
        }
        else
            show_error('Did you type the url by yourself ?');
    }

    function searchStud()
    {
        $this->load->model('dean/student');

        $id  = $this->input->post('search');
        $col = $this->input->post('col');
        $id1 = $this->student->existsID($id, $col);

        if ($id1 > 0)
        {
            redirect('/dean_evaluation/' . $id);
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
        //$this->load->model('dean/out_section');
        $id                 = $this->input->post('out_section_id');
        $data['section']    = $this->input->post('sections');

        $this->db->where('id',$id);
        $this->db->update('out_section',$data);
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
            $this->db->insert('out_section',$data);
        else
        {
            $this->db->where('id',$id);
            $this->db->update('out_section',$data);
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

        // Putting all selected schedules into schedule array.

        while ( $ctr != 0) {
            if ($this->input->post('rad-'.$ctr) !== NULL) {
                $names['var'.$ctr2] = $this->input->post('rad-'.$ctr);
                $un = $this->student->getUnits($this->input->post('rad-'.$ctr));
                extract($un);
                $unit = $unit + $units;
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

                // Check if there is any duplicate subject in additional subject table.
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


            // if($this->input->post('counter') < $unit){
            //     $this->message1 = '<div class="alert alert-danger alert-dismissible" role="alert">
            //       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            //       <strong>No. of units exceeded!</strong><br/>
            //       Total units taken : '.$unit.'
            //     </div>';
            //     return false;
            // }else

            // If there are no conflicts proceed to saving.
            if ($message == '') {

                $student = $this->input->post('student');
                $coursemajor = $this->input->post('coursemajor');
                $registration = $this->input->post('registration');
                $academicterm = $this->input->post('academicterm');

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
                    $this->student->updateEnrolment($enid, $unit);
                }
                else{
                    $status = 'R';
                    $enid = $this->student->addEnrolment($this->input->post('count'), $student, $coursemajor, $registration, $academicterm, $unit, $status);
                }

                // Adding new records to student grade
                foreach ($names as $key => $value) {
                    $res = $this->student->getReserved($value);
                    $res = $res['reserved'] + 1;
                    $this->student->addInitialGrade($value, $enid);
                    $this->student->updateReserved($value, $res);
                }

                // Call billing method.
                // $this->calculatebill($enid);

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
            $this->load->view('dean/add_non_subject',$data);
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
                $this->load->view('dean/add_non_subject',$data);
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
                $this->db->insert('out_section',$db);
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

        if($this->input->post('days_count'))
        {
            $ret = $this->ass_subj();
            if($ret == TRUE)
            {
                redirect('/menu/dean-add_day_period');
            }
        }

        if($this->input->post('days_count') == NULL)
        {
            $data['num'] = 0;
        }
        else
        {
            $data['num'] = $this->input->post('days_count') - 1;
        }

        $data['error']  = $this->error;
        $data['cid']    = $cid;
        $this->load->view('dean/assigned_subj',$data);
        $this->load->view('templates/footer');
    }

    function ajax_day_period()
    {
        $cid = $this->input->post('cid');
        $template = '';
        $template .= '<tr>
                <th>Day</th>
                <th>Start Period</th>
                <th>End Period</th>
            </tr>';
        for($i=1;$i <= $cid; $i++)
        {
            $template .= '<tr>
                <td>
                    <select class="form-control" name="day[]">';
                        $d = $this->db->get('tbl_day')->result_array();
                        foreach($d as $day){
                            $template .='<option value="'.$day['id'].'">'.$day['day'].'</option>';
                        }
                    $template .= '</select>
                </td>
                <td>
                    <select class="form-control" name="start_time[]">';
                        $t = $this->db->get('tbl_time')->result_array();
                        foreach($t as $time){
                        $template .= '<option value="'.$time['id'] .'">'.$time['time'].'</option>';
                      }
                     $template .= '</select>
                </td>
                <td>
                    <select class="form-control" name="end_time[]">';
                        foreach($t as $time)
                        {
                            if($time['id'] != 1){

                            $template .= '<option value="'.$time['id'].'">'.$time['time'].'</option>';
                            }
                        }
                    $template .='</select>
                </td>
            </tr>';
        }
        echo $template;
    }


    // function in adding day period
    function ass_subj()
    {
        $day        = $this->input->post('day');
        $start_time = $this->input->post('start_time');
        $end_time   = $this->input->post('end_time');
        $cid        = $this->input->post('class_id');
        $url        = $this->input->post('url');

        // count the number of days
        $index = count($day);

        $this->db->where('classallocation',$cid);
        $dd = $this->db->count_all_results('tbl_dayperiod');
        if($dd > 0)
        {
            $this->db->query("DELETE FROM tbl_dayperiod WHERE classallocation = $cid");
        }

        foreach($day as $key => $value)
        {
            if($index < 3 AND $index > 1)
            {
                //check if the days are just the same
                if($day[0] == $day[1])
                {
                    $this->error = '<div class="alert alert-danger">Subject days must be unique</div>';
                    if($this->input->post('edp'))
                    {
                        $this->session->set_flashdata('message', $this->error);
                        redirect('/assign_room/'.$cid);
                    }
                    return FALSE;
                }
            }
            elseif($index < 4 AND $index > 1)
            {
                //check if the days are just the same
                if($day[0] == $day[1] OR $day[1] == $day[2] OR $day[0] == $day[2])
                {
                    $this->error = '<div class="alert alert-danger">Subject days must be unique</div>';
                    if($this->input->post('edp'))
                    {
                        $this->session->set_flashdata('message', $this->error);
                        redirect('/assign_room/'.$cid);
                    }
                    return FALSE;
                }
            }

            // check if the user select the noon break time period
            if($start_time[$key] != 11 AND $end_time[$key] != 12)
            {
                //end time period must be greater than the start time period
                if($end_time[$key] > $start_time[$key])
                {
                    $data['classallocation']    = $cid;
                    $data['day']                = $value;
                    $data['from_time']          = $start_time[$key];
                    $data['to_time']            = $end_time[$key];
                    $this->db->insert('tbl_dayperiod',$data);
                }
                else{
                    $this->error = '<div class="alert alert-danger">Time End Period must be greater than Start Period</div>';
                    if($this->input->post('edp'))
                    {
                        $this->session->set_flashdata('message', $this->error);
                        redirect('/assign_room/'.$cid);
                    }
                    return FALSE;
                }
            }
            else{
                $this->error = '<div class="alert alert-danger">Time Period must not 12:00 am - 1:00 pm</div>';
                if($this->input->post('edp'))
                {
                    $this->session->set_flashdata('message', $this->error);
                    redirect('/assign_room/'.$cid);
                }
                return FALSE;
            }
        }
        $this->api->set_session_message('success','Successfully added');
        if($this->input->post('edp'))
        {
            redirect('/assign_room/'.$cid);
        }
        return TRUE;
    }

//------------------------------------------------------------------------
// Searching function for adding subject in evaluation method
// (called through ajax @ views/dean/ajax/evaluation.js).
// A table of searched subjects is displayed after execution.
//------------------------------------------------------------------------

    function ajaxEvaluation(){
        $this->load->model('edp/edp_classallocation');
        $this->load->model('dean/student');
        $this->load->helper('form');

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
        $this->db->where('id',$id);
        $this->db->delete('tbl_classallocation');
        $this->db->where('classallocation',$id);
        $this->db->delete('tbl_dayperiod');
        redirect('/menu/dean-add_day_period');
    }

     // function to create classallocation
    function add_classalloc()
    {
        $data['subject']        = $this->input->post('subj');
        $data['coursemajor']    = $this->input->post('course_major');
        $this->db->insert('tbl_classallocation',$data);
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
                $this->db->insert('tbl_completion',$data);
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
            // decrement the classallocation status in tbl_systemvalue
            // if
            $this->db->where('id',$id);
            $this->db->update('tbl_completion',$data);
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

        $su = $this->edp_classallocation->getAlloc($systemVal['nextacademicterm'],$owner);
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
}

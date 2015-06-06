<?php
/*
| -------------------------------------
| @file  : Dean.php
| @date  : 3/26/2015
| @author:
| -------------------------------------
*/

class Dean extends CI_Controller
{

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
        $this->load->model(array(
            'home/option',
            'home/option_header',
            'home/useroption',
            'dean/subject',
            'dean/group',
            'dean/college'
        ));
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');

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

        $this->form_validation->set_rules('title','Descriptive Title','trim|required');
        $this->form_validation->set_rules('units','Subject Units','trim|required|integer');
        $this->form_validation->set_rules('hours','Subject Hours','trim|required|integer');

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
        $sid = urldecode($sid);
        $this->load->model(array(
            'dean/subject',
            'dean/common_dean'
        ));

        $college = $this->api->getUserCollege();
        
        $s = $this->subject->search($sid,$college);
        $data = array();

        foreach ($s as $r)
        {
            $data[] = array('value' => $r['code'], 'name' => $r['descriptivetitle']);
        }
        echo json_encode($data);
    }
    function search()
    {
        $code = $this->input->post('search');
        $url = $this->input->post('url');
        $this->load->model('dean/subject');
        $q = $this->subject->whereCode($code);
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
        $sid = $this->input->post('value');
        $this->load->model('dean/subject');
        $data['college'] = $sid;
        $this->load->view('dean/ajax/tbl_subject',$data);
    }

    function evaluation($id){
        $this->head();
        $data['id'] = $id;
        $this->load->view('dean/dean_preEnroll', $data);
        $this->load->view('templates/footer');
    }

    function ident_subj($id)
    {
        $college = $this->api->getUserCollege();
        
        $s = $this->subject->find($id);
        if($college == 0 OR $s['owner'] == 0)
        {
           redirect(base_url('edit_subject/'.$id.'/view'));
        }
        elseif($s['owner'] == $college)
        {
            redirect(base_url('edit_subject/'.$id));
        }
    }

    function searchStud()
    {
        $this->load->model('dean/student');
        $id = $this->input->post('search');
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
        $college = $this->api->getUserCollege();        

        $s = $this->student->getStudent($sid,$college);
        $data = array();

        foreach ($s as $r)
        {
            $data[] = array('value' => $r['legacyid'], 'name' => $r['lastname'].' '.$r['firstname']);
        }
        echo json_encode($data);
    }
    function calculatebill($enid){
        $this->load->model('dean/student');
        $this->student->getCalculation($enid);
    }
    function addClassAlloc()
    {
        $this->load->model('dean/out_section');

        $data['coursemajor']    = $this->input->post('course_major');
        $nxt                    = $this->api->systemValue();
        $data['academicterm']   = $nxt['nextacademicterm'];
        $data['subject']        = $this->input->post('subject');
        $data['section']        = $this->input->post('sections');
        $data['yearlevel']      = $this->input->post('yearlevel');

        $is_ajax = $this->input->post('is_ajax');
        if($is_ajax != 0)
        {
            $data['studentcount'] = $this->input->post('studentcount');
        }

        //$c = $this->out_section->whereCount($data['academicterm'],$data['coursemajor'],$data['subject'],$data['yearlevel']);
        $id = $this->input->post('out_section_id');
        if($id == NULL)
        {
            $this->db->insert('out_section',$data);
        }
        else
        {
            $this->db->where('id',$id);
            $this->db->update('out_section',$data);
        }

        if($is_ajax == 0)
        {
            redirect(base_url('non_exist'));
        }
    }


    function saveEvaluation(){
        $this->load->model('dean/student');
        $ctr = $this->input->post('count');
        $ctr2 = 1;

        while ( $ctr != 0) {
            if ($this->input->post('rad-'.$ctr) !== NULL) {
                $names['var'.$ctr2] = $this->input->post('rad-'.$ctr);
                $ctr2++;
            }
            $ctr--;
        }
        extract($names);
        $ctr2 = $ctr2-1;
        $i = $ctr2;
        while ($ctr2 != 0) {
            $ii = $i;
            $dp = $this->student->getSpecificAllocation(${'var'.$ctr2});
            $sched = $this->student->getDP($dp['dayperiod']);
            extract($sched);
            $date1 = new DateTime($from);
            $t1 = $date1->format('h:i');
            $date2 = new DateTime($to);
            $t2 = $date2->format('h:i');
            // echo ${'var'.$ctr2}.", ".$dp['dayperiod'].", ".$shortname.", ".$t1.", ".$t2."<br/>";
            if ($ii != $ctr2) {
                while($ii != 0){
                    if ($ii != $ctr2) {
                        $dp2 = $this->student->getSpecificAllocation(${'var'.$ii});
                        $sched2 = $this->student->getDP($dp2['dayperiod']);
                        extract($sched2);
                        $date1 = new DateTime($from);
                        $t3 = $date1->format('h:i');
                        $date2 = new DateTime($to);
                        $t4 = $date2->format('h:i');
                        // call method fot checking conflicts
                        $res = $this->api->intersectCheck($t1, $t3, $t2, $t4);
                        if ($res) {
                            $conf = '';
                        }
                        else{
                            $conf = 'conflict';
                        }
                        echo $t1."-".$t2."&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;". $t3."-".$t4." - ".$conf."<br/>";
                    }
                    $ii--;
                }
            }
            $ctr2--;   
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
            $q          = $this->classallocation->chkClassAlloc($subject,$systemVal['nextacademicterm'],$cmajor);
            if($q > 0)
            {
                $data['error'] = '<div class="alert alert-danger">You have already assigned this subject with this course</div>';
                $this->load->view('dean/add_non_subject',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->addClassAlloc();
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
        $data['cid'] = $cid;
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

    function ass_subj()
    {
        $day        = $this->input->post('day');
        $start_time = $this->input->post('start_time');
        $end_time   = $this->input->post('end_time');
        $cid        = $this->input->post('class_id');
        $url        = $this->input->post('url');

        $index = count($day);

        foreach($day as $key => $value)
        {
            if($index < 3)
            {
                if($day[0] == $day[1]){
                    $this->session->set_flashdata('message','<div class="alert alert-danger">Subject days must be unique</div>');
                    redirect($url);
                }
            }
            elseif($index < 4)
            {
                if($day[0] == $day[1] OR $day[1] == $day[2] OR $day[0] == $day[2])
                {
                    $this->session->set_flashdata('message','<div class="alert alert-danger">Subject days must be unique</div>');
                    redirect($url);
                }
            }

            $this->db->where('classallocation',$cid);
            $dd = $this->db->count_all_results('tbl_dayperiod');
            if($dd > 0)
            {
                $this->db->query("DELETE FROM tbl_dayperiod WHERE classallocation = $cid");
            }
            $data['classallocation']    = $cid;
            $data['day']                = $value;
            $data['from_time']          = $start_time[$key];
            $data['to_time']            = $end_time[$key];

            $this->db->insert('tbl_dayperiod',$data);
        }
        $this->session->set_flashdata('message','<div class="alert alert-success">Successfully added</div>');
        redirect('/menu/dean-add_day_period');
    }
}

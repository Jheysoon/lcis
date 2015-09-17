<?php
/*
| -------------------------------------
| @file  : Student.php
| @date  : 3/26/2015
| @author:
| -------------------------------------
*/

class Student extends CI_Controller
{

    function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }

    function editSelfEvaluation()
    {
        $this->head();
        $this->load->view('student/edit_selfevaluation');
        $this->load->view('templates/footer');
    }
    function viewSelfAssessment()
    {
        $this->head();
        $this->load->view('student/view_selfassesment');
        $this->load->view('templates/footer');
    }
    function viewStudyLoad()
    {
        $this->head();
        $this->load->view('student/view_studyload');
        $this->load->view('templates/footer');
    }
    function viewGrades()
    {
        $this->head();
        $this->load->view('student/view_grades');
        $this->load->view('templates/footer');
    }
    function viewHoliday()
    {
        $this->head();
        $this->load->view('student/view_holiday');
        $this->load->view('templates/footer');
    }
    function viewCollegiateCalendar()
    {
        $this->head();
        $this->load->view('student/view_collegiatecalendar');
        $this->load->view('templates/footer');
    }
    function billcalculation($enid)
    {
        $this->load->model('dean/student');

        //Function to get the coursemajor and the party id of the student
        $enr_info = $this->student->enr_info($enid);
        $coursemajor = $enr_info['coursemajor'];
        $partyid = $enr_info['partyid'];
        // ---------------------------- //


        $check_billclass = $this->student->check_billclass($enid);
        if ($check_billclass > 0) {
          //Get Bill Id
            $billid = $this->student->get_billid($enid);

        }
        else
        {
          //Function Insert Into Tbl_bill firstname
          $data_bill = array('requestedby' => $partyid,
                             'datecreated' => Date('Y-m-d'),
                             'enteredby' => $this->session->userdata('uid'),
                             'status' => 'R',
                             'type' => '1');
          $billid = $this->student->insert_bill($data_bill);
          // ------------------------------ //
        }


        //Function to get all fees based on coursemajor of the student


        $fees = $this->student->get_fees($coursemajor);
        foreach ($fees as $key => $value)
        {
            extract($values);
            if ($feetype == 1)
            {
              //Get Total Units. And Calculate for the Matriculation
              $units = $this->student->get_sub_unit($enid);
              $the_rate = $units * $rate;
            }
            elseif ($feetype == 2)
            {
              //Get Total Units. And Calculate for the Tution
              $units = $this->student->get_sub_unit($enid);
              $the_rate = $units * $rate;
            }
            elseif ($feetype == 18)
            {
              //Get No. of Subject and Calculate by no. of subject * rate * per exam
              $nosubject = $this->student->get_total_subj($enid);
              $the_rate = $nosubject * $rate * 4;
            }
            elseif ($feetype == 20)
            {
              //Get Chem Lab.
              $chem_lab = $this->student->get_chem($enid);
              if ($chem_lab > 0)
              {
                $the_rate = $rate;
              }
              else
              {
                $the_rate = 0;
              }
            }
            elseif ($feetype == 17)
            {
              //Get No. of computer subject and calculate computer subject by no. of computersubject * rate;
              $get_comp = $this->student->get_comp($enid);
              if ($get_comp > 0)
              {
                $the_rate = $get_comp * $rate;
              }
              else
              {
                $the_rate = 0;
              }
            }
            elseif ($feetype == 15)
            {
              //NSTP.
              $get_nstp = $this->student->get_nstp($enid);
              if ($get_nstp > 0)
              {
                $the_rate = $get_nstp * $rate;
              }
              else
              {
                $the_rate = 0;
              }
            }
            else
            {
                $the_rate = $rate;
            }

            if ($the_rate > 0)
            {
              $data = array('bill' => $billid, 'fee' => $fid, 'amount' => $the_rate);
              $this->student->insertbilldetail($data);
            }

        }
    }
}

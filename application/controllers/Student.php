<?php
/*
| -------------------------------------
| @file  : Student.php
| @date  : 3/26/2015
| @author: Jayson Martinez
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
}
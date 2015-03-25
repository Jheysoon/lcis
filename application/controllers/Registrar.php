<?php
/*
| -------------------------------------
| @file  : Registrar.php
| @date  : 3/24/2015
| @author: Jayson Martinez
| -------------------------------------
*/

class Registrar extends CI_Controller {

    private function head()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/header_title2');
    }
    function addNewStudent()
    {
        $this->head();
        $this->load->view('registrar/newstudent_registration');
        $this->load->view('templates/footer');
    }
    function addTransferee()
    {
        $this->head();
        $this->load->view('registrar/transferee_registration');
        $this->load->view('templates/footer');
    }
    function addCrossEnrolee()
    {
        $this->head();
        $this->load->view('registrar/crossenrollee_registration');
        $this->load->view('templates/footer');
    }
    function updateOldStudents()
    {
        $this->head();
        $this->load->view('registrar/student_list');
        $this->load->view('templates/footer');
    }
    function permanentRecord()
    {
        $this->head();
        $this->load->view('registrar/student_list');
        $this->load->view('templates/footer');
    }
    function listCHED()
    {
        $this->head();
        $this->load->view('registrar/ched_list');
        $this->load->view('templates/footer');
    }
    function listRequestedServices()
    {
        $this->head();
        $this->load->view('registrar/requestedservices_list');
        $this->load->view('templates/footer');
    }
    function updateSystemValue()
    {
        $this->head();
        $this->load->view('registrar/systemvalue_list');
        $this->load->view('templates/footer');
    }
    function listSchool()
    {
        $this->head();
        $this->load->view('registrar/school_list');
        $this->load->view('templates/footer');
    }
    function listCollege()
    {
        $this->head();
        $this->load->view('registrar/college_list');
        $this->load->view('templates/footer');
    }
    function listCourse()
    {
        $this->head();
        $this->load->view('registrar/course_list');
        $this->load->view('templates/footer');
    }
    function listScholasticPeriod()
    {
        $this->head();
        $this->load->view('registrar/scholasticperiod_list');
        $this->load->view('templates/footer');
    }
    function listCollegiateCalendar()
    {
        $this->head();
        $this->load->view('registrar/collegiatecalendar_list');
        $this->load->view('templates/footer');
    }
    function listHoliday()
    {
        $this->head();
        $this->load->view('registrar/holiday_list');
        $this->load->view('templates/footer');
    }
    function listNonCreditedSubject()
    {
        $this->head();
        $this->load->view('registrar/noncreditedsubject_list');
        $this->load->view('templates/footer');
    }
    function listSubjectGrouping()
    {
        $this->head();
        $this->load->view('registrar/subjectgrouping_list');
        $this->load->view('templates/footer');
    }
    function listServices()
    {
        $this->head();
        $this->load->view('registrar/services_list');
        $this->load->view('templates/footer');
    }
}
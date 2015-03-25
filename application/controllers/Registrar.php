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
    }
    function listScholasticPeriod()
    {
        $this->head();
    }
    function listCollegiateCalendar()
    {
        $this->head();
    }
    function listHoliday()
    {
        $this->head();
    }
    function listNonCreditedSubject()
    {
        $this->head();
    }
    function listSubjectGrouping()
    {
        $this->head();
    }
    function listServices()
    {
        $this->head();
    }
    function account()
    {
        $this->head();
    }
}
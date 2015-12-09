<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*-----------------------------------------------------------
 | CI Routes
 |-----------------------------------------------------------
 */
    //  The default controller class is Main
    $route['default_controller'] = 'main';
    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;

/*-----------------------------------------------------------
 | Developers Routes
 | @author: Jayson Martinez
 |-----------------------------------------------------------
 */
    $route['home']          = 'main/home';
    $route['logout']        = 'main/logout';
    $route['account']       = 'main/account';
    $route['menu/(:any)']   = 'main/menu/$1';
    $route['menu/(:any)/(:any)']   = 'main/menu/$1/$2';

    // Registrar & Dean Shared Routes
    $route['listCollege']                   = 'registrar/listCollege';
    $route['listCourse']                    = 'registrar/listCourse';

    // Registrar Routes
    $route['rgstr_addNewStudent']           = 'registrar/addNewStudent';
    $route['rgstr_addTransferee']           = 'registrar/addTransferee';
    $route['rgstr_addCrossEnrolee']         = 'registrar/addCrossEnrolee';
    $route['rgstr_updateOldStudents']       = 'registrar/updateOldStudents';
    $route['rgstr_permanentRecord']         = 'registrar/permanentRecord';
    $route['rgstr_listCHED']                = 'registrar/listCHED';
    $route['rgstr_listRequestedServices']   = 'registrar/listRequestedServices';
    $route['rgstr_updateSystemValue']       = 'registrar/updateSystemValue';
    $route['rgstr_listSchool']              = 'registrar/listSchool';
    $route['rgstr_listScholasticPeriod']    = 'registrar/listScholasticPeriod';
    $route['rgstr_listCollegiateCalendar']  = 'registrar/listCollegiateCalendar';
    $route['rgstr_listHoliday']             = 'registrar/listHoliday';
    $route['rgstr_listNonCreditedSubject']  = 'registrar/listNonCreditedSubject';
    $route['rgstr_listSubjectGrouping']     = 'registrar/listSubjectGrouping';
    $route['rgstr_listServices']            = 'registrar/listServices';
    $route['rgstr_oldstudent']              = 'registrar/oldstudent_reg';

    $route['registration']                  = 'registrar/registration';
    $route['find_stu']                      = 'registrar/find_stu';
    $route['shiftee']                       = 'registrar/shiftee';
    $route['update_registration/(:num)']    = 'registrar/update_reg/$1';
    $route['form_update_reg']               = 'registrar/form_update_reg';
    $route['pending_reg/(:num)']            = 'registrar/pending_reg/$1';
    $route['find_shift']                    = 'registrar/find_shift';
    $route['shiftee/(:any)']                = 'registrar/shiftee/$1';
    $route['take_photo/(:num)']             = 'registrar/take_photo/$1';

    // Audit Routes
    $route['adt_viewtStudentBilling']       = 'audit/viewtStudentBilling';
    $route['adt_listAllAccount']            = 'audit/listAllAccount';
    $route['adt_viewCashierAccountMovement']= 'audit/viewCashierAccountMovement';

    // Cashier Routes
    $route['cshr_OpenCashWindow']           = 'cashier/OpenCashWindow';
    $route['cshr_addEnrolPayment']          = 'cashier/addEnrolPayment';
    $route['cshr_addExamPayment']           = 'cashier/addExamPayment';
    $route['cshr_listServiceRequested']     = 'cashier/listServiceRequested';
    $route['cshr_viewCashierMovement']      = 'cashier/viewCashierMovement';
    $route['cshr_addCashOut']               = 'cashier/addCashOut';

    // Dean Routes
    $route['dn_listSubjectSectioning']      = 'dean/listSubjectSectioning';
    $route['dn_ClassAllocation']            = 'dean/ClassAllocation';
    $route['dn_adddelete_Section']          = 'dean/adddelete_Section';
    $route['dn_PreEnrolment']               = 'dean/PreEnrolment';
    $route['dn_updateStudentLoad']          = 'dean/updateStudentLoad';
    $route['dn_listGradingList']            = 'dean/listGradingList';
    $route['dn_listINCsubject']             = 'dean/listINCsubject';
    $route['dn_listAttest']                 = 'dean/listAttest';
    $route['dn_listCompletedINC']           = 'dean/listCompletedINC';
    $route['dn_listCourse']                 = 'dean/listCourse';
    $route['dn_listSubject']                = 'dean/listSubject';
    $route['dn_listCurriculum']             = 'dean/listCurriculum';


    $route['non_exist']                     = 'dean/addSubjAlloc';
    $route['add_day_period/(:num)']         = 'dean/add_day_period/$1';
    $route['delete_classalloc/(:num)']      = 'dean/delete_classalloc/$1';

    // EDP Routes
    $route['edp_ListUsers']                 = 'edp/ListUsers';
    $route['edp_ClassroomList']             = 'edp/ClassroomList';
    $route['edp_CalculateSubjectSection']   = 'edp/CalculateSubjectSection';
    $route['edp_ClassAllocation']           = 'edp/ClassAllocation';

    $route['add_room']                      = 'edp/add_room';
    $route['add_sched/(:num)']              = 'edp/add_sched/$1';
    $route['view_sched/(:num)']             = 'edp/view_sched/$1';
    $route['assign_room/(:num)']            = 'edp/assign_room/$1';
    $route['preview/(:num)']                = 'edp/preview/$1';
    $route['edp_override/(:num)']           = 'dean/edp_override/$1';

    // Student Routes
    $route['stdnt_editSelfEvaluation']      = 'student/editSelfEvaluation';
    $route['stdnt_viewSelfAssessment']      = 'student/viewSelfAssessment';
    $route['stdnt_viewStudyLoad']           = 'student/viewStudyLoad';
    $route['stdnt_viewGrades']              = 'student/viewGrades';
    $route['stdnt_viewHoliday']             = 'student/viewHoliday';
    $route['stdnt_viewCollegiateCalendar']  = 'student/viewCollegiateCalendar';

    $route['rgstr_build/(:any)']            = 'registrar/buildup/$1';
    $route['rgstr_build/(:any)/(:any)']     = 'registrar/buildup/$1';

    $route['edit_subject/(:num)']           = 'dean/edit_subject/$1';
    $route['add_subject']                   = 'dean/add_subject';
    $route['edit_subject/(:num)/(:any)']    = 'dean/edit_subsject/$1/$2';

    // Instructor Routes
    $route['add_grade/(:num)']              = 'instructor/student_grade/$1';
    $route['instructor_sched']              = 'instructor/all_sched';
    $route['instruc_sched/(:num)']          = 'instructor/instruc_sched/$1';
    $route['match_subject']                 = 'instructor/match_subject';
    $route['combine_subject']               = 'instructor/combine_subject';
    $route['undo_subject/(:num)']           = 'instructor/undo_subject/$1';

    $route['change_sy']                     = 'dean/change_sy';
    $route['register']                      = 'registrar/register';

    $route['systemvalue']                   = 'systemvalue/index';
    
    $route['user_option/(:num)']            = 'useroption/index/$1';

/*-----------------------------------------------------------
 | Developers Routes
 | @author: vladz
 |-----------------------------------------------------------
 */

    $route['ungroup/(:num)']            = '/dean/ungroup/$1';
    $route['registrar/(:num)']          = 'registrar/delete_school/$1';
    $route['dean_evaluation/(:any)']    = 'dean/evaluation/$1';
    $route['registrar_tor/(:any)']      = 'registrar/tor/$1';
    $route['enrolment_grouping']        = 'dean/enrolmentLegacyGrouping';
    $route['register_employee']         = 'instructor/register_employee';
    $route['designation']               = 'admin/designation';
    $route['update_designation/(:num)'] = 'admin/update_designation/$1';
    $route['college']                   = 'colleges/college';
    $route['update_college/(:num)']     = 'colleges/update_college/$1';


/*-----------------------------------------------------------
 | Developers Routes
 | @author: GREG
 |-----------------------------------------------------------
 */

$route['add_curriculum/(:any)']         = 'dean/add_curriculum/$1';
$route['insert_curriculum/(:any)']      = 'registrar/curriculum/$1';
$route['scholarship/(:any)/(:any)']     = 'scholarship/viewscholarship/$1';
$route['scholarship/(:any)']            = 'scholarship/viewscholarship/$1';


$route['accountasset/(:any)/(:any)']    = 'movement/$1/$2';
$route['accountasset/(:any)']           = 'movement/$1';


$route['student-movement/(:any)/(:any)'] = 'movement/$1/$2';
$route['student-movemen/(:any)']         = 'movement/$1';

$route['movements']                      = 'movement/accmove';
$route['movement_update']                = 'movement/update_mov';


$route['update-movement/(:any)/(:any)']  = 'movement/$1/$2';
$route['update-movemen/(:any)']          = 'movement/$1';
$route['movement_add']                   = 'movement/add_movement';

//Audit Payment Override

$route['payment_override']               = 'audit/payment_override';
$route['list_billing']            = 'audit/list_billing';
$route['list_billing/(:any)']            = 'audit/list_billing/$1';
$route['view_std/(:any)/(:any)']         = 'audit/view_std/$1/$2';
$route['view_std/(:any)']                = 'audit/view_std/$1';
$route['view_over/(:any)/(:any)']        = 'audit/view_override/$1/$2';
$route['view_over/(:any)']               = 'audit/view_override/$1';
$route['insert_override']                = 'audit/insert_override';


/*
$route['payments/(:any)/(:any)/(:any)'] = 'billing/view_bill/$1';
$route['payments/(:any)'] = 'billing/view_bill/$1';
$route['viewbilling/(:any)/(:any)'] = 'billing/view_studentbilling/$1/$2';
$route['viewbilling/(:any)'] = 'billing/view_studentbilling/$1/$2';
*/


//Student Discount
$route['student_discount']              = 'discount/student_list';
$route['view_discount/(:any)']          = 'discount/view_discounts/$1';
$route['disc_submit']                   = 'discount/disc_submit';



//Add Course Major
$route['add_course']                    = 'coursemajor/add_course';
$route['insert_course']                 = 'coursemajor/insert_course';
$route['update_course/(:any)']          = 'coursemajor/update_course/$1';

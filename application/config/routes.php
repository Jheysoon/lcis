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

    // EDP Routes
    $route['edp_ListUsers']                 = 'edp/ListUsers';
    $route['edp_ClassroomList']             = 'edp/ClassroomList';
    $route['edp_CalculateSubjectSection']   = 'edp/CalculateSubjectSection';
    $route['edp_ClassAllocation']           = 'edp/ClassAllocation';

    // Student Routes
    $route['stdnt_editSelfEvaluation']      = 'student/editSelfEvaluation';
    $route['stdnt_viewSelfAssessment']      = 'student/viewSelfAssessment';
    $route['stdnt_viewStudyLoad']           = 'student/viewStudyLoad';
    $route['stdnt_viewGrades']              = 'student/viewGrades';
    $route['stdnt_viewHoliday']             = 'student/viewHoliday';
    $route['stdnt_viewCollegiateCalendar']  = 'student/viewCollegiateCalendar';

    $route['rgstr_build/(:any)']     = 'registrar/buildup/$1';
    $route['rgstr_build/(:any)/(:any)']     = 'registrar/buildup/$1';




/*-----------------------------------------------------------
 | Developers Routes
 | @author: vladz gwapo
 |-----------------------------------------------------------
 */





/*-----------------------------------------------------------
 | Developers Routes
 | @author: GREG
 |-----------------------------------------------------------
 */

$route['add_curriculum/(:any)'] = 'dean/add_curriculum/$1';
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
    $route['home'] = 'main/home';
    $route['logout'] = 'main/logout';
    $route['account'] = 'main/account';

    // Registrar Routes
    $route['registrar_addNewStudent']       = 'registrar/addNewStudent';
    $route['registrar_addTransferee']       = 'registrar/addTransferee';
    $route['registrar_addCrossEnrolee']     = 'registrar/addCrossEnrolee';
    $route['registrar_updateOldStudents']   = 'registrar/updateOldStudents';
    $route['registrar_permanentRecord']     = 'registrar/permanentRecord';
    $route['registrar_listCHED']            = 'registrar/listCHED';
    $route['registrar_listRequestedServices'] = 'registrar/listRequestedServices';
    $route['registrar_updateSystemValue']   = 'registrar/updateSystemValue';
    $route['registrar_listSchool']          = 'registrar/listSchool';
    $route['registrar_listCollege']         = 'registrar/listCollege';
    $route['registrar_listCourse']          = 'registrar/listCourse';
    $route['registrar_listScholasticPeriod'] = 'registrar/listScholasticPeriod';
    $route['registrar_listCollegiateCalendar'] = 'registrar/listCollegiateCalendar';
    $route['registrar_listHoliday']         = 'registrar/listHoliday';
    $route['registrar_listNonCreditedSubject'] = 'registrar/listNonCreditedSubject';
    $route['registrar_listSubjectGrouping'] = 'registrar/listSubjectGrouping';
    $route['registrar_listServices']        = 'registrar/listServices';

    // Audit Routes
    $route['adt_viewtStudentBilling']       = 'audit/viewtStudentBilling';
    $route['adt_listAllAccount']            = 'audit/listAllAccount';
    $route['adt_viewCashierAccountMovement'] = 'audit/viewCashierAccountMovement';

    // Cashier Routes
    $route['cshr_OpenCashWindow']           = 'cashier/OpenCashWindow';
    $route['cshr_addEnrolPayment']          = 'cashier/addEnrolPayment';
    $route['cshr_addExamPayment']           = 'cashier/addExamPayment';
    $route['cshr_listServiceRequested']     = 'cashier/listServiceRequested';
    $route['cshr_viewCashierMovement']      = 'cashier/viewCashierMovement';
    $route['cshr_addCashOut']               = 'cashier/addCashOut';



/*-----------------------------------------------------------
 | Developers Routes
 | @author:
 |-----------------------------------------------------------
 */





/*-----------------------------------------------------------
 | Developers Routes
 | @author:
 |-----------------------------------------------------------
 */


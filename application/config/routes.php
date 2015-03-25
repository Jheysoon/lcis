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
    $route['registrar_account']             = 'registrar/account';



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


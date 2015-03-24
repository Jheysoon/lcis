<?php 
	session_start();
	require 'models/database.php';
	require 'models/queries.php';
	include 'view/templates/header.php';

	$message = '';

	if (isset($_POST['page']))
		$page = $_POST['page'];
	elseif (isset($_GET['page'])) 
		$page = $_GET['page'];
	else
		$page = 'login';

	// if session is not set the user cannot redirect to home page

	if (!isset($_SESSION['id'])){

		$username = '';

		if ($page == 'validate') {

			$username = $_POST['username'];
			$password = $_POST['password'];

			if ($username == 'registrar' && $password == 'registrar') {
				$_SESSION['id'] = 1;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'dean' && $password == 'dean'){
				$_SESSION['id'] = 2;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'cashier' && $password == 'cashier'){
				$_SESSION['id'] = 3;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'instructor' && $password == 'instructor'){
				$_SESSION['id'] = 3;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'faculty' && $password == 'faculty'){
				$_SESSION['id'] = 4;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'comptroller' && $password == 'comptroller'){
				$_SESSION['id'] = 5;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'edp' && $password == 'edp'){
				$_SESSION['id'] = 6;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'audit' && $password == 'audit'){
				$_SESSION['id'] = 7;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'student' && $password == 'student'){
				$_SESSION['id'] = 8;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			elseif($username == 'hr' && $password == 'hr'){
				$_SESSION['id'] = 9;
				$_SESSION['uname'] = $username;
				header('location: ?page=home');
			}

			else{
				include 'view/templates/header_title1.php';
				include 'view/pages/login.php';
				include 'view/templates/footer.php';
				$message = 'Invalid Username/Password';
			}
		}

		elseif ($page == 'login') {
			include 'view/templates/header_title1.php';
			include 'view/pages/login.php';
			include 'view/templates/footer.php';
		}
		else{
			header('location: ?page=login');
		}

	}

	// if session is set redirect to home page

	else{

		if ($page == 'logout') {
			unset($_SESSION['id']);
			unset($_SESSION['uname']);
			header('location: ?page=login');
		}

		elseif( $page == 'home'){
			include('view/templates/header_title2.php');
			include('view/pages/home.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'account'){
			include('view/templates/header_title2.php');
			include('view/pages/account_settings.php');
			include('view/templates/footer.php');
		}

// =================================== EDP ==============================================

		elseif($page == 'EditClassroom'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/edit_classroom.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'ClassroomList'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/list_classroom.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'CalculateSubjectSection'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/calculate_subjectsection.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewSubjectSection'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/view_subjectsection.php');
			include('view/templates/footer.php');
			
		}elseif($page == 'edpClassAllocation'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/classRooms.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'edpScheduling'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/edpScheduling.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'edpViewSchedule'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/edpSched.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'ListUsers'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/list_users.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'editUser'){
			include('view/templates/header_title2.php');
			include('view/pages/edp/edit_user.php');
			include('view/templates/footer.php');
		}

// =================================== REGISTRAR ==============================================

		elseif($page == 'permanentRecord'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/student_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'transfereePRecord'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/permanent_record.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'studentRecord'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/student_record.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'addNewStudent'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/newstudent_registration.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'addTransferee'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/transferee_registration.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'addCrossEnrolee'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/crossenrollee_registration.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'editServiceRequest'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_servicerequest.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'editServicesRates'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_servicesrates.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'updateOldStudents'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/student_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'editStudent'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/oldstudent_registration.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'updateSystemValue'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/systemvalue_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'updateINCGrading'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/update_incgrading.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'updateStudentLoad'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/update_studentload.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewUpdatedSummary'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/view_updatedsummary.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listSchool'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/school_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listCourse'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/course_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listCollege'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/college_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listRequestedServices'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/requestedservices_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editCourse'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_course.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editSchool'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_school.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editHoliday'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_holiday.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editNonCreditedSubject'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_noncreditedsubject.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editEvaluation'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_evaluation.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewAttestedINCGrading'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/view_attestedincgrading.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listScholasticPeriod'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/scholasticperiod_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listCollegiateCalendar'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/collegiatecalendar_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listHoliday'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/holiday_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listNonCreditedSubject'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/noncreditedsubject_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listSubjectGrouping'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/subjectgrouping_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listSystemValue'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/systemvalue_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'addTransfereePRecord'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/transferee_PRecord.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listCHED'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/ched_list.php');
			include('view/templates/footer.php');
		}

// =================================== DEAN ==============================================

		elseif($page == 'deanClassAllocation'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/dean_classAllocation.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'deanTeachingLoad'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/dean_teachingLoad.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'deanPreEnrolment'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/dean_preEnroll.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'deanStudentGrading'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/dean_studentGrading.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'deanAttestGrade'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/dean_attestGrades.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewAttestedGradeSheet'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/view_attestedgradesheet.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listGradingList'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/grading_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editStudentGrading'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/edit_studentgrading.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listSubjectSectioning'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/list_subjectsectioning.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'addSubjectCurriculum'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/add_curriculum.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'copyCurriculum'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/copy_curriculum.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listINCsubject'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/incsubject_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listAttest'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/attest_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listCompletedINC'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/completedinc_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'attestINCGrading'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/attest_incgrading.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'attestGradeSheet'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/attest_gradesheet.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewINCGrading'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/view_openincgrading.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listSubject'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/subject_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editSubject'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/edit_subject.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listCurriculum'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/curriculum_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editCurriculum'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/edit_curriculum.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editCHEDScholar'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/edit_ched.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewOpenGradeSheet'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/view_opengradesheet.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listEvaluationSummary'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/dean_evaluationsummary.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'saveEvaluationSummary'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/dean_evaluationsummary.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'adddelete_Section'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/adddelete_section.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'generateSubjectSection'){
			include('view/templates/header_title2.php');
			include('view/pages/dean/generate_subjectsection.php');
			include('view/templates/footer.php');
		}

// =================================== AUDIT ==============================================

		elseif($page == 'viewtStudentBilling'){
			include('view/templates/header_title2.php');
			include('view/pages/audit/view_studentbilling.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewStudentAccountMovement'){
			include('view/templates/header_title2.php');
			include('view/pages/audit/view_studentaccountmovement.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewCashierAccountMovement'){
			include('view/templates/header_title2.php');
			include('view/pages/audit/view_cashieraccountmovement.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'listAllAccount'){
			include('view/templates/header_title2.php');
			include('view/pages/audit/account_list.php');
			include('view/templates/footer.php');
		}

// =================================== CASHIER ==============================================

		elseif($page == 'OpenCashWindow'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/open_cashwindow.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'addEnrolPayment'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/add_enrolpayment.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'addExamPayment'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/add_exampayment.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'addServicePayment'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/add_servicepayment.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listServiceRequested'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/list_servicerequested.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewCashierMovement'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/view_cashiermovement.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewPaymentEnrolment'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/view_paymentenrolment.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewPaymentExam'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/view_paymentexam.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'addCashOut'){
			include('view/templates/header_title2.php');
			include('view/pages/cashier/add_cashout.php');
			include('view/templates/footer.php');
		}
		
// ================================== STUDENT ============================================

		elseif($page == 'editSelfEvaluation'){
			include('view/templates/header_title2.php');
			include('view/pages/student/edit_selfevaluation.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewEvaluationSummary'){
			include('view/templates/header_title2.php');
			include('view/pages/student/view_evaluationsummary.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewSelfAssessment'){
			include('view/templates/header_title2.php');
			include('view/pages/student/view_selfassesment.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewStudyLoad'){
			include('view/templates/header_title2.php');
			include('view/pages/student/view_studyload.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewGrades'){
			include('view/templates/header_title2.php');
			include('view/pages/student/view_grades.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewHoliday'){
			include('view/templates/header_title2.php');
			include('view/pages/student/view_holiday.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewCollegiateCalendar'){
			include('view/templates/header_title2.php');
			include('view/pages/student/view_collegiatecalendar.php');
			include('view/templates/footer.php');
		}
		
// ================================== CONTROLLER ============================================

		elseif($page == 'contStudentAssesment'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/studentList.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'contAssesment'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/assesment.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'contStudentInquiry'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/studentList.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'contInquiry'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/inquiry.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listAccountCategory'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/accountcategory_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listRates'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/rates_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listFees'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/fees_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listAccount'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/account_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listScholarshipDiscount'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/list_discount.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listServices'){
			include('view/templates/header_title2.php');
			include('view/pages/registrar/services_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listGradingList'){
			include('view/templates/header_title2.php');
			include('view/pages/controler/grading_list.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'listScholarship'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/scholarship_list.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'editAccount'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/edit_account.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'viewAccountMovement'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/view_accountmovement.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'editAcademicScholar'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/edit_academicscholar.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewAcademicGWA'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/view_academicgwa.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editAccountCategory'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/edit_accountcategory.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewAccountingSet'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/view_accountingset.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewAccountingSetEnrolment'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/view_accountingsetenrolment.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewAccountingSetExam'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/view_accountingsetexam.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewTuitionAssessment'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/view_tuitionassessment.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'viewCashierAccountMovementComptroller'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/view_cashieraccountmovementcomptroller.php');
			include('view/templates/footer.php');
		}
		elseif($page == 'editFees'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/edit_fees.php');
			include('view/templates/footer.php');
		}

		elseif($page == 'editRates'){
			include('view/templates/header_title2.php');
			include('view/pages/controller/edit_rates.php');
			include('view/templates/footer.php');
		}


		else{
			header('location: ?page=home');
		}

	}

if($message != ''){ ?>
	 <script type="text/javascript">
	 	Alert.render('<?php echo $message ?>');
	 </script>
<?php } ?>
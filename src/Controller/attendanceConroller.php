<?php

namespace Controller;

use Model\Attendance;

include_once '../Model/Attendance.php';

class attendanceConroller
{
    protected $attendanceModel;

    public function __construct()
    {
        $this->attendanceModel = new Attendance();
    }

    public function displayStudent($schedule)
    {
        $tr = '';
        $students = $this->attendanceModel->DisplayStudentList($schedule);
        foreach ($students as $student) {
            // Safely access student data and handle missing values
            $studentNo = $student['StudentNo'];
            $firstName = $student['FirstName'];
            $lastName = $student['LastName'];
            $Id = $student['id'];


            // Combine first name and last name to get the full name
            $fullName = $firstName . ' ' . $lastName;
            $tr .= ' 
            <tr>
                <th>' . $studentNo . '</th>
                <td>' . $firstName . '</td>
                <td>' . $lastName . '</td>
                <td>
                    <input type="hidden" name="student_id" value="' . $studentNo . '">
                    <input type="hidden" name="fullName" value="' . $fullName . '">
                    <span class="badge bg-success">
                        Present 
                        <input name="attendance[' . $studentNo . ']" value="Present" type="radio">
                    </span>
                    <span class="badge bg-danger">
                        Absent
                        <input name="attendance[' . $studentNo . ']" value="Absent" type="radio">
                    </span>
                </td>
            </tr>';
        }

        echo $tr;
    }

    public function insertAttendance($studentNo, $fullName,$status)
    {
      $this->attendanceModel->InsertAttendance($studentNo, $fullName,$status);
      return ['status' => 'success', 'message' => 'Attendance recorded successfully.'];
    }

    public function displayAttendance($studentId)
    {
        $model = new Attendance();
        $data = $model->Attendance($studentId);
        $tr = '';
        $processed = [];
        if ($data) {
            foreach ($data as $attendance) {
                $studentName = $attendance['StudentName'];
                $student_Id = $attendance['StudentNo'];
                $attendDate = $attendance['Date'];
                $status = $attendance['status'];
                if (!isset($processed[$student_Id][$attendDate])) {
                    $processed[$student_Id][$attendDate] = [];
                }
                if (!in_array($status, $processed[$student_Id][$attendDate])) {            
                    $tr .= '<tr>
                        <th>' . $student_Id . ' </th>
                        <td>' . $studentName . ' </td>
                        <th>' . $attendDate . ' </th>
                        <th>' . $status . ' </th>
                        </tr>';
                        $processed[$student_Id][$attendDate][] = $status;
                    }
                }
        } else {
                $tr .= '<tr><td colspan="4"><strong>No Attendance Available</strong></td></tr>';
        }
        echo $tr;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['action'])){
        switch ($_POST['action']){
            case 'scheduleDis':
                $schedule = $_POST['schedule'];
                $controller = new attendanceConroller();
                $controller->displayStudent($schedule);
                break;
            case 'Attendance':
                $response = [];
                foreach ($_POST['attendance'] as $studentId => $status) {
                    $fullName = $_POST['fullName'];
                    $attendanceController = new attendanceConroller();
                    $result = $attendanceController->insertAttendance($studentId, $fullName,$status);
                    $response[] = $result;
                }
                echo json_encode($response);
                break;
        }

    }
}


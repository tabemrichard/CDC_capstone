<?php

namespace Controller;

use Model\StudentModel;
include '../Model/StudentModel.php';
class studentConroller
{
    public function displayStudents()
    {
        $model = new StudentModel();
        $model->displayStudents();
    }

    public function updateStudents()
    {
        $id = $_POST['id'];
        if (isset($id)){
            $modal = new StudentModel();
            $modal->updateStudent($id);

        }else{
            echo "No Id";
        }
    }

    public function saveStudentUpdatedInfo()
    {
        if (isset($_POST['id'])){
            $firstName = $_POST['FirstName'];
            $lastName = $_POST['LastName'];
            $Status = $_POST['Status'];
            $Age = $_POST['Age'];
            $birtDate = $_POST['birtDate'];
            $id = $_POST['id'];
            $schedule = $_POST['scheduleSave'];

            $model = new StudentModel();
            $model->SaveStudentInfo($firstName,$lastName,$Status,$Age,$birtDate,$id,$schedule);
        }
    }

    public function archiveStudent()
    {
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $archive = "isDeleted";
            $model = new StudentModel();
            $model->archiveStudent($archive,$id);
        }

    }

    public function addNewStudent()
    {
        $data = [];
        $error = [];

        $firstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Age = $_POST['Age'];
        $birthday = $_POST['birthday'];
        $Gender = $_POST['Gender'];
        $StudentId = $_POST['StudentId'];
        $schedule = $_POST['schedule'];


        if (empty($schedule)){
            $error['schedule'] = 'please select schedule';
        }
        if (empty($firstName)){
            $error['FirstName'] = 'first name is required';
        }
        if (empty($LastName)){
            $error['LastName'] = 'LastName is required';
        }
        if (empty($Age)){
            $error['Age'] = 'Age is required';
        }
        if (empty($birthday)){
            $error['birthday'] = 'birthday is required';
        }
        if (empty($Gender)){
            $error['FirstName'] = 'please select Gender';
        }

        if (empty($StudentId)){
            $error['StudentId'] = 'enter student number';
        }


        if (!empty($error)){
            $data['success'] = false;
            $data['errors'] = $error;
            echo json_encode($data);
        }else{
            $modal = new StudentModel();
            $modal->addStudent($firstName,$LastName,$StudentId,$Age,$birthday,$Gender,$schedule);

        }
    }

    public function ChartDisplay()
    {
        $model = new StudentModel();
        $model->DisplayChart();
    }

    public function ChartDisplayBar()
    {
        $model = new StudentModel();
        $model->DisplayChartBar();
    }
    
    public function DisplayEnrolledAndUnEnrolledStudent($status)
    {
      $model = new StudentModel();
      $count = $model->DisplayEnrolledAndUnEnrolled($status);
      echo $count;
    }

    public function countRegisterParents()
    {
        $model = new StudentModel();
       $parent = $model->countParent();
       echo $parent;
    }



}


if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (isset($_POST['action'])){

        $controller = new studentConroller();
        switch ($_POST['action']){
            case 'updateStudent':
                $controller->updateStudents();
                break;
            case 'SaveInfo':
                $controller->saveStudentUpdatedInfo();
                break;
            case 'archiveStudent':
                $controller->archiveStudent();
                break;
            case 'addStudent':
                $controller->addNewStudent();
                break;
            case 'displayChart':
                $controller->ChartDisplay();
                break;
            case 'displayChartBar':
                $controller->ChartDisplayBar();
                break;
        }
    }
}
<?php

namespace Model;
use Controller\studentConroller;

include '../../Config/DbConnection.php';
class StudentModel extends \DbConnection
{
public function displayStudents()
{
    $result = $this->Connect()->query("select * from student where ArchiveStatus = 'Active' ");
    $tr = '';

    if ($result->num_rows > 0) {
        while ($student = $result->fetch_assoc()) {
            $tr .= '
            <tr>
                <th>' . $student['StudentNo'] . '</th>
                <td>' . $student['FirstName'] . '</td>
                <td>' . $student['LastName'] . '</td>
                <td class="' . ($student['Status'] === 'Enrolled' ? 'text-success' : 'text-danger') . '">
                    ' . $student['Status'] . '
                </td>
                <td>
                    <button value="'. $student['id'] . '" id="btn_update" style="background-color: #004581" class="btn text-light">Update</button>
                    <button  value="'. $student['id'] . '" id="archiveBTN" style="background-color: #004581" class="btn text-light">Archive</button>
                </td>
            </tr>
        ';
        }
    }else{
            $tr .= '<tr><td colspan="6">No students found</td></tr>';
    }
  echo $tr;
}


public function updateStudent($id)
{
    $query = "select * from student where id = ?";
    $stmt = $this->Connect()->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stmt->get_result();

    $modal = '';
    while ($student = $result->fetch_assoc()){
        $modal .= '
        <!-- Modal -->
        <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <form id="formUpdate" action="../Controller/studentConroller.php" method="post" class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body d-flex flex-column gap-3">
                       <div>
                          <span>Status</span>
                          <select name="Status" class="form-select" aria-label="Default select example">
                         <option value="'.$student['Status'].'" selected>'.$student['Status'].'</option>
                          <option value="Enrolled">Errolled</option>
                          <option value="Pending">Pending</option>
                       </div>
                       
                           <div class="mt-2">
                              <label for="FirstName">
                                FirstName
                              <input name="FirstName" type="text" value="'.$student['FirstName'].'" class="form-control">
                           </label>
                         </div>
                         
                          <label for="LastName">
                         LastName
                          <input name="LastName" type="text" value="'.$student['LastName'].'" class="form-control">
                       </label>
                       <label for="Age">
                          Age
                          <input name="Age" type="number" value="'.$student['Age'].'" class="form-control">
                       </label>
                       
                       <label for="birtDate">
                          BirtDate
                          <input name="birtDate" type="date" value="'.$student['Birdate'].'" class="form-control">
                       </label>
                       <input name="id" value="'.$student['id'].'" type="hidden">
                       
                         <select name="scheduleSave" class="form-select" aria-label="Default select example">
                            <option value="'.$student['schedule'].'">'.$student['schedule'].'</option>
                            <option value="morning">morning</option>
                            <option value="afternoon">afternoon</option>
                        </select>
                    </div>  
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
        ';
        echo $modal;
    }
}

public function SaveStudentInfo($firstName,$lastName,$Status,$Age,$birtDate,$id,$schedule)
{
  $query = "update student set FirstName = ? ,LastName = ?,  Status = ?, Age = ?, Birdate = ?, schedule = ? where id = ? ";
  $stmt = $this->Connect()->prepare($query);
  $stmt->bind_param('ssssssi',$firstName,$lastName,$Status,$Age,$birtDate,$schedule,$id);
  if ($stmt->execute()){
      echo json_encode(['success' => true , 'message' => 'Student is Successfully Updated']);
  }else{
      echo json_encode(['success' => false , 'message' => 'Failed to Update','error' => $stmt->error]);
  }
}

public function archiveStudent($archive,$id)
{
    $query = "update student set ArchiveStatus = ? where id = ?";
    $stmt = $this->Connect()->prepare($query);
    $stmt->bind_param('si',$archive,$id);
    if ($stmt->execute()){
        echo json_encode(['success' => true, 'message' => 'Student is Successfully Deleted']);
    }else{
        echo json_encode(['success' => false , 'message' => 'Failed to Delete','error' => $stmt->error]);
    }
}


    public function addStudent($firstName,$lastName, $studentI,$Age,$Birthday,$Gender,$schedule)
    {
         $query = "insert into student(firstname, lastname, studentno, age, birdate, gender,schedule) values (?,?,?,?,?,?,?)";
         $stmt = $this->Connect()->prepare($query);
         $stmt->bind_param('sssssss',$firstName,$lastName,$studentI,$Age,$Birthday,$Gender,$schedule);
         if ($stmt->execute()){
             echo json_encode(['success' => true, 'message' => 'Successfully Added New Student']);
         }else{
             echo json_encode(['success' => false , 'message' => 'Failed to Add','error' => $stmt->error]);
         }
    }

    public function DisplayChart()
    {
        $result  = $this->Connect()->query("SELECT
    Status,
    COUNT(*) AS total
FROM
    student
GROUP BY
    Status;");
      $data = [];
        while ( $row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function DisplayChartBar()
    {
        $result  = $this->Connect()->query("SELECT
    schedule,
    COUNT(*) AS total
FROM
    student
GROUP BY
    schedule;");
      $data = [];
        while ( $row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function DisplayEnrolledAndUnEnrolled($status)
    {
        $query = "SELECT  SUM(student.Status = ?) as Enrolled from student";
        $stmt = $this->Connect()->prepare($query);
        $stmt->bind_param('s',$status);
        $stmt->execute();
        $result = $stmt->get_result();
       $row = $result->fetch_assoc();
       return $row['Enrolled'];
    }

    public function countParent()
    {
        $result = $this->Connect()->query("SELECT count(*) AS parents from parent");
        $parent = $result->fetch_assoc();
        return $parent['parents'];
    }

}

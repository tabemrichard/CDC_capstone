<?phpnamespace Controller;use Model\requirementsModel;include_once '../Model/requirementsModel.php';class requirementController{   public function uploadRequirements()   {      $data = [];      $Err = [];      $Name = $_POST['RequirementName'];      $studentId = $_POST['studentNumber'];      $file_name = $_FILES['fileUpload'];      if (empty($Name)){          $Err['errorM'] = 'requirement name is required';      }      if (empty($studentId)){          $Err['errorM'] = 'student id is required';      }      if (empty($file_name['name'])){          $Err['errorM'] = 'please upload file';      }      if (!empty($Err)){          $data['success'] = false;          $data['error'] = $Err;          echo json_encode($data);      }else{          // handle the uploading file to DIR          $fileDir = '../../RequirementsUploads/';          $fileName = basename($_FILES['fileUpload']['name']);          $filePath = $fileDir .$fileName;          move_uploaded_file($file_name['tmp_name'] ,$filePath);          // call the method to insert data from form to database          $model = new requirementsModel();          $model->uploadRequirements($Name,$fileName,$studentId);      }   }   public function displayRequirementList($studentId)   {        $model = new requirementsModel();       $data = $model->displayRequirements($studentId);        $card = '';        if ($data){ // check if we have result of data            foreach ($data as $requirements){                $name = $requirements['Name'];                $fileName = $requirements['fileName'];                $id = $requirements['id'];                $card .= '          <div class="card p-3 col-lg-5">        <img class="img-fluid" src="../../RequirementsUploads/' .$fileName. '" alt="file">        <div class="card-body">            <h1> '.$name.'</h1>        </div>        <div class="card-footer bg-transparent">            <button id="delete_btn" value=" '.$id.'" class="btn btn-outline-danger">                <i class="fa-solid fa-trash-can"></i>                Delete            </button>            <button id="btn_update" value=" '.$id.'" class="btn btn-outline-primary">                <i class="fa-solid fa-file-pen"></i>                Update            </button>        </div>    </div>           ';            }        }       echo $card;   }   public function deleteRequirement()   {       $id = $_POST['id'];       $model = new requirementsModel();       if (isset($id)){           $model->deleteRequirements($id);       }else{           echo json_encode(['success' => false ,'message' => 'No Id']);       }   }   public function updateRequirements()   {       $id = $_POST['id'];       $model = new requirementsModel();       if (isset($id)){           $data = $model->updateRequirement($id);           $form = '';           foreach ($data as $row){               $name = $row['Name'];               $id = $row['id'];               $file = $row['fileName'];               $form .= '               <div class="modal fade" id="RequirementModalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">        <div class="modal-dialog modal-dialog-centered">            <form id="formUploadRequirementUpdate" action="../Controller/requirementController.php" enctype="multipart/form-data" method="post" class="modal-content">                <div class="modal-header">                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Requirement</h1>                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                </div>            <div class="modal-body d-flex flex-column gap-2">                <label for="Name">                    Requirement Name                    <input name="RequirementNameSave" value=" '.$name.'" type="text" class="form-control">                </label>                 <input name="id" value=" '.$id.'" type="hidden" >                <label for="file">                    Upload Here                    <input value="' .$file. '" name="fileUploadSave" accept="image/jpeg,image/png" type="file" class="form-control">                </label>                <div class="modal-footer">                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                    <button type="submit" class="btn btn-primary">Save</button>                </div>                </form>            </div>        </div>          ';           }           echo $form;       }   }   public function saveRequirements()   {       $model = new requirementsModel();       $name = $_POST['RequirementNameSave'];       $file =  $_FILES['fileUploadSave'];       $id = $_POST['id'];       $model->saveRequirements($name,$file,$id);   }   public function displayStudentNameAndId()   {       $model = new requirementsModel();       $data = $model->GetstudentInfo();       $droDown = '';       if ($data){           foreach ($data as $info){               $fullName = $info['FirstName'] . " ". $info['LastName'];               $studentId = $info['StudentNo'];               $droDown .= '              <option value="'.$studentId.'">'.$fullName.'</option>           ';           }           echo $droDown;       }   }   public function displayRequirementViaStudentID()   {     $model = new  requirementsModel();     $studentId = $_POST['StudentId'];      if (isset($studentId)){       $data = $model->GetRequirementByStudentId($studentId);         $card = '';         if ($data){ // check if we have result of data             foreach ($data as $requirements){                 $name = $requirements['Name'];                 $fileName = $requirements['fileName'];                 $card .= '          <div class="card p-3 col-lg-5">         <img class="img-fluid" src="../../RequirementsUploads/' .$fileName. '" alt="file">        <div class="card-body">            <h1> '.$name.'</h1>        </div>    </div>           ';             }         }         echo $card;     }   }}if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action']){    $controller = new  requirementController();    switch ($_POST['action']){        case 'uploadRequirements':            $controller->uploadRequirements();            break;        case 'delete_':            $controller->deleteRequirement();            break;        case 'update_':            $controller->updateRequirements();            break;        case 'SaveRequirement':            $controller->saveRequirements();            break;        case 'viewRequirementByStudentId':            $controller->displayRequirementViaStudentID();          break;    }}
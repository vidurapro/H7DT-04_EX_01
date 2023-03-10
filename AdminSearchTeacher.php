
<?php
if (!isset($access_php)) {
    require './access.php';
}
if (!isset($_query_php)) {
    require './query.php';
}
function resposing($rs){
    $n = $rs ->  num_rows;

    if ($n > 0){
        for ($x = 0 ; $x < $n ; $x ++){
            $d = $rs -> fetch_assoc();
            $Row_uniqueId = uniqid();
            if (isset($d['email'])) {


                ?>
                  <div class="col-12">
                <div class="row"  id="TeachersBody">
                    <?php
                    $teacher_rs = Admin_q::GetAllTeachers();
                    $teacher_n = $teacher_rs->num_rows;
                    for ($x = 0; $x < $teacher_n; $x++) {
                        $d = $teacher_rs->fetch_assoc();
                        $Row_uniqueId = uniqid();

                        if (isset($d['email'])) {


                    ?>
                            <div class="col-12">
                                <div class="row bg-white mt-1 p-1 ">
                                    <div class="col-2 fw-bold border-end text-black-50 "> <?php echo ($Row_uniqueId) ?></div>
                                    <div class="col-3 fw-bold border-end text-black-50 "><?php echo ($d['fname'] . ' ' . $d['lname']) ?> </div>
                                    <div class="col-3 fw-bold border-end text-black-50 "><?php echo ($d['email']) ?></div>
                                    <div class="col-3 fw-bold border-end text-black-50 ">
                                        <select name="" class="form-control" id="">
                                            <option value="0"> All Grades And Subjects</option>
                                            <?php
                                            $t_gs_rs = Admin_q::GetTeacherAllGradersAndSubjectByEmail($d['email']);
                                            $t_gs_n = $t_gs_rs->num_rows;
                                            if ($t_gs_n > 0) {
                                                for ($x = 0; $x < $t_gs_n; $x++) {
                                                    $t_gs_d = $t_gs_rs->fetch_assoc();
                                            ?>
                                                    <option value="<?php echo ($x) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
                                            <?php
                                                }
                                            }
                                            ?>


                                        </select>

                                    </div>

                                    <div class="col-1 fw-bold border-end text-black-50 ">
                                        <button class="btn btn-primary" type="button" onclick="GetAllSubjectAndGrades('add_new_sub_sbForTeacher','add_new_sub_gdForTeacher')" data-bs-toggle="collapse" data-bs-target="#collapseExample_<?php echo ($Row_uniqueId) ?>" aria-expanded="false" aria-controls="collapseExample">
                                            Actions
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="collapse" id="collapseExample_<?php echo ($Row_uniqueId) ?>">
                                        <div class="card card-body">
                                            <div class="container-fluid">
                                                <div class="row">

                                                    <!-- Add New Grade and Subject -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Add New Grade and Subject </div>
                                                                <div class="row p-1">
                                                                    <select name="" class="form-control" id="AddTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>">
                                                                        <option value="0"> All Grades And Subjects</option>
                                                                        <?php
                                                                        $t_gs_rs = Admin_q::GetGradeAndHaveAllSubject();
                                                                        $t_gs_n = $t_gs_rs->num_rows;
                                                                        if ($t_gs_n > 0) {
                                                                            for ($x = 0; $x < $t_gs_n; $x++) {
                                                                                $t_gs_d = $t_gs_rs->fetch_assoc();
                                                                        ?>
                                                                                <option value="<?php echo ($t_gs_d['grade_g_id'] . '@' . $t_gs_d['subjects_subject_id']) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </select>
                                                                </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-dark" onclick="AddTeacherForSubjectAndGrade('AddTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>')">Add</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Remove Grade and Subject -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Remove Grade and Subject </div>
                                                                <div class="row p-1">
                                                                    <select name="" class="form-control" id="RemoveTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>">
                                                                        <option value="0"> All Grades And Subjects</option>
                                                                        <?php
                                                                        $t_gs_rs = Admin_q::GetTeacherAllGradersAndSubjectByEmail($d['email']);
                                                                        $t_gs_n = $t_gs_rs->num_rows;
                                                                        if ($t_gs_n > 0) {
                                                                            for ($x = 0; $x < $t_gs_n; $x++) {
                                                                                $t_gs_d = $t_gs_rs->fetch_assoc();
                                                                        ?>
                                                                                <option value="<?php echo ($t_gs_d['g_id'] . '@' . $t_gs_d['subject_id']) ?>"> Grade <?php echo ($t_gs_d['grade']) ?> - <?php echo ($t_gs_d['subject_name']) ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </select>
                                                                </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-danger" onclick="RemoveTeacherForSubjectAndGrade('RemoveTeacherForSubjectAndGradeSelect<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>')">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Send Notification -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Send Notification </div>
                                                                <div class="row p-1">
                                                                    <input type="text" class="form-control" id="sendNotification<?php echo ($Row_uniqueId) ?>">
                                                                </div>

                                                                <div class="row p-1">
                                                                    <button class="btn btn-dark" onclick="sendNotificationToTeacher('sendNotification<?php echo ($Row_uniqueId) ?>','<?php echo ($d['email']) ?>')">send</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Actions -->
                                                    <div class="col-3 p-1">
                                                        <div class="row m-1">
                                                            <div class="col-12 border border-1 rounded">
                                                                <div class="row text-center fw-bold p-1"> Actions </div>
                                                                <div class="row p-1">
                                                                    <button class="btn btn-danger"> block</button>
                                                                </div>

                                                                <div class="row p-1">
                                                                    <button class="btn btn-outline-dark">View Profile</button>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
                        
                <?php
                    }
        }
    }
}
if (Access::admin()) {

    if (isset($_POST['text']) && isset($_POST['grade']) && isset($_POST['sub'])){
        $txt = $_POST['text'];
        $grade = $_POST['grade'];
        $sub = $_POST['sub'];

        if ($grade == "0" && $sub == "0"){
            $rs =  Admin_q::SearchTeacherLike($txt);
            resposing($rs);
        }else if ($grade > 0 && $sub == "0"){
            
            $rs =  Admin_q::SearchTeacherLikeWithGrade($txt,$grade);
            resposing($rs);
        }else if ($grade == "0" && intval($sub) > 0){
            
            $rs =  Admin_q::SearchTeacherLikeWithSub($txt,$sub);
            
            resposing($rs);
        }else if ($grade > 0 && intval($sub) > 0){
            
            $rs =  Admin_q::SearchTeacherLikeWithSubGrade($txt,$sub,$grade);
            
            resposing($rs);
        }


    }

}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="views/GSS/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header-mariam"><h1>กลุ่มผู้สำรวจ</h1></div>
        <div class="grid-option">
            <div></div>
            <button class="btn btn-info"><?php echo (sizeOf($this->nameS)/3); ?> กลุ่ม</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#insertModal">เพิ่มกลุ่ม</button>
        </div>
        <div class="grid-content">
            <?php  
                $i = 3;
                foreach($this->nameS as $row){
                if($i%3==0){
                ?>
            <div class="card">
                <div class="card-body">
                    <div class="grid-item">
                        <div class="number click" >
                            <?php echo $row['GN']; ?>
                        </div>
                        <div class="main click">
                            <ul>
                                <?php foreach($this->nameS as $rowIn) { 
                                      if($rowIn['id_group_staff'] == $row['id_group_staff']){ ?>
                                        <li id=<?php echo $rowIn['id_staff']; ?>><?php echo $rowIn['SN']." ".$rowIn['lname']; ?></li>
                                <?php } }?>
                            </ul>
                        </div>
                        <button class="btn btn-warning edit" id = <?php echo $row['id_group_staff']; ?> data-toggle="modal" data-target="#updateModal">แก้ไข</button>
                        <button class="btn btn-danger delete">ลบ</button>
                    </div>
                </div>
            </div>
            <?php  }$i++;
                        } ?>
        </div>
    </div>

    <!-- Modal Insert-->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">เพิ่มกลุ่มสำรวจ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="?controller=group_staff_survey&action=insert">
        <div class="modal-body">
            
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">ชื่อกลุ่ม</label>
                        <input type="text" name="name-group" class="form-control col-6" placeholder="ชื่อกลุ่ม" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เจ้าหน้าที่คนที่ 1</label>
                        <select class="custom-select col-6 select1" name="id-staff[]" id="inlineFormCustomSelect">
                            <option selected>เลือกเจ้าหน้าที่</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_staff'];?>"><?php echo $row['name']." ".$row['lname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เจ้าหน้าที่คนที่ 2</label>
                        <select class="custom-select col-6 select2" name="id-staff[]" id="inlineFormCustomSelect">
                            <option selected>เลือกเจ้าหน้าที่</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_staff'];?>"><?php echo $row['name']." ".$row['lname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เจ้าหน้าที่คนที่ 3</label>
                        <select class="custom-select col-6 select3" name="id-staff[]" id="inlineFormCustomSelect">
                            <option selected>เลือกเจ้าหน้าที่</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_staff'];?>"><?php echo $row['name']." ".$row['lname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
           
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    <!--end modal Insert -->

    <!-- Modal update-->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">เพิ่มกลุ่มสำรวจ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="?controller=group_staff_survey&action=update">
        <div class="modal-body">
            
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">ชื่อกลุ่ม</label>
                        <input type="text" id="name-group" name="name-group-edit" class="form-control col-6">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เจ้าหน้าที่คนที่ 1</label>
                        <select class="custom-select col-6" id="select1" name="id-staff-edit[]" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_staff'];?>"><?php echo $row['name']." ".$row['lname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เจ้าหน้าที่คนที่ 2</label>
                        <select class="custom-select col-6" id="select2" name="id-staff-edit[]" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_staff'];?>"><?php echo $row['name']." ".$row['lname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เจ้าหน้าที่คนที่ 3</label>
                        <select class="custom-select col-6" id="select3" name="id-staff-edit[]" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_staff'];?>"><?php echo $row['name']." ".$row['lname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id">
                <input type="hidden" name="name-group-old">
           
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    <!--end modal update -->
</body>
<script>
    $(".main,.number").hover(
        function() {
            $(this).parent().children().first().css("color","rgb(240, 69, 2)");
        }, function() {
            $(this).parent().children().first().css("color","white");
        }
    );
    $( "#datepicker" ).datepicker();
    $(document).on('click','.edit',function(){
        let edit_li = $(this).prev().children().children();
        $('#name-group').val($(this).prev().prev().text().trim());
        $('#select1').children().first().text(edit_li.first().text());
        $('#select1').children().first().val(edit_li.first().attr('id'));
        $('#select2').children().first().text(edit_li.first().next().text());
        $('#select2').children().first().val(edit_li.first().next().attr('id'));
        $('#select3').children().first().text(edit_li.last().text());
        $('#select3').children().first().val(edit_li.last().attr('id'));

        // set value old
        $('input[name=name-group-old]').val($(this).prev().prev().text().trim());
        $('input[name=id]').val($(this).attr('id'));
    })
</script>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="views/SR/style.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header-mariam"><h1>Survey</h1></div>
        <div class="grid-option">
            <div></div> <!-- //สร้างหลอกไว้ -->
            <button class="btn btn-info"><?php echo sizeOf($this->data); ?> รอบ</button>
            <div class="insert">
                <button class="btn btn-success" data-toggle="modal" data-target="#insertModal">เพิ่มข้อมูล</button>
            </div>
        </div>
        <div class="grid-content">
        <?php foreach($this->data as $row) { ?>
            <div class="card ">
                <div class="grid-body grid-card">
                    <div class="zone click" id="<?php echo $row['id']; ?>">
                        รอบที่ <?php echo $row['id']; ?>
                    </div>
                    <div class="time click">
                        เวลา  <?php $start = explode(":",$row['start']);
                                    $end = explode(":",$row['end']);
                                    echo $start[0].":".$start[1]."-".$end[0].":".$end[1];
                        ?>
                    </div>
                    <div class="edit" start="<?php echo $start[0].":".$start[1]; ?>" end="<?php echo $end[0].":".$end[1]; ?>">
                       <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal">edit</button>
                    </div>
                    <div class="delete">
                        <button class="btn btn-danger">delete</button>
                    </div>
                </div>
            </div>
                <?php } ?>
            
        </div>
    </div>
    <!-- Modal update-->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">แก้ไขช้อมูลการสำรวจ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="?controller=survey&action=updateRound">
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">ระบุรอบ</label>
                        <input type="number" name="round-edit" class="form-control col-5">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เวลาเริ่มต้น</label>
                        <input type="text" name="time-edit[]" class="timepicker form-control col-5">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เวลาสิ้นสุด</label>
                        <input type="text" name="time-edit[]" class="timepicker form-control col-5">
                    </div>
                </div>
                <input type="hidden" name="roundO">
            
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

    <!-- Modal insert-->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">แก้ไขช้อมูลการสำรวจ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="?controller=survey&action=insertRound">
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">ระบุรอบ</label>
                        <input type="number" name="round" class="form-control col-5">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เวลาเริ่มต้น</label>
                        <input type="text" name="time[]" class="timepicker form-control col-5">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เวลาสิ้นสุด</label>
                        <input type="text" name="time[]" class="timepicker form-control col-5">
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
    <!--end modal insert -->
</body>
</html>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(".zone,.time").hover(
            function() {
                $(this).parent().children().first().css("color","rgb(240, 69, 2)");
            }, function() {
                $(this).parent().children().first().css("color","white");
            }
        );
        $( "#datepicker" ).datepicker();
        $('input.timepicker').timepicker({
            timeFormat: 'H:mm p',
            interval: 60,
            minTime: '24:00am',
            maxTime: '23:00am',
            defaultTime: '8:00am',
            startTime: '00:00am',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $(document).on('click','.btn-edit',function(){
            $("input[name='round-edit']").val($(this).parent().prev().prev().attr('id'));
            // console.log($(this).prev().prev().val());
            $("input[name='start-edit']").val(($(this).parent().attr('start'))+" AM");
            $("input[name='end-edit']").val(($(this).parent().attr('end'))+" AM");
            $("input[name='roundO']").val($(this).parent().prev().prev().attr('id'))
            // $("input[name='round-edit']").val($(this).parent().prev().prev().attr('id'));
        })
    </script>
</script>



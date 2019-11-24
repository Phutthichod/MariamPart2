<link rel="stylesheet" href="layout/navbar.css">
<ui class="grid-nav">
    <li class="header"><h5>PART 2</h5></li>
    <li class="grid-li item2"><i class="fas fa-hiking"></i><span>การสำรวจ</span></li>
    <li class="grid-li item3"><i class="fas fa-clock"></i><span>รอบการตวจ</span></li>
    <li class="grid-li item4"><i class="fas fa-user-secret"></i></<span><span>ผู้บุกรุก</span></li>
    <li class="grid-li item1"><i class="fas fa-users"></i><span>กลุ่มผู้สำรวจ</span></li>
</ui>
<script>
    for(i = 1 ; i < 5 ; i++){
        $(`.item${i} i`).css("color","white"); 
    }
    let status = "survey";
    <?php if(isset($Isnav)){ ?>
    status = "<?php echo $Isnav; ?>";
    <?php } ?>
    let active = 2;
    switch(status){
        case 'GSS':
            $('.item1 i').css("color","#66ff66"); 
            $('.item1 i').parent().css("border-top","4px solid #66ff66");
            active = 1;
            break;
        case 'survey':
            $('.item2 i').css("color","rgb(255, 51, 204)"); 
            $('.item2 i').parent().css("border-top","4px solid rgb(255, 51, 204)");
            active = 2;
            break;
        case 'SR':
            $('.item3 i').css("color","#3399ff"); 
            $('.item3 i').parent().css("border-top","4px solid #3399ff");
            active = 3;
            break;
        case 'intruder':
            $('.item4 i').css("color","rgb(204, 0, 204)"); 
            $('.item4 i').parent().css("border-top","4px solid rgb(204, 0, 204)");
            active = 4;
            break;
    }
    $('.grid-li').hover(
        function(){
           $(this).css("background-color","#201c29")
           $('.item1 i').css("color","#66ff66"); 
           $('.item2 i').css("color","rgb(255, 51, 204)"); 
           $('.item3 i').css("color","#3399ff"); 
           $('.item4 i').css("color","rgb(204, 0, 204)"); 
           console.log('hover');
        },function(){
            $(this).css("background-color","black")
            let i = 1;
            for(i = 1 ; i < 5 ; i++){
                if(i!=active){
                    $(`.item${i} i`).css("color","white"); 
                }
            }
            console.log('not hover');
        }
    )
    $('.item1').click(function(){
        window.location.href = '?controller=group_staff_survey&action=index';
    })
    $('.item2').click(function(){
        window.location.href = '?controller=survey&action=index';
    })
    $('.item3').click(function(){
        window.location.href = '?controller=survey&action=round';
    })
    $('.item4').click(function(){
        window.location.href = '?controller=intruder&action=index';
    })
    
</script>
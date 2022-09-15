
function get_class(get_html, name_html){
    var grade = document.getElementById(get_html).value;

    console.log(grade)
    $.getJSON('https://sw127-chatbot.cf/config/class.json', function(data){
            var datas = data[grade];

            var html = '<select id="class_teach" class="form-select form-select-sm" style="max-width: 10rem;" aria-label="Default select example"><option value="all" selected>ห้อง</option>';
            let i = 0;
            for(list in datas){
                html += '<option value="'+datas[i]+'">'+datas[i]+'</option>';
                i +=1;
            }
            html += '</select>';

            document.getElementById(name_html).innerHTML = html;
            console.log(datas)
            console.log(html)
        }
    )
}

function get_course(){
    axios.post("/api/teacher.php",
        {
            action: "get_course",
        }
    ).then((res) => {
        var datas = res.data.data;
        console.log(datas)

        var html = ' <select id="coursetable_teacher" onchange="" class="form-select form-select-sm" style="max-width: 20rem;" aria-label="Default select example"><option value="all" selected>ทั้งหมด</option>'
        let i = 0;
        for(list in datas){
            html += '<option value="'+datas[i].course+'">'+datas[i].name_course+'</option>'
            i +=1
        }
        html += '</select>'

        document.getElementById('course_select').innerHTML = html;

        var html2 = ' <select id="course_teach" onchange="" class="form-select form-select-sm" style="max-width: 20rem;" aria-label="Default select example"><option selected>เลือกวิชา</option>'
        let x = 0;
        for(list in datas){
            html2 += '<option value="'+datas[x].course+'">'+datas[x].name_course+'</option>'
            x +=1
        }
        html2 += '</select>'

        document.getElementById('course_list').innerHTML = html2;

    })
}
get_course()

function add_user(){
    var teacher_id = document.getElementById('teacher_id').value;
    var course_teach = document.getElementById('course_teach').value;
    var grade_teach = document.getElementById('grade_teach').value;
    var class_teach = document.getElementById('class_teach').value;
    var level = document.getElementById('teacher_level').value;


    if(teacher_id != '' && course_teach != '' && grade_teach != '' && class_teach != '' && level != ''){
        axios.post("/api/teacher.php",
            {
                    action: "add_teacher",
                    teacher_id: teacher_id,
                    course_teach: course_teach,
                    grade_teach: grade_teach,
                    class_teach: class_teach,
                    level: level
                    
            }
        ).then((res) => {
                var code = res.data.code;

                if(code === '200'){
                    Swal.fire({
                        icon: 'success',
                        title: 'คุณได้เพิ่มบุคลากรเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    get_data('all')
                }

                if(code === '400'){
                    Swal.fire({
                        icon: 'warning',
                        title: 'ให้บุคลากร login ใช้งาน chatbot ก่อน',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    get_data('all')
                }
                console.log(res)
            }
        )
    }else{
        Swal.fire({
            icon: 'error',
            title: 'กรอกข้อมูลให้ครบถ้วน',
            showConfirmButton: false,
            timer: 1500
        })
    }
}

function get_type(){
    let course = document.getElementById('coursetable_teacher').value;
    if(course === 'all'){
        get_data('all')
    }
    if(course != 'all'){
        get_data('course')
    }
}


function get_data(type){

    if(type == 'all'){
        axios.post("/api/teacher.php",
            {
                action: "getdata_for_dashboard",
                get_type: 'all',
            }
        ).then((res) => {
            var datas = res.data.data;
            console.log(datas)

            var table_row = '';
            let i = 0;
            for(list in datas){
                table_row += '<tr>';
                table_row += '<th scope="row">'+datas[i].user_id+'</th>';
                table_row += '<td>'+datas[i].course+'</td>';
                table_row += '<td>'+datas[i].teach_grade+'</td>';
                table_row += '<td>'+datas[i].teach_class+'</td>';
                table_row += '<td>'+datas[i].levels+'</td>';
                table_row += '<td><button type="button" class="btn btn-danger" onclick="remove_teacher('+datas[i].id+')">ลบบุคลากร</button></td>';
                table_row += '<tr>';

                i += 1;
            }
            document.getElementById('table_teacherdata').innerHTML = table_row;
        }
        )
    }
    if(type == 'course'){
        var course = document.getElementById('coursetable_teacher').value;
        axios.post("/api/teacher.php",
            {
                action: "getdata_for_dashboard",
                get_type: 'course',
                course_post: course,
            }
        ).then((res) => {
            var datas = res.data.data;
            console.log(datas)

            var table_row = ''
            let i = 0;
            for(list in datas){
                table_row += '<tr>';
                table_row += '<th scope="row">'+datas[i].user_id+'</th>';
                table_row += '<td>'+datas[i].course+'</td>';
                table_row += '<td>'+datas[i].teach_grade+'</td>';
                table_row += '<td>'+datas[i].teach_class+'</td>';
                table_row += '<td>'+datas[i].level+'</td>';
                table_row += '<td><button type="button" class="btn btn-danger" onclick="remove_teacher('+datas[i].id+')">ลบบุคลากร</button></td>';
                table_row += '<tr>';

                i += 1;
            }
            console.log(table_row)
            document.getElementById('table_teacherdata').innerHTML = table_row;
        }
        )
    }
}
get_data('all')

function remove_teacher(id){
    Swal.fire({
        title: 'ยืนยันที่จะลบ ผู้ใช้งาน หรือไม่?',
        text: "หากยืนยันแล้วไม่สามารถแก้ไขได้",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
      }).then((result) => {
        if (result.isConfirmed) {
            axios.post("/api/teacher.php",
                {
                    action: "remove_teacher",
                    id_linebot_teacher: id,
                }
            ).then(() => {
                    Swal.fire(
                        'ลบเสร็จ!',
                        'ผู้ใช้งานถูกลบเรียบร้อย.',
                        'success'
                    )
                    get_type()
                } 
            )
        }
      })
}
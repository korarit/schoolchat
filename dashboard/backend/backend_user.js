
function get_class(get_html, name_html){
    var grade = document.getElementById(get_html).value;

    console.log(grade)
    $.getJSON('https://sw127-chatbot.cf/config/class.json', function(data){
            var datas = data[grade];

            var html = '<select id="class_student" class="form-select form-select-sm" style="max-width: 10rem;" aria-label="Default select example"><option value="all" selected>ห้อง</option>';
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

function get_class2(get_html, name_html){
    var grade = document.getElementById(get_html).value;

    console.log(grade)
    $.getJSON('https://sw127-chatbot.cf/config/class.json', function(data){
            var datas = data[grade];

            var html = '<select id="classtable_student" class="form-select form-select-sm" style="max-width: 10rem;" aria-label="Default select example"><option value="all" selected>ห้อง</option>';
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

function add_user(){
    var type_user = document.getElementById('type_user').value;
    var user_id = document.getElementById('user_id').value;
    var card_id = document.getElementById('card_id').value;
    var name_user = document.getElementById('name_user').value;
    var lastname = document.getElementById('lastname').value;

    var grade_student = document.getElementById('grade_student').value;
    var class_student = document.getElementById('class_student').value;
    var phone_parent = document.getElementById('phone_parent').value;

    if(type_user != '' && user_id != '' && card_id != '' && name_user != '' && lastname != '' && grade_student != '' && class_student != ''){
        axios.post("/api/user.php",
            {
                    action: "add_user",
                    type_user: type_user,
                    user_id: user_id,
                    card_id: card_id,
                    name_user: name_user,
                    lastname: lastname,
                    grade_student: grade_student,
                    class_student: class_student,
                    phone_parent: phone_parent
            }
        ).then((res) => {
            Swal.fire({
                icon: 'success',
                title: 'คุณได้เพิ่ม ผู้ใช้งาน chatbot เรียบร้อย',
                showConfirmButton: false,
                timer: 1500
            })
            get_data('all')
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
    var grade = document.getElementById('gradetable_student').value;
    let class_student = document.getElementById('classtable_student').value;
    if(grade === 'all' && class_student === 'all'){
        get_data('all')
    }
    if(grade != 'all' && class_student === 'all'){
        get_data('grade')
    }
    if(grade != 'all' && class_student != 'all'){
        get_data('class')
    }
}


function get_data(type){

    if(type == 'all'){
        axios.post("/api/user.php",
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
                table_row += '<th scope="row">'+datas[i].type_user+'</th>';
                table_row += '<td>'+datas[i].user_id+'</td>';
                table_row += '<td>'+datas[i].name+'</td>';
                table_row += '<td>'+datas[i].lastname+'</td>';
                table_row += '<td>'+datas[i].phone_parent+'</td>';
                table_row += '<td>'+datas[i].grade+'</td>';
                table_row += '<td>'+datas[i].class+'</td>';
                table_row += '<td><button type="button" class="btn btn-danger" onclick="remove_user('+datas[i].id+')">ลบผู้ใช้งาน</button></td>';
                table_row += '<tr>';

                i += 1;
            }
            console.log(table_row)
            document.getElementById('table_datauser').innerHTML = table_row;
        }
        )
    }
    if(type == 'grade'){
        var grade = document.getElementById('gradetable_student').value;
        axios.post("/api/user.php",
            {
                action: "getdata_for_dashboard",
                get_type: 'grade',
                grade_post: grade,
            }
        ).then((res) => {
            var datas = res.data.data;
            console.log(datas)

            var table_row = ''
            let i = 0;
            for(list in datas){
                table_row += '<tr>';
                table_row += '<th scope="row">'+datas[i].type_user+'</th>';
                table_row += '<td>'+datas[i].user_id+'</td>';
                table_row += '<td>'+datas[i].name+'</td>';
                table_row += '<td>'+datas[i].lastname+'</td>';
                table_row += '<td>'+datas[i].phone_parent+'</td>';
                table_row += '<td>'+datas[i].grade+'</td>';
                table_row += '<td>'+datas[i].class+'</td>';
                table_row += '<td><button type="button" class="btn btn-danger" onclick="remove_user('+datas[i].id+')">ลบผู้ใช้งาน</button></td>';
                table_row += '<tr>';

                i += 1;
            }
            console.log(table_row)
            document.getElementById('table_datauser').innerHTML = table_row;
        }
        )
    }
    if(type == 'class'){
        
        let grade = document.getElementById('gradetable_student').value;
        let class_student = document.getElementById('classtable_student').value;
        axios.post("/api/user.php",
            {
                action: "getdata_for_dashboard",
                get_type: 'class',
                grade_post: grade,
                class_post: class_student,
            }
        ).then((res) => {
            var datas = res.data.data;

            console.log(datas)
            
            var table_row = '';
            let i = 0;
            for(list in datas){
                table_row += '<tr>';
                table_row += '<th scope="row">'+datas[i].type_user+'</th>';
                table_row += '<td>'+datas[i].user_id+'</td>';
                table_row += '<td>'+datas[i].name+'</td>';
                table_row += '<td>'+datas[i].lastname+'</td>';
                table_row += '<td>'+datas[i].phone_parent+'</td>';
                table_row += '<td>'+datas[i].grade+'</td>';
                table_row += '<td>'+datas[i].class+'</td>';
                table_row += '<td><button type="button" class="btn btn-danger" onclick="remove_user('+datas[i].id+')">ลบผู้ใช้งาน</button></td>';
                table_row += '<tr>';

                i += 1;
            }
            console.log(table_row)
            document.getElementById('table_datauser').innerHTML = table_row;
        }
        )
    }
}
get_data('all');

function remove_user(id){
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
            axios.post("/api/user.php",
                {
                    action: "remove_user",
                    id_linebot_user: id,
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
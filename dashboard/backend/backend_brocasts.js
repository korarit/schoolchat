const toBase64 = (file) => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
});
  

 function get_class(get_html, name_html){
    var grade = document.getElementById(get_html).value;

    console.log(grade)
    $.getJSON('https://sw127-chatbot.cf/config/class.json', function(data){
            var datas = data[grade];

            var html = '<label for="class_brocast" class="form-label">ห้อง</label>';
            html += '<select id="class_brocast" class="form-select form-select-sm" aria-label="Default select example"><option value="all" selected>ห้อง</option>';
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

function get_type_brocast(){
    var type_brocast = document.getElementById('type_brocast').value;

    if(type_brocast === 'text'){
        document.getElementById('html_brocast').innerHTML = '<label for="brocast_data" class="form-label">ข้อความ</label><textarea class="form-control" id="brocast_data" rows="3"></textarea>';
    }
    if(type_brocast === 'image'){
        document.getElementById('html_brocast').innerHTML = '<label for="brocast_data" class="form-label">รูปภาพ (ไม่เกิน 1MB)</label><input type="file" class="form-control" id="brocast_data" placeholder="name@example.com">';
    }
}

function get_brocast_recipient(){
    var grade_brocast = document.getElementById('grade_brocast').value;
    var class_brocast = document.getElementById('class_brocast').value;

    if(grade_brocast === 'all' && class_brocast === 'all' ){
        return 'all_send'
    }
    if(grade_brocast != 'all' && class_brocast === 'all'){
        return 'grade_send'
    }
    if(grade_brocast != 'all' && class_brocast != 'all'){
        return 'class_send'
    }
}

function confirm_addcourse(){
    var name_course_eng = document.getElementById('name_course_eng').value;
    var name_course_thai = document.getElementById('name_course_thai').value;
    var about_course = document.getElementById('about_course').value;
    var file_banner = document.getElementById('file_banner').files[0];

    if(name_course_eng != '' && name_course_thai != '' && about_course != '' && file_banner != ''){
        Swal.fire({
            title: 'ยืนยันที่เพิ่มกลุ่มสาระการเรียนรู้หรือไม่ หรือไม่?',
            text: "หากยืนยันแล้วไม่สามารถแก้ไขได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                add_course()
            }
        })
    }else{
        Swal.fire({
            icon: 'error',
            title: 'กรอกข้อมูลให้ครบถ้วน',
            showConfirmButton: false,
            timer: 1500
        })
    }
}

async function brocast_to_chat(){
    var grade_brocast = document.getElementById('grade_brocast').value;
    var class_brocast = document.getElementById('class_brocast').value;
    var type_brocast = document.getElementById('type_brocast').value;

    if(grade_brocast != '' && class_brocast != '' && type_brocast != ''){
        var brocast_recipient = get_brocast_recipient();
        if(type_brocast === 'text'){

            if(brocast_recipient === 'all_send'){
                var brocast_data = document.getElementById('brocast_data').value;
                axios.post("/api/brocasts.php",
                    {
                            action: "brocast_text",
                            type_brocast: 'all',
                            brocast_data: brocast_data
                    }
                ).then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'คุณได้เพิ่ม กลุ่มสาระการเรียนรู้ เรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        get_data()
                    }
                )
            }
            if(brocast_recipient === 'grade_send'){
                var brocast_data = document.getElementById('brocast_data').value;
                axios.post("/api/brocasts.php",
                    {
                            action: "brocast_text",
                            type_brocast: 'grade',
                            grade_brocast: grade_brocast,
                            brocast_data: brocast_data
                    }
                ).then((res) => {
                        var data = res.data
                        Swal.fire({
                            icon: 'success',
                            title: 'คุณได้เพิ่ม กลุ่มสาระการเรียนรู้ เรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log(data)
                        
                    }
                )
            }
            if(brocast_recipient === 'class_send'){
                var brocast_data = document.getElementById('brocast_data').value;
                axios.post("/api/brocasts.php",
                    {
                            action: "brocast_text",
                            type_brocast: 'class',
                            grade_brocast: grade_brocast,
                            class_brocast: class_brocast,
                            brocast_data: brocast_data
                    }
                ).then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'คุณได้เพิ่ม กลุ่มสาระการเรียนรู้ เรียบร้อย',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        get_data()
                    }
                )
            }
        }
        if(type_brocast === 'image'){
            var file = document.getElementById('brocast_data').files[0];

            var filedata = await toBase64(file);

            if(file.type == 'image/gif' || file.type == 'image/jpeg' || file.type == 'image/png' && file.size <= 1048576){
                var brocast_recipient = get_brocast_recipient();
                if(brocast_recipient === 'all_send'){
                    axios.post("/api/brocasts.php",
                        {
                            action: "brocast_image",
                            type_brocast: 'all',
                            file_name: file.name,
                            filedata: filedata
                        }
                    ).then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'คุณได้ brocast ข้อความ เรียบร้อย',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            get_data()
                        }
                    )
                }
                if(brocast_recipient === 'grade_send'){
                    axios.post("/api/brocasts.php",
                        {
                            action: "brocast_image",
                            type_brocast: 'grade',
                            grade_brocast: grade_brocast,
                            file_name: file.name,
                            filedata: filedata
                        }
                    ).then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'คุณได้ brocast ข้อความ เรียบร้อย',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            get_data()
                        }
                    )
                }
                if(brocast_recipient === 'class_send'){
                    axios.post("/api/brocasts.php",
                        {
                            action: "brocast_image",
                            type_brocast: 'grade',
                            grade_brocast: grade_brocast,
                            class_brocast: class_brocast,
                            file_name: file.name,
                            filedata: filedata
                        }
                    ).then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'คุณได้ brocast ข้อความ เรียบร้อย',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            get_data()
                        }
                    )
                }
            }else{
                Swal.fire(
                    'อัพโหลดเป็นไฟล์ภาพเท่านั้น',
                    'อัพโหลดเป็นไฟล์ภาพเท่านั้น',
                    'warning'
                  )
            }
        }
    }else{}
}


function get_data(){
    axios.post("/api/data.php",
        {
            action: "getdata_for_dashboard"
        }
    ).then((res) => {
        var datas = res.data.data;
        console.log(datas)

        var table_row = '';
        let i = 0;
        for(list in datas){
            table_row += '<tr>';
            table_row += '<th scope="row">'+datas[i].name_course+'</th>';
            table_row += '<td>'+datas[i].course+'</td>';
            table_row += '<td><button type="button" class="btn btn-primary" onclick="get_moredata('+datas[i].id+')">ข้อมูลเพิ่มเติม</button></td>';
            table_row += '<td><button type="button" class="btn btn-danger" onclick="remove_course('+datas[i].id+')">ลบกลุ่มสาระ</button></td>';
            table_row += '<tr>';

            i += 1;
        }
        console.log(table_row)
        document.getElementById('table_coursedata').innerHTML = table_row;
        }
    )
}
get_data();

function get_moredata(id){
    axios.post("/api/data.php",
            {
                    action: "get_data_byid",
                    id: id
            }
        ).then((res) => {
            var datas = res.data.data;
            Swal.fire({
                text: datas[0].about_course,
                imageUrl: datas[0].banner_course,
                imageAlt: '',
            })
            }
        )
}



function remove_course(id){
    Swal.fire({
        title: 'ยืนยันที่จะลบ กลุ่มสาระการเรียนรู้ หรือไม่?',
        text: "หากยืนยันแล้วไม่สามารถแก้ไขได้",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post("/api/data.php",
                {
                    action: "remove_course",
                    id: id,
                }
            ).then(() => {
                    Swal.fire(
                        'ลบเสร็จ!',
                        'ผู้ใช้งานถูกลบเรียบร้อย.',
                        'success'
                    )
                    get_data()
                } 
            )
        }
    })
}
const toBase64 = (file) => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });

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

async function add_course(){
    var name_course_eng = document.getElementById('name_course_eng').value;
    var name_course_thai = document.getElementById('name_course_thai').value;
    var about_course = document.getElementById('about_course').value;
    var file_banner = document.getElementById('file_banner').files[0];

    let file_banner_base64 = await toBase64(file_banner);

    if(name_course_eng != '' && name_course_thai != '' && about_course != '' && file_banner != ''){
        axios.post("/api/data.php",
            {
                    action: "add_course",
                    name_course_eng: name_course_eng,
                    name_course_thai: name_course_thai,
                    about_course: about_course,
                    file_banner_name: file_banner.name,
                    file_banner: file_banner_base64,
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
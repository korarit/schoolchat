function get_data(){
    axios.post("/api/data.php",
        {
            action: "getdata_for_dialogflow"
        }
    ).then((res) => {
        var datas = res.data.data;
        console.log(datas)

        var table_row = '';
        let i = 0;
        for(list in datas){
            table_row += '<tr>';
            table_row += '<th scope="row">'+datas[i].id+'</th>';
            table_row += '<td>'+datas[i].input_text+'</td>';
            table_row += '<td><button type="button" class="btn btn-primary" onclick="get_moredata('+"'"+datas[i].output_text+"'"+')">ข้อมูลเพิ่มเติม</button></td>';
            table_row += '<td><button type="button" class="btn btn-danger" onclick="remove_intent('+datas[i].id+')">ลบ</button></td>';
            table_row += '<tr>';

            i += 1;
        }
        console.log(table_row)
        document.getElementById('table_dialogflow').innerHTML = table_row;
        }
    )
}
get_data();

function get_moredata(output_text){
    Swal.fire({
        text: output_text,
    })
}



function remove_intent(id){
    Swal.fire({
        title: 'ยืนยันที่จะลบ intent หรือไม่?',
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
                    action: "remove_intent_dialogflow",
                    ids: id
                }
            ).then(() => {
                    Swal.fire(
                        'ลบเสร็จ!',
                        'ผู้ใช้งานถูกลบเรียบร้อย.',
                        'success'
                    )
                } 
            )
        }
    })
}
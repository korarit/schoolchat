const toBase64 = (file) => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
});

function confirm_add_dialogflow(){
    var name_intent = document.getElementById('name_intent').value;
    var input_intent = document.getElementById('input_intent').value;
    var output_intent = document.getElementById('output_intent').value;

    if(name_intent != '' && input_intent != '' && output_intent != ''){
        axios.post("/api/data.php",
            {
                action: "dialogflow_have_intent",
                name_intent: name_intent
        }).then((res) => {
            var data = res.data.data;

            //เช็คว่าชื่อ intent ซ้ำหรือไม่
            if(data === 'not_have'){
                Swal.fire({
                    title: 'ยืนยันที่เพิ่ม intent ใน dialogflow หรือไม่?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        add_dialogflow()
                    }
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'ชื่อ intent ซ้ำกัน',
                    showConfirmButton: false,
                    timer: 1500
                })
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

async function add_dialogflow(){
    var name_intent = document.getElementById('name_intent').value;
    var input_intent = document.getElementById('input_intent').value;
    var output_intent = document.getElementById('output_intent').value;

    if(name_intent != '' && input_intent != '' && output_intent != ''){

        axios.post("/api/data.php",
        {
            action: "add_intent_dialogflow",
            name_intent: name_intent,
            input_intent: input_intent,
            output_intent: output_intent
        }
        ).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'คุณได้เพิ่ม intent ใน dialogflow เรียบร้อย',
                showConfirmButton: false,
                timer: 1500
            })
            get_data()
            }
        )

    }else{}
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
                    action: "remove_intent",
                    id: id,
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
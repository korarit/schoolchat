const { createApp } = Vue;
const toBase64 = (file) => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = (error) => reject(error);
});

createApp({
  data() {
    return {
      logo_school: 'https://reg.thaischool.info/data/school/1064620379/profile/1064620379_normal.png',
      school: 'สวรรค์อนันต์วิทยา',
      type_user: 'aa'
    }
  },
  metainfo() {
    return {
      meta: [
        { charset: 'utf-8' }
            ]
    }
  },
  mounted(){
    const urlParams = new URLSearchParams(window.location.search);
    this.type_user = urlParams.get("type");

  }
}).mount('#leave_page');

async function main (){
  await liff.init({ liffId: "1657429942-XKdq3qkm" });

}
main();

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

function Check_OS (){
  if(liff.getOS() == "web") {
      swal.fire("กรุณาใช้ line โทรศัพท์มือถือ!", "ระบบทำมาสำหรับโทรศัพท์!", "error");
      liff.closeWindow();
  }
}

function upload_check(){
  var uploadField = document.getElementById("leave_file");
  if(uploadField.files[0].size > 10485760){
      swal.fire("กรุณาเลือกไฟล์ใหม่!", "ไฟล์ของคุณมีขนาดใหญ่เกินไป!", "warning");
      uploadField.value = "";
  }
}

function get_form(){
  Swal.fire({
    title: 'แจ้งลา?',
    text: "หากแจ้งลาแล้วไม่สามารถแก้ไขได้!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'แจ้งลา!',
    cancelButtonColor: 'ยกเลิก'
  }).then((result) => {
    if (result.isConfirmed) {
      liff.getProfile().then(profile => {
        getdata_student(profile.userId);
        console.log(profile.userId);
      }).catch((err) => {
        console.log("error", err);
      });
    }
  })
}

function getdata_student(line_user){
  axios.post("/api/user.php",
    {
          access_token: liff.getAccessToken(),
          action: "getdata_for_leave",
          line_userid: line_user
    }).then(response => {
      let data = response.data.data;

      let name = data[0].name;
      let lastname = data[0].lastname;
      let user_id = data[0].user_id;
      let grade = data[0].grade;
      let class_student = data[0].class;

      let type = document.getElementById("type_leave").value;
      let reason = document.getElementById("leave_reason").value;
      let start_date = document.getElementById("start_date").value;
      let end_date = document.getElementById("end_date").value;

      let file = document.getElementById("leave_file").value;

      let filedata = document.getElementById("leave_file").files[0];

      if(type != '' && reason != '' && file != '' && start_date != '' && end_date != ''){
        if(filedata.type == 'image/gif' || filedata.type == 'image/jpeg' || filedata.type == 'image/png' || filedata.type == 'image/tiff' || filedata.type == 'image/svg'){
        leave_add(line_user, user_id, grade, class_student, type, reason, start_date, end_date, name, lastname);
        }else{
          swal.fire("กรุณาใช้หลักฐานไฟล์ภาพเท่านั้น!", "หลักฐานต้องเป็นประเภท ไฟล์ภาพเท่านั้น เช่น png / jpg / gif", "warning")
        }
      }else{
        Swal.fire("กรอกข้อมูลให้ครบถ้วน!", "ยังเหลือข้อมูลที่ต้องกรอกอีกนะ!", "warning");
      }

      console.log(data)
    }
  )
}

async function leave_add(line_user, student_id, grade, class_student,type, reason, start_date, end_date, name, lastname){
  let file = document.getElementById("leave_file").files[0];
  let fileData = await toBase64(file);

  if(type != '' && reason != '' && file != ''){
      axios.post("/api/leave.php",
      {
          access_token: liff.getAccessToken(),
          action: "ลา",
          userid: student_id,
          line_userid: line_user,
          name: name+' '+lastname,
          type_leave: type,
          reason_leave: reason,
          start_date: start_date,
          end_date: end_date,
          grade_student: grade,
          class_student: class_student,
          file_name: file.name,
          file: fileData

      }).then(
        Swal.fire({
          icon: 'success',
          title: 'คุณได้แจ้งลา!',
          text: 'คุณได้ทำการแจ้งลาเรียบร้อย ขอให้โชคดี',
          showConfirmButton: false,
          timer: 1500
        }).then()
      )
  }else{
    swal.fire("กรุณากรอกข้อมูลให้ครบถ้วน!", "กรุณากรอกข้อมูลให้ครบถ้วน เพื่อใช้ในการแจ้งลา!", "warning");
  }
}

function create_table(){
  let grade_student = document.getElementById("grade_student").value;
  let class_student = document.getElementById("class_student").value;

  var table = document.getElementById("tableleave_student");

  var rowCount = table.rows.length;
  if(rowCount != 1){
    for (var x=rowCount-1; x>0; x--) {
      table.deleteRow(x);
      console.log(x)
    }
  }


  axios.post("/api/leave.php",
    {
          access_token: liff.getAccessToken(),
          action: "get_leave_student",
          grade: grade_student,
          class: class_student

    }).then(response => {
        var tables = document.getElementById("tableleave_student");
        var data = response.data.data;
        var date_now = moment().format("x");
        
        console.log(date_now);
        let count = 0
        for(let i = 0; i < data.length;i++){
          let end_date = moment(data[i].end_date).format("x");
          console.log(end_date);

        if(date_now <= moment(data[i].end_date).format("x")){
            var row = tables.insertRow(count+1);

            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            cell1.innerHTML = i+1;
            cell2.innerHTML = data[i].name;
            cell3.innerHTML = 'ม.'+data[i].grade;
            cell4.innerHTML = data[i].class;

            cell5.innerHTML = "<button type='button' class='btn btn-outline-primary' onclick='get_moredata("+data[i].id+")'>ข้อมูล</button>";

            count +=1
          }
        }
        //console.log(data);
      }
    )
  //console.log('aaaaa'+grade_student);
}

function get_moredata(id){
  axios.post("/api/leave.php",
    {
          access_token: liff.getAccessToken(),
          action: "get_byid",
          id_leave: id

    }).then(response => {
          var data = response.data.data;

          

          Swal.fire({
            title: 'ข้อมูลเพิ่มเติม',
            imageUrl: data[0].premise,
            imageHeight: 300,
            html:
            '<div class="d-flex justify-content-center"><p style="text-align: left;">ชื่อ - นามสกุล : '+data[0].name+
            '<br>ชั้น ม.'+data[0].grade+'/'+data[0].class+
            '<br>เหตุผล : '+data[0].reason+
            '<br>ลาวันที่ '+data[0].start_date.split("-").reverse().join("-")+' ถึงวันที่ '+data[0].end_date.split("-").reverse().join("-")+
            '</p></div>'
          })
          console.log(data)
      })
}
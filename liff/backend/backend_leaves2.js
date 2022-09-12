const toBase64 = (file) => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = (error) => reject(error);
});

async function main (){
  await liff.init({ liffId: "1657429942-XKdq3qkm" });

}
main();

function Check_OS (){
  if(liff.getOS() == "web") {
      swal("กรุณาใช้ line โทรศัพท์มือถือ!", "ระบบทำมาสำหรับโทรศัพท์!", "error");
      liff.closeWindow();
  }
}

function upload_check(){
  var uploadField = document.getElementById("leave_file");
  if(uploadField.files[0].size > 10485760){
      swal("กรุณาเลือกไฟล์ใหม่!", "ไฟล์ของคุณมีขนาดใหญ่เกินไป!", "warning");
      uploadField.value = "";
  }
}

function get_form(){
  liff.getProfile().then(profile => {
      getdata_student(profile.userId);
      console.log(profile.userId);
  }).catch((err) => {
      console.log("error", err);
  });
}

function getdata_student(line_user){
  axios.post("/api/user.php",
    {
          action: "getuser_data",
          line_userid: line_user
    }).then(response => {
      let data = response.data;
      let user_id = data.user_id;

      let type = document.getElementById("type_leave").value;
      let reason = document.getElementById("leave_reason").value;
      let file = document.getElementById("leave_file").value;

      if(type != '' && reason != '' && file != ''){
        leave_add(line_user, user_id, type, reason);
      }else{
        swal("กรอกข้อมูลให้ครบถ้วน!", "ยังเหลือข้อมูลที่ต้องกรอกอีกนะ!", "warning");
      }
    }
  )
}

async function leave_add(line_user, student_id, type, reason){
  let file = document.getElementById("leave_file").files[0];
  let fileData = await toBase64(file);

  if(type != '' && reason != '' && file != ''){
      axios.post("/api/leave.php",
      {
          action: "ลา",
          userid: student_id,
          line_userid: line_user,
          type_leave: type,
          reason_leave: reason,
          file_name: file.name,
          file: fileData

      })
  }else{
    swal("กรุณากรอกข้อมูลให้ครบถ้วน!", "กรุณากรอกข้อมูลให้ครบถ้วน เพื่อใช้ในการแจ้งลา!", "warning");
  }
}

function abc(){
  let grade_student = document.getElementById("grade_student").value;
  console.log('aaaaa'+grade_student);
}

function create_table(){
  let grade_student = document.getElementById("grade_student").value;
  let class_student = document.getElementById("class_student").value;

  let table = document.getElementById("tableleave_student");


  axios.post("/api/leave.php",
      {
          action: "get_leave_student",
          grade: grade_student,
          class: class_student

      }).then((res) => {
        console.log(res);
      }
      );
  console.log('aaaaa'+grade_student);
}
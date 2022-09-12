const { createApp } = Vue;
const toBase64 = (file) => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = (error) => reject(error);
});

async function main (){
  await liff.init({ liffId: "1657429942-BxZMoMgJ" });

}
main();

createApp({
  setup(){
    const alert_more = (file, file_type, data) => {
      if(file_type == 'youtube'){
        Swal.fire({
          html: '<div class="d-flex justify-content-center"><div class="ratio ratio-16x9"><iframe width="560" height="315" src="'+file+'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div>'+
          '<div style="height: 2rem"></div>'+
          '<div class="d-flex justify-content-center"><p style="text-align: left;">'+data+'</p></div>',
          imageWidth: 1000,
          imageHeight: 600,
          imageAlt: 'Custom image',
        })
      }
      if(file_type == 'file'){
        Swal.fire({
          html: '<div class="d-flex justify-content-center"><p style="text-align: left;">'+data+'</p></div>',
          imageUrl: file,
          imageAlt: 'Custom image',
        })
      }
      if(file_type == 'pdf'){
        Swal.fire({
          html: '<div class="d-flex justify-content-center"><div class="ratio ratio-1x1">'+
          '<object width="100%" height="600" data="'+file+'" type="application/pdf" frameborder="0" allow="autoplay;" allowfullscreen><h5>ไม่รองรับการแสดงผลไฟล์ PDF</5><a href="'+file+'" class="btn btn-success btn-lg">ดาวน์โหลดไฟล์ PDF</a></object></div></div>'+
          '<div style="height: 2rem"></div>'+
          '<p style="text-align: left;">'+data+'</p></div>',
          imageWidth: 400,
          imageHeight: 800,
          imageAlt: 'Custom image',
        })
      }
      if(file_type == 'drive'){
        Swal.fire({
          html: '<div class="d-flex justify-content-center"><p style="text-align: left;">'+data+'</p></div>',
          imageWidth: 400,
          imageHeight: 200,
          imageAlt: 'Custom image',
        })
      }
    }
    return { 
      alert_more
    }
  },
  data() {
    return {
      logo_school: 'https://reg.thaischool.info/data/school/1064620379/profile/1064620379_normal.png',
      school: 'สวรรค์อนันต์วิทยา',
      datass: '',
      count_data: '',
      type_user: 'student',
      moment: moment
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
    var subject = urlParams.get("subject");
    var grade = urlParams.get("grade");
    var class_student = urlParams.get("class");
    var type_user = urlParams.get("type");

    console.log(urlParams)
    if(type_user === 'teacher'){
      var lineid = urlParams.get("line_id");
      axios.post("/api/media.php",
          {
              action: "get_data_by_lineid",
              lineid: lineid
          }
      ).then(res => {
          var data = res.data.data;
          var count_data = res.data.count_data;
          this.datass = data;
          this.count_data = count_data;

          this.type_user = type_user;
          console.log(res.data)
          console.log("bbb"+count_data)
        }
      )
    }else{
      axios.post("/api/media.php",
          {
              action: "get_data",
              course_post: subject,
              grade_post: grade,
              class_student: class_student
          }
      ).then(res => {
          var data = res.data.data;
          var count_data = res.data.count_data;
          this.datass = data;
          this.count_data = count_data;

          this.type_user = type_user;
          console.log(res.data)
          console.log("aaa"+count_data)
        }
      )
    }

  }
}).mount('#media_index');

function Check_OS (){
  if(liff.getOS() == "web") {
      swal("กรุณาใช้ line โทรศัพท์มือถือ!", "ระบบทำมาสำหรับโทรศัพท์!", "error");
      liff.closeWindow();
  }
}
function update_inputclass(){
  var type_file = document.getElementById("type_file").value;
  document.getElementById("input_data_flie").innerHTML = '<label for="data_file" class="form-label">ไฟล์ข้อมูล (ไฟล์ไม่เกิน 20MB)</label><input onchange="upload_check2()" class="form-control" type="text" id="data_file">';
  
}

function update_input(){
  var type_file = document.getElementById("type_file").value;
  if(type_file == 'youtube'){
    document.getElementById("input_data_flie").innerHTML = '<label for="data_file" class="form-label">ลิ้งคลิป Youtube</label><input class="form-control" type="text" id="data_file">';
  }
  if(type_file == 'image'){
    document.getElementById("input_data_flie").innerHTML = '<label for="data_file" class="form-label">ไฟล์รูป (ไฟล์ไม่เกิน 20MB)</label><input onchange="upload_check2()" class="form-control" type="file" id="data_file">';
  }
  if(type_file == 'pdf'){
    document.getElementById("input_data_flie").innerHTML = '<label for="data_file" class="form-label">ไฟล์ pdf (ไฟล์ไม่เกิน 20MB)</label><input onchange="upload_check2()" class="form-control" type="file" id="data_file">';
  }
  if(type_file == 'drive'){
    document.getElementById("input_data_flie").innerHTML = '<label for="data_file" class="form-label">ลิ้ง google drive</label><input class="form-control" type="text" id="data_file">';
  }
  
}

function upload_check1(){
  var uploadField = document.getElementById("show_file");
  if(uploadField.files[0].size > 10485760){
      swal.fire("กรุณาเลือกไฟล์ใหม่!", "ไฟล์ของคุณมีขนาดใหญ่เกินไป!", "warning");
      uploadField.value = "";
  }
}
function upload_check2(){
  var type_file = document.getElementById("type_file").value;
  var uploadField = document.getElementById("data_file");
  
  if(type_file == 2){
    if(uploadField.files[0].size > 20971520){
        swal.fire("กรุณาเลือกไฟล์ใหม่!", "ไฟล์ของคุณมีขนาดใหญ่เกินไป!", "warning");
        uploadField.value = "";
    }
  }
}

function get_form(){
  Swal.fire({
    title: 'ยืนยันโพสต์สื่อการสอน?',
    text: "หากโพสต์แล้วไม่สามารถแก้ไขได้!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'โพสต์!'
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
  const urlParams = new URLSearchParams(window.location.search);
  axios.post("/api/user.php",
    {
          access_token: liff.getAccessToken(),
          action: "getdata_for_media",
          line_userid: line_user
    }).then(response => {
      let data = response.data.data;

      let name = data[0].name;
      let lastname = data[0].lastname;
      let post_by = name+' '+lastname;

      let course = urlParams.get("subject");

      let grade = document.getElementById("grade_select").value;
      let class_student = document.getElementById("grade_select").value;

      let title = document.getElementById("title_media").value;
      let data_media = document.getElementById("data_media").value;

      var type_file = document.getElementById("type_file").value;

      let preview = document.getElementById("show_file").value;
      let data_file = document.getElementById("data_file").value;

      let filedata_show = document.getElementById("show_file").files[0];

      if(title != '' && data_media != '' && show_file != '' && data_file != '' && preview != ''){
        if(filedata_show.type == 'image/gif' || filedata_show.type == 'image/jpeg' || filedata_show.type == 'image/png' || filedata_show.type == 'image/tiff' || filedata_show.type == 'image/svg'){
          
          //ถ้าเป็น คลิป youtube
          if(type_file == 'youtube'){
            post_media(course, grade, class_student, title, data_media, filedata_show.name, data_file, 'youtube',post_by, line_user);
          }
          //ถ้าเป็น ไฟล์ pdf or รูป
          if(type_file == 'image'){
            let filedata_data = document.getElementById("data_file").files[0];
            if(filedata_data.type == 'image/gif' || filedata_data.type == 'image/jpeg' || filedata_data.type == 'image/png' || filedata_data.type == 'image/tiff' || filedata_data.type == 'image/svg'){
              post_media(course, grade, class_student, title, data_media, filedata_show.name, filedata_data.name, 'file', post_by, line_user);
            }else{
              swal.fire("อัพโหลดเป็นไฟล์ภาพเท่านั้น!", "ต้องเป็นไฟล์ภาพเท่านั้น เช่น png / jpg / gif", "warning")
            }
          }
          if(type_file == 'pdf'){
            let filedata_data = document.getElementById("data_file").files[0];
            if(filedata_data.type == 'application/pdf'){
              post_media(course, grade, class_student, title, data_media, filedata_show.name, filedata_data.name, 'pdf', post_by, line_user);
            }else{
              swal.fire("อัพโหลดเป็นไฟล์ pdf เท่านั้น!", "ต้องเป็นไฟล์ pdf เท่านั้น", "warning")
            }
          }
          //ถ้าเป็น google drive
          if(type_file == 'drive'){
            post_media(course, grade, class_student, title, data_media, filedata_show.name, data_file, 'drive', post_by, line_user);
          }
          
        }else{
          swal.fire("กรุณาไฟล์ตัวอย่างเป็นภาพเท่านั้น!", "ตัวอย่างต้องเป็นไฟล์ภาพเท่านั้น เช่น png / jpg / gif", "warning")
        }
      }else{
        Swal.fire("กรอกข้อมูลให้ครบถ้วน!", "ยังเหลือข้อมูลที่ต้องกรอกอีกนะ!", "warning");
      }

      console.log(data)
    }
  )
}

async function post_media(course, grade, class_student, title, data_media, file_preview, file_media, type_file, post_by, line_user){
  let file_show = document.getElementById("show_file").files[0];
  let fileData_show = await toBase64(file_show);

    if(type_file == 'youtube'){
      axios.post("/api/media.php",
      {
            access_token: liff.getAccessToken(),
            action: "postmedia_not_upload",
            post_course: course,
            grade: grade,
            class_student: class_student,
            post_title: title,
            post_data: data_media,
            file_show: file_preview,
            post_image: fileData_show,
            file_data: file_media,
            type_file: type_file,
            post_by: post_by,
            line_userid: line_user

      }).then(
        Swal.fire({
          icon: 'success',
          title: 'สื่อการสอนถูกโพสค์แล้ว!',
          text: 'คุณโพสต์ สื่อการสอนสำเร็จแล้ว',
          showConfirmButton: false,
          timer: 1500
        }).then()
      )
    }

    if(type_file == 'file'){
      let file_data = document.getElementById("data_file").files[0];
      let fileData_data = await toBase64(file_data);
      axios.post("/api/media.php",
      {
            access_token: liff.getAccessToken(),
            action: "postmedia_upload",
            post_course: course,
            grade: grade,
            class_student: class_student,
            post_title: title,
            post_data: data_media,
            file_show: file_preview,
            filename_data: file_media,
            post_image: fileData_show,
            data_file: fileData_data,
            type_file: type_file,
            post_by: post_by,
            line_userid: line_user

      }).then(
        Swal.fire({
          icon: 'success',
          title: 'สื่อการสอนถูกโพสค์แล้ว!',
          text: 'คุณโพสต์ สื่อการสอนสำเร็จแล้ว',
          showConfirmButton: false,
          timer: 1500
        }).then()
      )
    }

    if(type_file == 'drive'){
      axios.post("/api/media.php",
      {
            access_token: liff.getAccessToken(),
            action: "postmedia_not_upload",
            post_course: course,
            grade: grade,
            class_student: class_student,
            post_title: title,
            post_data: data_media,
            file_show: file_preview,
            file_data: file_media,
            post_image: fileData_show,
            type_file: type_file,
            post_by: post_by,
            line_userid: line_user

      }).then(() => {
        Swal.fire({
          icon: 'success',
          title: 'สื่อการสอนถูกโพสค์แล้ว!',
          text: 'คุณโพสต์ สื่อการสอนสำเร็จแล้ว',
          showConfirmButton: false,
          timer: 1500
        }).then()
      }
      )
    }
}
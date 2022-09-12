const { createApp } = Vue;
const toBase64 = (file) => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = (error) => reject(error);
});
async function main (){
  await liff.init({ liffId: "1657429942-9NqWgW4a" });
}
main();

createApp({
  setup(){
    const alert_more = (image, data) => {
      Swal.fire({
        html: '<div class="d-flex justify-content-center"><p style="text-align: left;">'+data+'</p></div>',
        imageUrl: image,
    })
    console.log(data)
    }
    return { 
      alert_more
    }  
  },
  data() { 
    return {
      logo_school: 'https://reg.thaischool.info/data/school/1064620379/profile/1064620379_normal.png',
      school: 'สวรรค์อนันต์วิทยา',
      count_data: '',
      datas: '',
      type_user: 'student',
      moment: moment,
    }
  },
  methods: {
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
    console.log(urlParams)
    axios.post("/api/board.php",
        {
            action: "get_data",
            course: subject
        }
    ).then(res => {
        var data = res.data.data;
        var count_data = res.data.count_data;
        this.datas = data;
        this.count_data = count_data;

        this.type_user = urlParams.get("type");
        console.log(res)
      }
    )

  }
}).mount('#board_index');

function Check_OS (){
  if(liff.getOS() == "web") {
      swal.fire("กรุณาใช้ line โทรศัพท์มือถือ!", "ระบบทำมาสำหรับโทรศัพท์!", "error");
      liff.closeWindow();
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
  var uploadField = document.getElementById("data_file");
  if(uploadField.files[0].size > 20971520){
      swal.fire("กรุณาเลือกไฟล์ใหม่!", "ไฟล์ของคุณมีขนาดใหญ่เกินไป!", "warning");
      uploadField.value = "";
  }
}

function get_form(){
  Swal.fire({
    title: 'ยืนยันโพสต์ข่าวประชาสัมพันธ์?',
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
          action: "getdata_for_leave",
          line_userid: line_user
    }).then(response => {
      let data = response.data.data;

      let name = data[0].name;
      let lastname = data[0].lastname;
      let post_by = name+' '+lastname;

      let course = urlParams.get("subject");

      let title = document.getElementById("title_board").value;
      let data_board = document.getElementById("data_board").value;

      let preview = document.getElementById("show_file").value;
      let data_file = document.getElementById("data_file").value;

      let filedata_show = document.getElementById("show_file").files[0];
      let filedata_data = document.getElementById("data_file").files[0];

      if(title != '' && data_board != '' && show_file != '' && data_file != '' && preview != ''){
        if(filedata_show.type == 'image/gif' || filedata_show.type == 'image/jpeg' || filedata_show.type == 'image/png' || filedata_show.type == 'image/tiff' || filedata_show.type == 'image/svg'){
          post_board(course, title, data_board, filedata_show.name, filedata_data.name, post_by, line_user);
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

async function post_board(course, title, data_board, filename_show, filename_data, post_by, line_user){
  let file_show = document.getElementById("show_file").files[0];
  let file_data = document.getElementById("data_file").files[0];
  
  let fileData_show = await toBase64(file_show);
  let fileData_data = await toBase64(file_data);

    axios.post("/api/board.php",
    {
          access_token: liff.getAccessToken(),
          action: "post_board",
          post_course: course,
          post_title: title,
          post_data: data_board,
          filename_show: filename_show,
          filename_data: filename_data,
          post_image: fileData_show,
          data_file: fileData_data,
          post_by: post_by,
          line_userid: line_user

  }).then(
    Swal.fire({
      icon: 'success',
      title: 'ข่าวประชาสัมพันธ์โพสค์แล้ว!',
      text: 'คุณโพสต์ ข่าวประชาสัมพันธ์สำเร็จแล้ว',
      showConfirmButton: false,
      timer: 1500
    }).then()
  )
}
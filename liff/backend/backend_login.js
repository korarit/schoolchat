const { createApp } = Vue;
const { userAgent } = navigator;

//process หน้าปก
createApp({
    data() {
        return {
            logo_school: 'https://i.imgur.com/psvqjpg.jpg',
            school: 'สวรรค์อนันต์วิทยา'
        }
    },
    metainfo(){
        return {
            meta: [
                { charset: 'utf-8' }
            ]
        }
    }
}).mount('#index_page');

async function main (){
    await liff.init({ liffId: "1657429942-qJwaQa7j" });

}
main();

function Check_verion_webview (){
    if (userAgent.includes('Firefox/')) {
        var FFVersion = userAgent.substring(userAgent.indexOf("Firefox")).split("/")[1];
        var Version = FFVersion.split(" ")[0];
        if (Version < '105.0.5195.68'){

        }
        //console.log(userAgent)
    } else if (userAgent.includes('Edg/')) {
        var FFVersion = userAgent.substring(userAgent.indexOf("Edg")).split("/")[1];
        var Version = FFVersion.split(" ")[0];
        if (Version < '105.0.5195.68'){

        }
        //console.log(userAgent)
    } else if (userAgent.includes('Chrome/')) {
        var FFVersion = userAgent.substring(userAgent.indexOf("Chrome")).split("/")[1];
        var Version = FFVersion.split(" ")[0];
        if (Version < '105.0.5195.68'){
            Swal.fire("กรุณาอัพเดต Android Webview!", "เพื่อในการใช้งานให้ไม่เกิดปัญหา!", "warning");
        }
        console.log(Version)
    } else if (userAgent.includes('Safari/')) {
        var FFVersion = userAgent.substring(userAgent.indexOf("Chrome")).split("/")[1];
        var Version = FFVersion.split(" ")[0];
        if (Version < '105.0.5195.68'){
            Swal.fire("กรุณาอัพเดต Safari!", "เพื่อในการใช้งานให้ไม่เกิดปัญหา!", "warning");
        }
    }
    console.log(userAgent)
}

function Check_OS (){
    if(liff.getOS() == "web") {
        Swal.fire("กรุณาใช้ line โทรศัพท์มือถือ!", "ระบบทำมาสำหรับโทรศัพท์!", "error");
        liff.closeWindow();
    }
}

function get_form(){
    Swal.fire({
      title: 'ยืนยัน เข้าสู่ระบบ?',
      text: "หากเข้าสู่ระบบแล้วไม่สามารถออกได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'เข้าสู่ระบบ!',
      cancelButtonText: 'ยกเลิก'
    }).then((result) => {
      if (result.isConfirmed) {
  
        liff.getProfile().then(profile => {
            document.getElementById("line_user").value = profile.userId;
            get_forms(profile.userId);
            console.log(profile.userId);
        }).catch((err) => {
            console.log("error", err);
        });
      }
    })
}

function get_forms(line_user) {
    let student_id = document.getElementById("studentID").value;
    let card_id = document.getElementById("cardID").value;

    const name = null;

    axios.post("/api/user.php",
        {
            access_token: liff.getAccessToken(),
            action: "student_register",
            userid: student_id,
            card_id: card_id,
            line_userid: line_user
        }
    ).then(response => {
            if(response.data.data == 'register_success'){
                liff.sendMessages([{
                    type: "text",
                    text: "สมัครใช้ chatbot : " + student_id
                }]).then();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'เข้าสู่ระบบไม่สำเร็จ!',
                    text: 'ตรวจสอบ เลขประจำตัวนักเรียน/ครู หรือ เลขประจำตัวประชาชนอีกครั้ง',
                    showConfirmButton: false,
                    timer: 1500
                  }).then()
            }
            //console.log(response.data)
    }
    )
}

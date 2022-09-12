<?php
session_start();

if (!$_SESSION["Login_dashboard"]){  //check session

  Header("Location: login.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

}else{
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Dashboard · Chatbot</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sidebars/">

  <!-- bootstrap 5.3-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>

  <!-- axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <!-- alert-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Custom styles for this template -->
  <link href="css/sidebars.css" rel="stylesheet">

  <!-- my script -->
  <script src="backend/backend_course.js"></script>
</head>

<body>
  <div class="d-flex flex-nowrap">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Dashboard</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="index.php" class="nav-link text-white">
            ภาพรวม
          </a>
        </li>
        <li class="nav-item">
          <a href="user.php" class="nav-link text-white" aria-current="page">
            จัดการผู้ใช้งาน
          </a>
        </li>
        <li class="nav-item">
          <a href="teacher.php" class="nav-link text-white" aria-current="page">
            จัดการบุคลากร
          </a>
        </li>
        <li class="nav-item">
          <a href="course.php" class="nav-link active">
            จัดการกลุ่มสาระ
          </a>
        </li>
        <li class="nav-item">
          <a href="brocasts.php" class="nav-link text-white">
            ประกาศ
          </a>
        </li>
        <li class="nav-item">
          <a href="dialogflow.php" class="nav-link text-white">
            Dialogflow
          </a>
        </li>
      </ul>
      <hr>
      <div>
        <a href="logouts.php" class="d-flex align-items-center text-white text-decoration-none">
          <strong>ออกจากระบบ</strong>
        </a>
      </div>
    </div>

    <div class="b-example-divider b-example-vr"></div>
    <div class="d-flex flex-column flex-shrink-0" style="width: 100rem;max-height: 50rem;">
      <div style="height: 1rem;"></div>
        <h4>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;จัดการกลุ่มสาระการเรียนรู้</h4>
        <hr>

        <!-- input user data-->
        <div class="d-flex justify-content-center">

          <div class="card text-bg-light"  style="width: 60rem;">
            <div class="card-body">
                <div style="height: 1.5rem"></div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" id="name_course_thai" placeholder="ชื่อวิชาภาษาไทย">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" id="name_course_eng" placeholder="ชื่อวิชาภาษาอังกฤษ">
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="about_course" class="form-label">เกี่ยววิชา</label>
                  <textarea type="text" class="form-control" id="about_course" rows="6"></textarea>
                </div>
                <div class="mb-3">
                  <label for="file_banner" class="form-label">รูปปกกลุ่มสาระการเรียนรู้</label>
                  <input type="file" class="form-control" id="file_banner">
                </div>
                <div class="mb-3">
                  <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-info" onclick="confirm_addcourse()">เพิ่มกลุ่มสาระ</button>
                  </div>
                </div>
            </div>
          </div>

       </div>
       <div style="height: 2rem;"></div>
       <!-- table userdata-->
       <div class="d-flex justify-content-center">
        <div style="width: 60rem;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 15rem;">ชื่อวิชาภาษาไทย</th>
              <th style="width: 15rem;">ชื่อวิชาภาษาอังกฤษ</th>
              <th style="width: 15rem;">ข้อมูลเพิ่มเติม</th>
              <th>ลบกลุ่มสาระ</th>
            </tr>
          </thead>
          <tbody id="table_coursedata">
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td><button type="button" class="btn btn-primary">ข้อมูลเพิ่มเติม</button></td>
              <td><button type="button" class="btn btn-danger">ลบกลุ่มสาระ</button></td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td><button type="button" class="btn btn-primary">ข้อมูลเพิ่มเติม</button></td>
              <td><button type="button" class="btn btn-danger">ลบกลุ่มสาระ</button></td>
            </tr>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td><button type="button" class="btn btn-primary">ข้อมูลเพิ่มเติม</button></td>
              <td><button type="button" class="btn btn-danger">ลบกลุ่มสาระ</button></td>
            </tr>
          </tbody>
        </table>
        </div>
       </div>
    </div>
  </div>
  <script src="js/sidebars.js"></script>
</body>

</html>
<?php
}
?>
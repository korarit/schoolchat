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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- my script -->
  <script src="backend/backend_user.js"></script>
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
          <a href="user.php" class="nav-link active" aria-current="page">
            จัดการผู้ใช้งาน
          </a>
        </li>
        <li class="nav-item">
          <a href="teacher.php" class="nav-link text-white" aria-current="page">
            จัดการบุคลากร
          </a>
        </li>
        <li class="nav-item">
          <a href="course.php" class="nav-link text-white">
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
      <h4>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;จัดการผู้ใช้ chatbot</h4>
      <hr>

      <!-- input user data-->
      <div class="d-flex justify-content-center">

        <div class="card text-bg-light mb-3" style="width: 82rem;">
          <div class="card-body">
            <div class="mb-3">
              <div style="height: 1.5rem"></div>
              <div>
                  <div class="row">
                    <div class="col-auto" style="width: 8rem">
                      <select id="type_user" class="form-select form-select-sm" style="max-width: 7rem;"
                        aria-label="Default select example">
                        <option selected>ประเภท</option>
                        <option value="student">นักเรียน</option>
                        <option value="teacher">ครู</option>
                      </select>
                    </div>
                    <div class="col-auto" style="width: 8rem">
                      <input type="text" class="form-control form-control-sm" id="user_id"
                        placeholder="รหัสนักเรียน/ครู">
                    </div>
                    <div class="col-auto" style="width: 10rem">
                      <input type="text" class="form-control form-control-sm" id="card_id"
                        placeholder="รหัสบัตรประชาชน">
                    </div>
                    <div class="col-auto" style="width: 10rem">
                      <input type="text" class="form-control form-control-sm" id="phone_parent"
                        placeholder="เบอร์โทรศัทพ์ ผู้ปกครอง">
                    </div>
                  <div class="col">
                    <input type="text" class="form-control form-control-sm" id="name_user"
                      placeholder="ชื่อจริง">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control form-control-sm" id="lastname"
                      placeholder="นามสกุล">
                  </div>
                  <div class="col-auto">
                    <select id="grade_student" onchange="get_class('grade_student','class_select')" class="form-select form-select-sm" aria-label="Default select example">
                      <option selected>ชั้น</option>
                      <option value="1">ม.1</option>
                      <option value="2">ม.2</option>
                      <option value="3">ม.3</option>
                      <option value="4">ม.4</option>
                      <option value="5">ม.5</option>
                      <option value="6">ม.6</option>
                    </select>
                  </div>
                  <div class="col-auto" id="class_select">
                    <select id="class_student" class="form-select form-select-sm"
                      aria-label="Default select example" disabled>
                      <option selected>ห้อง</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                  </div>
                  <div class="col-auto">
                    <button class="btn btn-warning" onclick="add_user()">เพิ่มข้อมูล</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div style="height: 1rem;"></div>

      <!-- userdata -->
      <div class="d-flex justify-content-center">
        <div class="card text-bg-light mb-3" style="width: 82rem;">
          <div class="card-body">

            <div class="d-flex justify-content-end">
              <div class="row">
                <div class="col">
                  <select id="gradetable_student" onchange="get_class2('gradetable_student','tableclass_select')" class="form-select form-select-sm"
                      style="max-width: 10rem;" aria-label="Default select example">
                      <option value="all" selected>ชั้น</option>
                      <option value="1">ม.1</option>
                      <option value="2">ม.2</option>
                      <option value="3">ม.3</option>
                      <option value="4">ม.4</option>
                      <option value="5">ม.5</option>
                      <option value="6">ม.6</option>
                    </select>
                </div>
                <div class="col" style="width: 15rem;"id="tableclass_select">
                  <select id="classtable_student" class="form-select form-select-sm" style="max-width: 10rem;"
                    aria-label="Default select example" disabled>
                    <option selected>ห้อง</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="col">
                  <div class="d-grid gap-2">
                    <button type="button" onclick="get_type()"class="btn btn-primary btn-sm">ค้นหา</button>
                  </div>
                </div>
                <div style="width: 3rem;"></div>
              </div>
            </div>

            <div style="height: 1.5rem;"></div>
            <!-- table userdata -->
            <div class="d-flex justify-content-center">
              <div style="width: 75rem;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 6rem;">ประเภท</th>
                      <th style="width: 10rem;">รหัสประจำตัว</th>
                      <th style="width: 14rem;">ชื่อ</th>
                      <th style="width: 14rem;">นามสกุล</th>
                      <th style="width: 10rem;">เบอร์โทรศัทพ์</th>
                      <th style="width: 5rem;">ระดับชั้น</th>
                      <th style="width: 5rem;">ห้อง</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="table_datauser">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- end_content-->
  </div>
  <script src="js/sidebars.js"></script>
</body>

</html>
<?php
}
?>
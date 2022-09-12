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
  <script src="backend/backend_brocasts.js"></script>
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
          <a href="#" class="nav-link text-white">
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
          <a href="course.php" class="nav-link text-white">
            จัดการกลุ่มสาระ
          </a>
        </li>
        <li class="nav-item">
          <a href="brocasts.php" class="nav-link active">
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
      <h4>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;ประกาศ</h4>
      <hr>

      <!-- input user data-->
      <div class="d-flex justify-content-center">

        <div class="card text-bg-light mb-3" style="width: 60rem;">
          <div class="card-body">
            <div class="mb-3">
              <div style="height: 1.5rem"></div>
              <div class="">
                <div class="row">
                  <div class="col" style="width: 30rem;">
                    <label for="grade_brocast" class="form-label">ชั้น</label>
                    <select id="grade_brocast" onchange="get_class('grade_brocast','html_class_brocast')" class="form-select form-select-sm" aria-label="Default select example">
                      <option value="all" selected>ชั้น</option>
                      <option value="1">ม.1</option>
                      <option value="2">ม.2</option>
                      <option value="3">ม.3</option>
                      <option value="4">ม.4</option>
                      <option value="5">ม.5</option>
                      <option value="6">ม.6</option>
                    </select>
                  </div>
                  <div class="col" id="html_class_brocast">
                    <label for="class_brocast" class="form-label">ห้อง</label>
                    <select id="class_brocast" class="form-select form-select-sm" aria-label="Default select example" disabled>
                      <option selected>ห้อง</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                  </select>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="type_brocast" class="form-label">ประเภทการส่งข้อความ</label>
                  <select class="form-select" onchange="get_type_brocast()" id="type_brocast" aria-label="Default select example">
                    <option selected>เลือกประเภทการส่ง</option>
                    <option value="text">ข้อความ</option>
                    <option value="image">รูปภาพ</option>
                  </select>
                </div>
                <div class="mb-3" id="html_brocast">
                  <label for="brocast_data" class="form-label">ข้อความ</label>
                  <textarea class="form-control" id="brocast_data" rows="3" disabled></textarea>
                </div>
                <div style="height: 1rem"></div>
                <div class="mb-3">
                  <div class="d-grid gap-2">
                    <button class="btn btn-outline-success" onclick="brocast_to_chat()" type="button">ส่งข้อความ</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div style="height: 1rem;"></div>

      <!-- userdata -->
    </div>

    <!-- end_content-->
  </div>
  <script src="js/sidebars.js"></script>
</body>

</html>
<?php
}
?>
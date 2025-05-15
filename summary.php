<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>บันทึกการเดิน</title>
    <?php session_start(); ?>
    <script>
    window.userId = <?= $_SESSION['user_id'] ?? 0 ?>;
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Prompt', sans-serif;
    }

    body {
        background-color: #a8dde1;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .fa-bell {
        padding: 20px;
        background-color: red;
        color: white;
        border-radius: 30px;
        font-size: 25px;
    }

    .icon-bell {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    h1 {
        font-size: 35px;
        font-weight: bold;
        margin-top: 90px;
        margin-bottom: 20px;
        color: #000;
    }

    .card-text {
        border-radius: 20px;
        width: 100%;
        max-width: 400px;
        padding: 20px;
        margin-bottom: 50px;
    }

    .label {
        font-weight: bold;
        color: #333;
        font-size: 25px;
        padding: 0;
    }

    .button {
        background-color: #4a65d3;
        color: white;
        font-size: 30px;
        font-weight: bold;
        padding: 20px 30px;
        border: none;
        border-radius: 40px;
        cursor: pointer;
    }

    .button:hover {
        background-color: #3a54c0;
    }


    .icon {
        width: 200px;
        height: 200px;
        background-color: #fefdeb;
        border-radius: 50%;
        margin: 0 auto 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon::before {
        content: url('img/footprint-icon.jpg');
        display: inline-block;
    }

    .bg-primary {
        background-color: #5371cb !important;
    }

    .btn-primary {
        background-color: #5371cb;
        border: none;
        font-size: 20px;
    }

     .modal-body {
        font-size: 25px;
    }
    </style>
</head>

<body>
    <div class="icon-bell">
        <a href="tel:1669" style="text-decoration: none;">
            <i class="fa-solid fa-bell"></i>
        </a>
    </div>


    <h1>สรุปการเดินทาง</h1>

    <div class="card-text">
        <div class="icon"></div>
            <div class="row mb-2">
                <div class="col-8 label text-start">ระยะทาง</div>
                <div class="col-2 label text-start" id="distance">-</div>
                <div class="col-2 label text-end">เมตร</div>
            </div>

            <div class="row mb-2">
                <div class="col-8 label text-start">จำนวนการเดิน</div>
                <div class="col-2 label text-start" id="steps">-</div>
                <div class="col-2 label text-end">ก้าว</div>
            </div>

            <div class="row mb-2">
                <div class="col-8 label text-start">แคลอรี่ที่เผาผลาญ</div>
                <div class="col-2 label text-start" id="calories">-</div>
                <div class="col-2 label text-end">แคลอรี่</div>
            </div>


    </div>

    <button class="button">บันทึกการเดิน</button>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="successModalLabel">บันทึกสำเร็จ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                </div>
                <div class="modal-body">
                    บันทึกการเดินเรียบร้อยแล้ว
                </div>
                <div class="modal-footer">
                    <a href="menu.php" class="btn btn-primary">ตกลง</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ❌ Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">เกิดข้อผิดพลาด</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="ปิด"></button>
                </div>
                <div class="modal-body" id="errorModalBody">
                    ❌ ข้อผิดพลาดไม่ทราบสาเหตุ
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const urlParams = new URLSearchParams(window.location.search);
    const distance = urlParams.get('distance');
    const steps = urlParams.get('steps');
    const calories = urlParams.get('calories');

    // แสดงผล
    document.getElementById('distance').innerText = distance;
    document.getElementById('steps').innerText = steps;
    document.getElementById('calories').innerText = calories;

    // กดบันทึก
    document.querySelector('.button').addEventListener('click', () => {
        const userId = window.userId || 0;

        fetch('save_summary.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `user_id=${userId}&distance=${distance}&steps=${steps}&calories=${calories}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const modal = new bootstrap.Modal(document.getElementById('successModal'));
                    modal.show();
                } else {
                    document.getElementById('errorModalBody').innerText = '❌ เกิดข้อผิดพลาด: ' + data
                        .message;
                    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                }
            });
    });
    </script>

</body>

</html>
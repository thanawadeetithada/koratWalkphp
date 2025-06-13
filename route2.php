<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>แผนที่ชมงานศิลป์ถิ่นโคราช</title>
    <style>
    html,
    body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        height: 100vh;
    }

    #map-wrapper {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        position: relative;
        touch-action: none;
        background: #000;
    }

    #map-container {
        position: absolute;
        top: 0;
        left: 0;
        transform-origin: top left;
        will-change: transform;
    }

    #map {
        display: block;
        width: 2000px;
        height: auto;
    }

    .location-icon {
        position: absolute;
        width: 24px;
        height: 24px;
        font-size: 24px;
        color: red;
        transform: translate(-50%, -50%);
        z-index: 10;
    }

    .zoom-controls {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 20;
        padding: 8px;
        border-radius: 10px;
    }

    .zoom-controls button {
        margin: 3px;
        padding: 10px;
        border-radius: 30px;
        background-color: #5371cb;
        border: 1px;
    }

    #start-btn {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 30;
        padding: 20px 30px;
        font-size: 18px;
        background-color: #5371cb;
        color: white;
        border: none;
        border-radius: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    i {
        font-size: xx-large;
        color: white;
    }

    @keyframes pulse {
        0% {
            transform: translate(-50%, -50%) scale(1);
        }

        50% {
            transform: translate(-50%, -50%) scale(1.2);
        }

        100% {
            transform: translate(-50%, -50%) scale(1);
        }
    }

    .location-icon {
        animation: pulse 1.5s infinite ease-in-out;
    }

    .custom-pin {
        position: absolute;
        width: 24px;
        height: 24px;
        font-size: 20px;
        color: gold;
        transform: translate(-50%, -50%);
        z-index: 10;
        animation: pulse 1.5s infinite ease-in-out;
    }
    </style>
</head>

<body>
    <div id="map-wrapper">
        <div id="map-container">
            <img id="map" src="map/map.png" alt="map" style="width: 2000px">
            <div id="user-location" class="location-icon">📍</div>
            <div id="custom-pins"></div> <!-- ✅ เพิ่มตรงนี้ -->
        </div>

        <button id="start-btn" onclick="toggleTracking()">🚶‍♂️ เริ่มเดินทาง</button>
    </div>

    <script>
    let isDragging = false;
    let dragStartX, dragStartY;
    let containerStartLeft = 0;
    let containerStartTop = 0;

    const mapWrapper = document.getElementById('map-wrapper');
    const mapContainer = document.getElementById('map-container');

    // เริ่มลาก (mouse)
    mapWrapper.addEventListener('mousedown', (e) => {
        isDragging = true;
        dragStartX = e.clientX;
        dragStartY = e.clientY;

        // อ่านตำแหน่งปัจจุบัน (parseInt เพราะเป็น string เช่น "0px")
        containerStartLeft = parseInt(getComputedStyle(mapContainer).left) || 0;
        containerStartTop = parseInt(getComputedStyle(mapContainer).top) || 0;

        mapWrapper.style.cursor = 'grabbing';
    });

    // ลากเมาส์ (mousemove)
    mapWrapper.addEventListener('mousemove', (e) => {
        if (!isDragging) return;

        const dx = e.clientX - dragStartX;
        const dy = e.clientY - dragStartY;

        // อัพเดตตำแหน่งของ map-container
        mapContainer.style.left = (containerStartLeft + dx) + 'px';
        mapContainer.style.top = (containerStartTop + dy) + 'px';
    });

    // ปล่อยลาก (mouseup)
    mapWrapper.addEventListener('mouseup', (e) => {
        isDragging = false;
        mapWrapper.style.cursor = 'default';
    });

    // ถ้าออกนอกกรอบ (mouseleave)
    mapWrapper.addEventListener('mouseleave', (e) => {
        isDragging = false;
        mapWrapper.style.cursor = 'default';
    });

    // สำหรับ touch screen
    mapWrapper.addEventListener('touchstart', (e) => {
        if (e.touches.length === 1) {
            isDragging = true;
            dragStartX = e.touches[0].clientX;
            dragStartY = e.touches[0].clientY;

            containerStartLeft = parseInt(getComputedStyle(mapContainer).left) || 0;
            containerStartTop = parseInt(getComputedStyle(mapContainer).top) || 0;
        }
    });

    mapWrapper.addEventListener('touchmove', (e) => {
        if (!isDragging || e.touches.length !== 1) return;

        const dx = e.touches[0].clientX - dragStartX;
        const dy = e.touches[0].clientY - dragStartY;

        mapContainer.style.left = (containerStartLeft + dx) + 'px';
        mapContainer.style.top = (containerStartTop + dy) + 'px';

        e.preventDefault(); // ป้องกันเลื่อนหน้าเว็บ
    });

    mapWrapper.addEventListener('touchend', (e) => {
        isDragging = false;
    });

    ////////////////////////
    let scale = 1;
    let lastTouchDistance = null;

    function setScale(newScale, centerX, centerY) {
        scale = Math.min(Math.max(newScale, 0.5), 3); // จำกัด scale ระหว่าง 0.5x ถึง 3x
        mapContainer.style.transform = `scale(${scale})`;
    }

    // 📌 Zoom ด้วยเมาส์
    document.getElementById('map-wrapper').addEventListener('wheel', function(e) {
        e.preventDefault();
        const zoomIntensity = 0.1;
        if (e.deltaY < 0) {
            setScale(scale + zoomIntensity);
        } else {
            setScale(scale - zoomIntensity);
        }
    }, {
        passive: false
    });

    // 📌 Zoom ด้วย Pinch บนนิ้ว (touch gesture)
    document.getElementById('map-wrapper').addEventListener('touchstart', function(e) {
        if (e.touches.length === 2) {
            const dx = e.touches[0].clientX - e.touches[1].clientX;
            const dy = e.touches[0].clientY - e.touches[1].clientY;
            lastTouchDistance = Math.sqrt(dx * dx + dy * dy);
        }
    }, {
        passive: false
    });

    document.getElementById('map-wrapper').addEventListener('touchmove', function(e) {
        if (e.touches.length === 2 && lastTouchDistance !== null) {
            e.preventDefault();
            const dx = e.touches[0].clientX - e.touches[1].clientX;
            const dy = e.touches[0].clientY - e.touches[1].clientY;
            const newDistance = Math.sqrt(dx * dx + dy * dy);
            const distanceDelta = newDistance - lastTouchDistance;

            setScale(scale + distanceDelta * 0.005); // ปรับ scale ตามนิ้ว
            lastTouchDistance = newDistance;
        }
    }, {
        passive: false
    });

    document.getElementById('map-wrapper').addEventListener('touchend', function(e) {
        if (e.touches.length < 2) {
            lastTouchDistance = null;
        }
    });

    function checkAndRequestLocation() {
        if (!navigator.geolocation) {
            alert("เบราว์เซอร์ของคุณไม่รองรับการระบุตำแหน่ง");
            return;
        }

        navigator.permissions.query({
            name: 'geolocation'
        }).then(function(result) {
            if (result.state === 'granted' || result.state === 'prompt') {
                getLocation();
            } else {
                alert("กรุณาเปิดการเข้าถึงตำแหน่ง (GPS) ในเบราว์เซอร์ของคุณ");
            }
        });
    }

    function getLocation() {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                console.log("ตำแหน่งปัจจุบัน:", lat, lng);
                showUserLocation(lat, lng);

                // ✅ ส่งไปบันทึกในฐานข้อมูล
                saveLocationToDB(lat, lng);
            },
            function(error) {
                console.error("เกิดข้อผิดพลาดในการดึงตำแหน่ง:", error);
                if (error.code === 1) {
                    alert("กรุณาอนุญาตให้เว็บไซต์เข้าถึงตำแหน่งของคุณ");
                } else if (error.code === 2) {
                    alert("ไม่สามารถระบุตำแหน่งได้ กรุณาเปิด GPS หรือเชื่อมต่ออินเทอร์เน็ต");
                } else if (error.code === 3) {
                    alert("การดึงตำแหน่งใช้เวลานานเกินไป กรุณาลองใหม่");
                }
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    function saveLocationToDB(lat, lng) {
        fetch('save_gps.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `latitude=${lat}&longitude=${lng}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("บันทึกพิกัดลงฐานข้อมูลเรียบร้อยแล้ว");
                } else {
                    console.warn("บันทึกพิกัดล้มเหลว:", data.message);
                }
            })
            .catch(err => {
                console.error("เกิดข้อผิดพลาดในการส่งข้อมูล:", err);
            });
    }

    function showUserLocation(lat, lng) {
        // ตัวอย่างการแสดงตำแหน่งบนแผนที่แบบ static image (ต้องแปลง lat/lng เป็นตำแหน่ง pixel เอง)
        const userMarker = document.getElementById('user-location');

        // ❗ จำเป็นต้องมีฟังก์ชันแปลง lat/lng เป็นตำแหน่งบนภาพ (pixel) เช่น:
        const position = convertLatLngToPixel(lat, lng); // <-- คุณต้องกำหนดเอง
        userMarker.style.left = position.x + 'px';
        userMarker.style.top = position.y + 'px';
    }

    function convertLatLngToPixel(lat, lng) {
        const topLat = 14.980050;
        const leftLng = 102.090380;
        const bottomLat = 14.970218;
        const rightLng = 102.114147;

        const mapImg = document.getElementById("map");
        const imageWidth = mapImg.clientWidth;
        const imageHeight = mapImg.clientHeight;

        const x = ((lng - leftLng) / (rightLng - leftLng)) * imageWidth;
        const y = ((topLat - lat) / (topLat - bottomLat)) * imageHeight;

        return {
            x,
            y
        };
    }


    let trackingInterval = null; // เก็บ ID interval

    function toggleTracking() {
        if (trackingInterval === null) {
            checkAndRequestLocation();

            trackingInterval = setInterval(() => {
                getLocation();
            }, 5000);
            document.getElementById('start-btn').textContent = '⏸️ หยุดเดินทาง';
        } else {

            clearInterval(trackingInterval);
            trackingInterval = null;
            window.location.href = 'summary.php';
        }
    }

    ///////////////////////
    const userIcon = document.getElementById('user-location');

    function updateLocation(lat, lon) {
        const topLat = 14.980050; // แก้ไขพิกัดบนสุดของแผนที่
        const leftLng = 102.090380; // แก้ไขพิกัดซ้ายสุดของแผนที่

        const bottomLat = 14.970218; // พิกัดล่างสุด
        const rightLng = 102.114147; // พิกัดขวาสุด

        const mapImg = document.getElementById("map");
        const imageWidth = mapImg.clientWidth;
        const imageHeight = mapImg.clientHeight;

        const x = ((lon - leftLng) / (rightLng - leftLng)) * imageWidth;
        const y = ((topLat - lat) / (topLat - bottomLat)) * imageHeight;

        userIcon.style.left = `${x}px`;
        userIcon.style.top = `${y}px`;
    }

    window.onload = () => {
        //เปลี่ยนเป็น ณขณะนั้นจริงๆ
        const lat = 14.974626403278286;
        const lng = 102.09936300888151;

        // อัปเดตตำแหน่งหมุด
        updateLocation(lat, lng);

        // คำนวณตำแหน่ง pixel เพื่อเลื่อนแผนที่ให้หมุดอยู่ตรงกลาง
        const topLat = 14.980050; // แก้ไขพิกัดบนสุดของแผนที่
        const leftLng = 102.090380; // แก้ไขพิกัดซ้ายสุดของแผนที่

        const bottomLat = 14.970218; // พิกัดล่างสุด
        const rightLng = 102.114147; // พิกัดขวาสุด

        const mapImg = document.getElementById("map");
        const imageWidth = mapImg.clientWidth;
        const imageHeight = mapImg.clientHeight;

        const x = ((lng - leftLng) / (rightLng - leftLng)) * imageWidth;
        const y = ((topLat - lat) / (topLat - bottomLat)) * imageHeight;

        centerMapAt(x, y); // 👉 เลื่อนแผนที่ให้จุดนี้อยู่กลางหน้าจอ
    };

    function applyTransform() {
        container.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
    }

    function centerMapAt(x, y) {
        const mapWrapper = document.getElementById('map-wrapper');
        const mapContainer = document.getElementById('map-container');

        const wrapperWidth = mapWrapper.clientWidth / 2 - x * scale;
        const wrapperHeight = mapWrapper.clientHeight / 2 - y * scale;

        const centerX = wrapperWidth / 2;
        const centerY = wrapperHeight / 2;

        // คำนวณตำแหน่ง left/top ใหม่เพื่อให้ (x, y) อยู่ตรงกลางจอ
        const newLeft = centerX - x * scale;
        const newTop = centerY - y * scale;

        mapContainer.style.left = `${newLeft}px`;
        mapContainer.style.top = `${newTop}px`;
        mapContainer.style.transform = `scale(${scale})`;
    }
    </script>

</body>

</html>
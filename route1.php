<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>แผนที่ไหว้พระ</title>
    <?php session_start(); ?>
    <script>
    window.userId = <?= $_SESSION['user_id'] ?? 0 ?>;
    </script>
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
    let map;
    let marker;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 13.736717,
                lng: 100.523186
            },
            zoom: 10,
        });

        marker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            title: "คุณอยู่ที่นี่",
        });

        getUserLocation();
    }

    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    const userLocation = {
                        lat,
                        lng
                    };

                    // อัปเดตตำแหน่งของแผนที่
                    map.setCenter(userLocation);
                    marker.setPosition(userLocation);

                    // แสดงพิกัดใน console
                    console.log("พิกัดจริง:", lat, lng);
                },
                function(error) {
                    console.error("ไม่สามารถดึงพิกัดได้:", error.message);
                    alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้ โปรดอนุญาตให้เว็บไซต์เข้าถึง GPS");
                }
            );
        } else {
            alert("เบราว์เซอร์ของคุณไม่รองรับ Geolocation");
        }
    }


    const wrapper = document.getElementById('map-wrapper');
    const container = document.getElementById('map-container');
    const userIcon = document.getElementById('user-location');

    let scale = 2.5;
    let posX = -1200;
    let posY = -400;
    let startX = 0,
        startY = 0;
    let isDragging = false;

    function applyTransform() {
        container.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
    }

    function zoomIn() {
        scale = Math.min(3, scale + 0.1);
        applyTransform();
    }

    function zoomOut() {
        scale = Math.max(0.5, scale - 0.1);
        applyTransform();
    }

    function summarizePathData() {
        if (!pathPoints || pathPoints.length < 2) {
            console.warn("ไม่มีข้อมูลเพียงพอในการสรุปเส้นทาง");
            return;
        }

        // 1. คำนวณระยะทางรวม
        let totalDistance = 0;
        for (let i = 1; i < pathPoints.length; i++) {
            const prev = pathPoints[i - 1];
            const curr = pathPoints[i];
            totalDistance += calculateDistance(curr.lat, curr.lon, prev.lat, prev.lon);
        }

        // 2. ประมาณค่าก้าว (สมมุติ 1 ก้าว = 0.7 เมตร)
        const steps = Math.round(totalDistance / 0.7);

        // 3. ประมาณพลังงานที่ใช้ (สมมุติ 0.04 แคลอรี่/เมตร)
        const calories = Math.round(totalDistance * 0.04);

        // 4. ส่งไป backend
        fetch("save_summary.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `user_id=${window.userId}&distance=${totalDistance.toFixed(2)}&steps=${steps}&calories=${calories}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert("✅ บันทึกการเดินทางเรียบร้อยแล้ว!");
                } else {
                    alert("❌ บันทึกไม่สำเร็จ: " + data.message);
                }
            })
            .catch(err => {
                alert("❌ เกิดข้อผิดพลาดในการเชื่อมต่อ: " + err.message);
            });
    }


    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371000; // รัศมีโลก (เมตร)
        const toRad = (deg) => deg * (Math.PI / 180);

        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);

        const a = Math.sin(dLat / 2) ** 2 +
            Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) ** 2;

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c; // ระยะทาง (เมตร)
    }


    let watchId = null;
    let isTracking = false;

    function toggleTracking() {
        const btn = document.getElementById("start-btn");

        if (!isTracking) {
            if (!navigator.geolocation) {
                alert("อุปกรณ์ไม่รองรับ GPS");
                return;
            }

            pathPoints = [];
            totalDistance = 0;

            watchId = navigator.geolocation.watchPosition(
                (pos) => {
                    const lat = pos.coords.latitude;
                    const lon = pos.coords.longitude;

                    updateLocation(lat, lon);

                    if (pathPoints.length === 0 ||
                        calculateDistance(lat, lon, pathPoints.at(-1).lat, pathPoints.at(-1).lon) > 3) {
                        pathPoints.push({
                            lat,
                            lon
                        });
                    }

                    fetch("save_gps.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: `lat=${lat}&lon=${lon}`
                        }).then(res => res.json())
                        .then(data => {
                            if (!data.success) console.error("DB Error:", data.message);
                        });
                },
                (err) => {
                    alert("ไม่สามารถเข้าถึง GPS ได้");
                    console.error(err);
                }, {
                    enableHighAccuracy: true,
                    maximumAge: 1000,
                    timeout: 5000
                }
            );

            btn.innerText = "🛑 จบการเดินทาง";
            btn.style.backgroundColor = "#d9534f";
            isTracking = true;

        } else {
            navigator.geolocation.clearWatch(watchId);
            watchId = null;

            btn.innerText = "🚶‍♂️ เริ่มเดินทาง";
            btn.style.backgroundColor = "#5371cb";
            isTracking = false;

            summarizePathData();
        }
    }

    function updateLocation(lat, lon) {
        const topLat = 14.980050; // แก้ไขพิกัดบนสุดของแผนที่
        const leftLng = 102.090380; // แก้ไขพิกัดซ้ายสุดของแผนที่

        const bottomLat = 14.970218; // พิกัดล่างสุด
        const rightLng = 102.114147; // พิกัดขวาสุด

        if (lat < bottomLat || lat > topLat || lon < leftLng || lon > rightLng) {
            console.warn("📍 พิกัดอยู่นอกพื้นที่แผนที่  ");
            return;
        }

        // ขนาดของแผนที่ที่แสดงบนหน้าจอ
        const mapImg = document.getElementById("map");
        const imageWidth = mapImg.clientWidth; // กว้างของแผนที่ใน pixel
        const imageHeight = mapImg.clientHeight; // สูงของแผนที่ใน pixel

        // คำนวณตำแหน่ง x, y ของพิกัด lat, lon
        const x = ((lon - leftLng) / (rightLng - leftLng)) * imageWidth;
        const y = ((topLat - lat) / (topLat - bottomLat)) * imageHeight;

        // กำหนดตำแหน่งหมุด
        userIcon.style.left = `${x}px`;
        userIcon.style.top = `${y}px`;

        // ปรับแผนที่ให้ตรงตำแหน่ง
        posX = wrapper.clientWidth / 2 - x * scale;
        posY = wrapper.clientHeight / 2 - y * scale;
        applyTransform(); // ปรับแผนที่ให้เคลื่อนที่ตามหมุด

        console.log(`GPS จริง: ${lat}, ${lon} → พิกัดแผนที่: x=${x}, y=${y}`);
    }


    function addCustomPins(pinList) {
        const pinContainer = document.getElementById('custom-pins');
        pinContainer.innerHTML = ""; // ล้างของเดิม

        const mapImg = document.getElementById("map");
        const imageWidth = mapImg.clientWidth;
        const imageHeight = mapImg.clientHeight;

        const topLat = 14.978850;
        const leftLng = 102.090380;
        const bottomLat = 14.970218;
        const rightLng = 102.114147;

        pinList.forEach(pin => {
            const x = ((pin.lon - leftLng) / (rightLng - leftLng)) * imageWidth;
            const y = ((topLat - pin.lat) / (topLat - bottomLat)) * imageHeight;

            const div = document.createElement("div");
            div.className = "custom-pin";
            div.innerHTML = "📍";
            div.style.left = `${x}px`;
            div.style.top = `${y}px`;
            pinContainer.appendChild(div);
        });
    }

    window.onload = () => {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    updateLocation(lat, lon); // 🧭 ใช้ค่าจริงจากมือถือ
                },
                function(err) {
                    console.error("ไม่สามารถเข้าถึง GPS:", err);
                    alert("โปรดอนุญาตให้เข้าถึงตำแหน่งของคุณ");
                }, {
                    enableHighAccuracy: true,
                    maximumAge: 1000,
                    timeout: 5000
                }
            );
        } else {
            alert("เบราว์เซอร์ไม่รองรับ GPS กรุณาแชร์ที่อยู่ของตำแหน่งที่ถูกต้อง");
        }
    };
    </script>
</body>

</html>
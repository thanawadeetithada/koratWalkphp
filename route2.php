<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>แผนที่ชมงานศิลป์ถิ่นโคราช</title>
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
    </style>
</head>

<body>
    <div id="map-wrapper">
        <div id="map-container">
            <img id="map" src="map/map.png" alt="map">
            <div id="user-location" class="location-icon">📍</div>
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

    let scale = 2;
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

    window.onload = () => applyTransform();
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtXFLlqSL5FeoPVbndOFPW6I-1Zd_2Fnc&callback=initMap">
    </script>
</body>

</html>
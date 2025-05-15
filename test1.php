<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จับตำแหน่ง GPS ด้วย Google Maps</title>
    <style>
        #map {
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <h1>ตำแหน่งปัจจุบันของคุณ</h1>
    <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtXFLlqSL5FeoPVbndOFPW6I-1Zd_2Fnc&callback=initMap" async defer></script>
    <script>
        let map, marker;

        // ฟังก์ชันเริ่มต้น Google Maps
        function initMap() {
            // เริ่มต้นแผนที่ที่ตำแหน่งกลาง
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: { lat: 14.974738560173149, lng: 102.09808668407996 } // ค่าเริ่มต้น: ประตูชุมพล
            });

            // ใช้ Geolocation API เพื่อดึงตำแหน่งปัจจุบัน
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    // แสดงแผนที่ที่ตำแหน่งปัจจุบัน
                    map.setCenter(new google.maps.LatLng(userLat, userLng));

                    // วาง Marker ตำแหน่งปัจจุบัน
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(userLat, userLng),
                        map: map,
                        title: 'ตำแหน่งของคุณ'
                    });
                }, function() {
                    alert("ไม่สามารถเข้าถึงตำแหน่งของคุณได้");
                });
            } else {
                alert("เบราว์เซอร์ของคุณไม่รองรับ Geolocation");
            }
        }
    </script>
</body>
</html>

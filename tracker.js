let watchId = null;
let map, marker;

// ฟังก์ชันที่เริ่มต้นแผนที่
function initMap() {
    // กำหนดแผนที่
    map = L.map('map').setView([13.755815, 100.566232], 16); // ตั้งจุดกลางแผนที่

    // เพิ่มแผนที่จาก OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // สร้าง marker
    marker = L.marker([13.755815, 100.566232]).addTo(map);
}

// ฟังก์ชันที่แสดงตำแหน่ง GPS
function showGPSInfo(lat, lng, acc) {
    const infoDiv = document.getElementById('gps-info');
    infoDiv.innerText = `📍 LAT: ${lat.toFixed(6)}\n📍 LNG: ${lng.toFixed(6)}\n🎯 Accuracy: ${Math.round(acc)} m`;

    if (acc > 100) {
        infoDiv.style.background = 'rgba(255, 0, 0, 0.2)';
    } else {
        infoDiv.style.background = 'rgba(0, 255, 0, 0.2)';
    }
}

// ฟังก์ชันที่อัปเดตหมุดและแผนที่
function updateMarker(lat, lng) {
    marker.setLatLng([lat, lng]);
    map.setView([lat, lng], 16);
}

// ฟังก์ชันติดตามตำแหน่ง
function startAutoTracking() {
    if (!navigator.geolocation) {
        document.getElementById('gps-info').innerText = "❌ เบราว์เซอร์ไม่รองรับการจับตำแหน่ง";
        return;
    }

    // แสดงตำแหน่งครั้งแรกทันที
    navigator.geolocation.getCurrentPosition(position => {
        const { latitude, longitude, accuracy } = position.coords;
        showGPSInfo(latitude, longitude, accuracy);
        updateMarker(latitude, longitude);
    }, error => {
        document.getElementById('gps-info').innerText = "❌ Error: " + error.message;
    });

    // ติดตามแบบต่อเนื่อง
    watchId = navigator.geolocation.watchPosition(position => {
        const { latitude, longitude, accuracy } = position.coords;
        showGPSInfo(latitude, longitude, accuracy);
        if (accuracy <= 100) {
            updateMarker(latitude, longitude);
        }
    }, error => {
        document.getElementById('gps-info').innerText = "❌ Error: " + error.message;
    }, {
        enableHighAccuracy: true,
        timeout: 20000,
        maximumAge: 0
    });
}

// เรียกฟังก์ชัน initMap เมื่อหน้าโหลด
window.onload = () => {
    initMap();
    startAutoTracking();
};

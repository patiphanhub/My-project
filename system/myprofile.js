document.getElementById('file-input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        // แสดงตัวอย่างรูปภาพ
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-picture').src = e.target.result;
        };
        reader.readAsDataURL(file);

        // แสดงกล่องข้อความยืนยัน
        const confirmation = confirm("คุณต้องการเปลี่ยนรูปโปรไฟล์หรือไม่?");
        if (confirmation) {
            // สร้าง FormData เพื่อส่งไฟล์ผ่าน AJAX
            const formData = new FormData();
            formData.append('profile_image', file);

            // ส่งไฟล์ผ่าน AJAX
            fetch('update_profile.php', {
                method: 'POST',
                body: formData,
                credentials: 'include' // ส่งคุกกี้เพื่อรักษาเซสชัน
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('อัปเดตรูปภาพโปรไฟล์เรียบร้อยแล้ว');
                    // อัปเดตแหล่งที่มาของรูปภาพเพื่อแสดงรูปใหม่
                    document.getElementById('profile-picture').src = data.image_path + '?' + new Date().getTime();
                } else {
                    alert('เกิดข้อผิดพลาด: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์');
            });
        } else {
            // ถ้าผู้ใช้กดยกเลิกให้รีเซ็ตไฟล์ input
            document.getElementById('file-input').value = '';
            document.getElementById('profile-picture').src = "<?php echo htmlspecialchars($user['image']); ?>"; // คืนค่ารูปเดิม
        }
    }
});
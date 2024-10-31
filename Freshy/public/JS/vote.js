function toggleCardSelection(card, category) {
    const selectedCards = document.querySelectorAll('.card.selected');
    if (selectedCards.length >= 1 && !card.classList.contains('selected')) {
        Swal.fire({
            icon: 'error',
            title: 'ไม่สามารถโหวตได้',
            text: 'สามารถโหวตได้แค่ 1 ท่านเท่านั้น',
            position: 'center' // ตั้งค่าตำแหน่งให้เป็นกลาง
        });
        return;
    }

    card.classList.toggle('selected'); // เปลี่ยนสถานะการ์ดที่เลือก
    const goldImage = card.querySelector('.Paticel');
    goldImage.style.display = card.classList.contains('selected') ? 'block' : 'none';

    updateConfirmButtonState(category);
}


function updateConfirmButtonState(category) {
    const selectedCards = document.querySelectorAll('.card.selected');
    const confirmButton = document.getElementById('confirmButton' + category.charAt(0).toUpperCase() + category.slice(1));

    if (selectedCards.length === 0) {
        confirmButton.disabled = true;
        confirmButton.classList.add('disabled-button');
        confirmButton.classList.remove('hover-effect');
        confirmButton.textContent = 'ไม่สามารถโหวตได้';
    } else {
        confirmButton.disabled = false;
        confirmButton.classList.remove('disabled-button');
        confirmButton.classList.add('hover-effect');
        confirmButton.textContent = 'ยืนยันการเลือกนี้';
    }
}


document.addEventListener('DOMContentLoaded', function () {
    updateConfirmButtonState('female');
});

function confirmVote(event, category) {
    event.preventDefault();
    console.log("Confirm button clicked"); // เพิ่มการตรวจสอบที่นี่
    const confirmButton = document.getElementById('confirmButton' + category.charAt(0).toUpperCase() + category.slice(1));

    if (!confirmButton.disabled) {
        const selectedCard = document.querySelector('.card.selected'); // ค้นหาการ์ดที่ถูกเลือก
        if (selectedCard) {
            const selectedBadge = selectedCard.querySelector('.Ncandidate').textContent.trim(); // ดึงชื่อผู้สมัครที่เลือก
            Swal.fire({
                title: 'ยืนยันการโหวต',
                text: `คุณได้เลือก ${selectedBadge}`, // แสดงชื่อผู้สมัคร
                icon: 'success',
                confirmButtonText: 'ตกลง',
                position: 'center' // ตั้งค่าตำแหน่งให้เป็นกลาง
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.html"; // เปลี่ยนไปหน้า index
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่พบการ์ดที่เลือก กรุณาลองใหม่อีกครั้ง',
                position: 'center' // ตั้งค่าตำแหน่งให้เป็นกลาง
            });
        }
    }
}

function noVote(event) {
    event.preventDefault(); // ป้องกันการส่งฟอร์ม
    Swal.fire({
        title: 'ยืนยันการไม่โหวต',
        text: 'คุณไม่ประสงค์จะลงคะแนน',
        icon: 'warning',
        confirmButtonText: 'ตกลง'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "index.html"; // เปลี่ยนไปหน้า index
        }
    });
}

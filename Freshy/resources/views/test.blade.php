<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Estonia&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Spirax&display=swap"
        rel="stylesheet">
    <title>Cinema Seat Booking</title>
    @vite('resources/css/app.css')
    <style>
        body {
            position: relative; /* กำหนดให้ body มีตำแหน่งแบบ relative */
            font-family: "Estonia", cursive;
            font-weight: 400;
            font-style: normal;
        }

        body::before {
            content: ''; /* ใช้เพื่อสร้าง pseudo-element */
            position: absolute; /* ทำให้มันอยู่เหนือ body */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("{{ asset('/bg_ticket.jpg') }}"); /* ใช้พื้นหลัง */
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.9; /* ความโปร่งใส 50% */
            z-index: -1; /* ให้แน่ใจว่าพื้นหลังอยู่ด้านหลังเนื้อหา */
        }

    </style>
</head>
<body class="flex justify-center items-center h-screen">
<div class="flex flex-col w-full ml-3">
    <div class="flex"> <!-- ใช้ flexbox เพื่อจัดการตาราง -->
        <table>
            <tbody id="seating-chart">
            <!-- ที่นั่งจะถูกสร้างที่นี่ -->
            </tbody>
        </table>
    </div>
    <div class="bg-gray-400 h-24 w-full mt-2 flex justify-center items-center">
        <p class="text-amber-50">ทางเดิน</p>
    </div> <!-- เปลี่ยนความสูงตามต้องการ -->
</div>
<div class="w-full flex flex-col items-center p-4">
    <img src="{{asset('/logo.png')}}" style="width: 100px" class="mb-4">
    <div class="bg-white w-96 p-6 rounded-lg border-4 border-yellow-400 flex flex-col items-center">
        <p class="text-3xl text-yellow-500 font-semibold mb-4">BOOKING</p>
        <div class="flex justify-between w-full text-xl font-semibold mb-4">
            <div class="text-center">
                <p>ที่นั่ง :</p>
                <p id="selected-seat" class="text-3xl text-black"></p>
            </div>
            <div class="text-center">
                <p>โซนที่ :</p>
                <p class="text-3xl text-black">5</p>
            </div>
        </div>
    </div>
    <button class="bg-yellow-500 text-black text-xl font-semibold py-2 px-8 mt-6 rounded-full">จองเลย</button>
</div>

<script>
    const rowSeats = {
        'Z': ['Z03', 'Z02', 'Z01'], // ที่นั่งในแถว Z
        'Y': ['Y06', 'Y05', 'Y04', 'Y03', 'Y02', 'Y01'], // ที่นั่งในแถว Y
        'X': ['X10', 'X09', 'X08', 'X07', 'X06', 'X05', 'X04', 'X03', 'X02', 'X01'], // ที่นั่งในแถว X
        'W': ['W13', 'W12', 'W11', 'W10', 'W09', 'W08', 'W07', 'W06', 'W05', 'W04', 'W03', 'W02', 'W01'], // ที่นั่งในแถว W
        'V': ['V13', 'V12', 'V11', 'V10', 'V09', 'V08', 'V07', 'V06', 'V05', 'V04', 'V03', 'V02', 'V01'], // ที่นั่งในแถว V
        'U': ['U16', 'U15', 'U14', 'U13', 'U12', 'U11', 'U10', 'U09', 'U08', 'U07', 'U06', 'U05', 'U04', 'U03', 'U02', 'U01'], // ที่นั่งในแถว U
        'T': ['T18', 'T17', 'T16', 'T15', 'T14', 'T13', 'T12', 'T11', 'T10', 'T09', 'T08', 'T07', 'T06', 'T05', 'T04', 'T03', 'T02', 'T01'], // ที่นั่งในแถว T
        'S': ['S20', 'S19', 'S18', 'S17', 'S16', 'S15', 'S14', 'S13', 'S12', 'S11', 'S10', 'S09', 'S08', 'S07', 'S06', 'S05', 'S04', 'S03', 'S02', 'S01'], // ที่นั่งในแถว S
        'R': ['R21', 'R20', 'R19', 'R18', 'R17', 'R16', 'R15', 'R14', 'R13', 'R12', 'R11', 'R10', 'R09', 'R08', 'R07', 'R06', 'R05', 'R04', 'R03', 'R02', 'R01'], // ที่นั่งในแถว R
        'Q': ['Q22', 'Q21', 'Q20', 'Q19', 'Q18', 'Q17', 'Q16', 'Q15', 'Q14', 'Q13', 'Q12', 'Q11', 'Q10', 'Q09', 'Q08', 'Q07', 'Q06', 'Q05', 'Q04', 'Q03', 'Q02', 'Q01'], // ที่นั่งในแถว Q
        'P': ['P23', 'P22', 'P21', 'P20', 'P19', 'P18', 'P17', 'P16', 'P15', 'P14', 'P13', 'P12', 'P11', 'P10', 'P09', 'P08', 'P07', 'P06', 'P05', 'P04', 'P03', 'P02', 'P01'], // ที่นั่งในแถว P
    };

    const maxColumns = 25; // จำนวนช่องสูงสุด
    const seatWidth = '30px'; // กำหนดความกว้างของที่นั่ง
    const seatingChart = document.getElementById('seating-chart');

    // ฟังก์ชันสร้างแถวที่นั่ง
    function createRow(seatIds, rowLabel) {
        const row = document.createElement('tr');

        // ช่องที่มีตัวอักษรแถวที่ด้านซ้าย
        const labelTdStart = document.createElement('td');
        labelTdStart.innerText = rowLabel; // ตัวอักษรแถว
        labelTdStart.style.width = seatWidth; // กำหนดความกว้าง
        labelTdStart.style.fontSize = '24px';
        labelTdStart.style.color = 'white'; // เปลี่ยนสีตัวอักษรเป็นสีขาว
        labelTdStart.style.textAlign = 'center'; // จัดกึ่งกลาง
        row.appendChild(labelTdStart);

        // จำนวนที่นั่งและช่องว่างที่เราสามารถใช้ได้
        const usedColumns = seatIds.length + 2; // รวมช่องตัวอักษรทั้งสองด้าน
        const emptySeats = maxColumns - usedColumns; // คำนวณจำนวนช่องว่างที่เหลือ

        seatIds.forEach(seatId => {
            const td = document.createElement('td');
            td.className = 'p-0.5 cursor-pointer';
            td.id = seatId;
            td.setAttribute('name', seatId); // เพิ่ม attribute name เท่ากับ id
            td.style.width = seatWidth; // กำหนดความกว้างที่นี่
            td.onclick = function () {
                toggleCheck(this);
            };

            td.innerHTML = `
        <div class="text-center relative">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-7 h-auto p-0.5 m-1">
                <path d="M248 48l0 208 48 0 0-197.3c23.9 13.8 40 39.7 40 69.3l0 128 48 0 0-128C384 57.3 326.7 0 256 0L192 0C121.3 0 64 57.3 64 128l0 128 48 0 0-128c0-29.6 16.1-55.5 40-69.3L152 256l48 0 0-208 48 0zM48 288c-12.1 0-23.2 6.8-28.6 17.7l-16 32c-5 9.9-4.4 21.7 1.4 31.1S20.9 384 32 384l0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96 256 0 0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96c11.1 0 21.4-5.7 27.2-15.2s6.4-21.2 1.4-31.1l-16-32C423.2 294.8 412.1 288 400 288L48 288z" fill="#ff0000"/>
            </svg>
            <img src="{{asset('/gold_check.png')}}" class="absolute inset-0 w-4 h-4 m-auto hidden checkmark" alt="Checked" style="width: 40px; height: auto">
        </div>
    `;
            row.appendChild(td);
        });

        // เพิ่มช่องว่างที่เหลือ
        for (let i = 0; i < emptySeats; i++) {
            const td = document.createElement('td');
            td.className = 'empty-seat'; // ให้คลาสสำหรับช่องว่าง
            td.style.width = seatWidth; // กำหนดความกว้างของช่องว่าง
            row.appendChild(td);
        }

        // ช่องที่มีตัวอักษรแถวที่ด้านขวา
        const labelTdEnd = document.createElement('td');
        labelTdEnd.innerText = rowLabel; // ตัวอักษรแถว
        labelTdEnd.style.width = seatWidth; // กำหนดความกว้าง
        labelTdEnd.style.color = 'white'; // เปลี่ยนสีตัวอักษรเป็นสีขาว
        labelTdEnd.style.fontSize = '24px';
        labelTdEnd.style.textAlign = 'center'; // จัดกึ่งกลาง
        row.appendChild(labelTdEnd);

        return row;
    }

    // สร้างแถวจาก Z ถึง A
    for (let charCode = 'Z'.charCodeAt(0); charCode >= 'P'.charCodeAt(0); charCode--) {
        const rowLabel = String.fromCharCode(charCode);
        const seatIds = rowSeats[rowLabel] || []; // ดึงที่นั่งจาก object, ถ้าไม่มีให้ใช้ array ว่าง
        const row = createRow(seatIds, rowLabel);
        seatingChart.appendChild(row);
    }

    // ฟังก์ชัน toggleCheck ตามที่กล่าวถึงก่อนหน้านี้
    function toggleCheck(element) {
        const checkmark = element.querySelector('.checkmark');
        const seatId = element.id;

        if (checkmark.classList.contains('hidden')) {
            checkmark.classList.remove('hidden'); // แสดง checkmark
            document.getElementById('selected-seat').innerText = seatId; // แสดง ID
        } else {
            checkmark.classList.add('hidden'); // ซ่อน checkmark
            document.getElementById('selected-seat').innerText = ""; // ลบ ID เมื่อติ๊กออก
        }
    }
</script>
</body>
</html>


{{--    <tr>--}}
{{--        <!-- Loop for 23 seats in the row -->--}}
{{--        <td class="p-0.5 text-xl text-amber-50">--}}
{{--            <div class="text-center mr-2">--}}
{{--                <p>Z</p>--}}
{{--            </div>--}}
{{--        </td>--}}
{{--        <!-- Repeat the <td> for 23 columns, updating seat numbers -->--}}
{{--        <!-- Example for next seats -->--}}
{{--        <td class="p-0.5 cursor-pointer" onclick="toggleCheck(this)" id="Z30">--}}
{{--            <div class="text-center relative">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-auto">--}}
{{--                    <path d="M248 48l0 208 48 0 0-197.3c23.9 13.8 40 39.7 40 69.3l0 128 48 0 0-128C384 57.3 326.7 0 256 0L192 0C121.3 0 64 57.3 64 128l0 128 48 0 0-128c0-29.6 16.1-55.5 40-69.3L152 256l48 0 0-208 48 0zM48 288c-12.1 0-23.2 6.8-28.6 17.7l-16 32c-5 9.9-4.4 21.7 1.4 31.1S20.9 384 32 384l0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96 256 0 0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96c11.1 0 21.4-5.7 27.2-15.2s6.4-21.2 1.4-31.1l-16-32C423.2 294.8 412.1 288 400 288L48 288z" fill="#ff0000"/>--}}
{{--                </svg>--}}
{{--                <!-- รูปเครื่องหมายถูกจะถูกเพิ่มที่นี่ -->--}}
{{--                <img src="{{asset('/gold_check.png')}}" class="absolute inset-0 w-4 h-4 m-auto hidden checkmark" alt="Checked" style="width: 40px; height: auto"  >--}}
{{--            </div>--}}
{{--        </td>--}}
{{--        <td class="p-0.5 cursor-pointer" onclick="toggleCheck(this)" id="">--}}
{{--            <div class="text-center relative">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-6 h-auto">--}}
{{--                    <path d="M248 48l0 208 48 0 0-197.3c23.9 13.8 40 39.7 40 69.3l0 128 48 0 0-128C384 57.3 326.7 0 256 0L192 0C121.3 0 64 57.3 64 128l0 128 48 0 0-128c0-29.6 16.1-55.5 40-69.3L152 256l48 0 0-208 48 0zM48 288c-12.1 0-23.2 6.8-28.6 17.7l-16 32c-5 9.9-4.4 21.7 1.4 31.1S20.9 384 32 384l0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96 256 0 0 96c0 17.7 14.3 32 32 32s32-14.3 32-32l0-96c11.1 0 21.4-5.7 27.2-15.2s6.4-21.2 1.4-31.1l-16-32C423.2 294.8 412.1 288 400 288L48 288z" fill="#ff0000"/>--}}
{{--                </svg>--}}
{{--                <!-- รูปเครื่องหมายถูกจะถูกเพิ่มที่นี่ -->--}}
{{--                <img src="{{asset('/gold_check.png')}}" class="absolute inset-0 w-4 h-4 m-auto hidden checkmark" alt="Checked" style="width: 40px; height: auto"  >--}}
{{--            </div>--}}
{{--        </td>--}}
<!-- Continue for all 23 seats -->
{{--    </tr>--}}
<!-- end of Row 1 -->

{{--id="selected-seat"--}}

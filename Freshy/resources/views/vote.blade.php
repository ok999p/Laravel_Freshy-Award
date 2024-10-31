<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/CSS/vote.css')}}">
    <link rel="shortcut icon" href="{{asset('/Image/logo.png')}}" type="image/x-icon">
    <link href="https://db.onlinewebfonts.com/c/e695a2b548e145591a266fc50eb492e0?family=Regular" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&family=Estonia&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Spirax&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Vote WUFAS 2024</title>
    <style>
        body {
            background-image: url("{{asset('/Image/bgvote.jpg')}}");
            backdrop-filter: blur(10px);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }

    </style>
</head>

<body>
<div id="stars1"></div>
<div id="stars2"></div>
<div id="stars3"></div>
<div class="imglogo2">
    <img src="{{asset('/Image/logocrown.png')}}" alt="Photo Logo2_WUFA">
</div>
<div class="container2">
    <div class="shine">WU FRESHY AWARD 2024</div>
    <div class="shine" id="Subtitle">POPULAR VOTE</div>
</div>
<div class="container">
    <h2 class="glow">GRIL CANDIDATE</h2>
    <div class="card-container">
        <div class="card" onclick="toggleCardSelection(this, 'female')" id="candidate1">
            <div class="content">
                    <div class="back-content">
                        <img src="{{asset('/Image/Test1.png')}}" alt="Logo-WUFA" class="Logo-WUFA">
                        <img src="{{asset('/Image/GoldPC.png')}}" class="Paticel" style="display: none">
{{--                        <div class="text_container">--}}
                            <strong class="Pcandidate">M01</strong>
                            <strong class="Ncandidate">นายอัษฎาวุฒิ นาคทุ่งเตา</strong>
{{--                        </div>--}}
                    </div>
            </div>
        </div>
        <div class="card" onclick="toggleCardSelection(this, 'female')" id="candidate2">
            <div class="content">
                <div class="back-content">
                    <img src="{{asset('/Image/Test1.png')}}" alt="Logo-WUFA" class="Logo-WUFA">
                    <img src="{{asset('/Image/GoldPC.png')}}" class="Paticel" style="display: none">
                    {{--                        <div class="text_container">--}}
                    <strong class="Pcandidate">M01</strong>
                    <strong class="Ncandidate">นายอัษฎาวุฒิ นาคทุ่งเตา</strong>
                    {{--                        </div>--}}
                </div>
            </div>
        </div>
        <div class="card" onclick="toggleCardSelection(this, 'female')" id="candidate3">
            <div class="content">
                <div class="back-content">
                    <img src="{{asset('/Image/Test1.png')}}" alt="Logo-WUFA" class="Logo-WUFA">
                    <img src="{{asset('/Image/GoldPC.png')}}" class="Paticel" style="display: none">
                    {{--                        <div class="text_container">--}}
                    <strong class="Pcandidate">M01</strong>
                    <strong class="Ncandidate">นายอัษฎาวุฒิ นาคทุ่งเตา</strong>
                    {{--                        </div>--}}
                </div>
            </div>
        </div>


    </div>
    <form action="" class="vote-form">
        <button id="confirmButtonFemale" disabled class="disabled-button" onclick="confirmVote(event, 'female')">
            ไม่สามารถโหวตได้
        </button>
        <button type="button" id="Notvotting" onclick="noVote(event)">
            ไม่ประสงค์จะลงคะแนน
        </button>
    </form>
</div>
<footer id="footer-credit">
    <p id="footer-text">Copyright ©️ 2024 Teams IT SAB</p>
</footer>

<script src="{{asset('/JS/vote.js')}}"></script>
</body>

</html>

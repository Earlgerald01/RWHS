<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Level</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #A7E198;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
        }
        .user {
            text-align: center;
            margin-bottom: 20px;
        }
        .user img {
            width: 50px;
            border-radius: 50%;
        }
        .user p {
            margin-top: 10px;
            font-weight: bold;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            margin: 15px 0;
        }
        nav ul li a {
            text-decoration: none;
            font-weight: bold;
            color: black;
            display: block;
            text-align: center;
            padding: 10px;
            border: 2px solid white;
        }
        nav ul li a:hover {
            background-color: white;
        }
        .content {
            flex: 1;
            padding: 40px;
            background-color: #F3F3F3;
        }
        .content-box {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .content-box h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }
        .water-level {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .water-circle {
            width: 150px;
            height: 150px;
            background-color: #dcdcdc;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
        }
        .water-circle-inner {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #40a9ff;
            border-radius: 50%;
            height: 0%;
            transition: height 0.5s ease;
        }
        .water-percentage {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user">
        <img src="{{ asset('images/image-earl.jpeg') }}" alt="User Avatar">
            <p>User</p>
        </div>
        <nav>
        <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('waterlevel') }}">Water Level</a></li>
        <li><a href="{{ route('history') }}">History</a></li>
        </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="content-box">
            <h2>Water Level</h2>
            <div class="water-level">
                <div class="water-circle">
                    <div class="water-circle-inner" id="waterCircleInner"></div>
                    <div class="water-percentage" id="waterPercentage">0%</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-analytics.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyDRz5dPaZ-1U8WyhYUxOmQtWWmDCyyZt90",
            authDomain: "water-level-monitoring-d170a.firebaseapp.com",
            databaseURL: "https://water-level-monitoring-d170a-default-rtdb.firebaseio.com",
            projectId: "water-level-monitoring-d170a",
            storageBucket: "water-level-monitoring-d170a.appspot.com",
            messagingSenderId: "1005621492737",
            appId: "1:1005621492737:web:cbdc81715b3f8607dc5400",
            measurementId: "G-YX76Q8VZJL"
        };
        const app = firebase.initializeApp(firebaseConfig);
        const db = firebase.database();

        function fetchWaterLevel() {
            db.ref('waterLevel').on('value', (snapshot) => {
                const level = snapshot.val();
                updateWaterLevel(level);
            }, (error) => {
                console.error("Error fetching water level data:", error);
            });
        }

        function updateWaterLevel(level) {
            var waterCircleInner = document.getElementById('waterCircleInner');
            var waterPercentage = document.getElementById('waterPercentage');
            let percentage = (level / 200) * 100;
            percentage = Math.min(percentage, 100);
            waterCircleInner.style.height = percentage + '%';
            waterPercentage.innerText = Math.round(percentage) + '%';
        }

        fetchWaterLevel();
    </script>
</body>
</html>

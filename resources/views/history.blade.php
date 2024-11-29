<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-database.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Level History</title>
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

        /* Content Styling */
        .content {
            flex: 1;
            padding: 40px;
            background-color: #F3F3F3;
            margin-left: 220px; /* Adjusting margin for sidebar */
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

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #40a9ff;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user">
            <img src="path_to_avatar" alt="User Avatar">
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
            <h2>Water Level History</h2>
            <table id="historyTable">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Water Level (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- History data will be populated here -->
                </tbody>
            </table>
        </div>
    </div>

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

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

        // Function to fetch water level history from Firebase
        function fetchWaterLevelHistory() {
            const historyRef = database.ref('waterLevelHistory'); // Use your actual path in Firebase
            historyRef.on('value', (snapshot) => {
                const historyData = snapshot.val();
                const historyTableBody = document.getElementById('historyTable').getElementsByTagName('tbody')[0];
                historyTableBody.innerHTML = ''; // Clear existing rows

                for (const timestamp in historyData) {
                    const level = historyData[timestamp];
                    const newRow = historyTableBody.insertRow();
                    newRow.insertCell(0).innerText = timestamp;
                    newRow.insertCell(1).innerText = level + '%';
                }
            });
        }

        // Call the function to load the water level history when the page loads
        window.onload = fetchWaterLevelHistory;
    </script>
</body>
</html>

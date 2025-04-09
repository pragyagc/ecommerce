<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 1em;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        td img {
            max-width: 80px;
            height: auto;
            border-radius: 50%;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            font-size: 1.2em;
            color: #888;
        }

        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                padding: 8px;
                font-size: 0.9em;
            }

            h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Users Information</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Contact</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Profile Picture</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <!-- Data will be inserted here dynamically -->
            </tbody>
        </table>
        <div id="noDataMessage" class="no-data" style="display:none;">No user data available.</div>
    </div>

    <script>
        // Fetch data from PHP backend
        fetch('fetch_data.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('userTable');
            const noDataMessage = document.getElementById('noDataMessage');
            
            if (data.length === 0) {
                noDataMessage.style.display = 'block';
            } else {
                data.forEach(user => {
                    let profileImage = user.profile_image ? `<img src="${user.profile_image}" alt="Profile Image">` : 'No image';
                    let row = `<tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.password}</td>
                        <td>${user.contact}</td>
                        <td>${user.city}</td>
                        <td>${user.address}</td>
                        <td>${profileImage}</td>
                    </tr>`;
                    tableBody.innerHTML += row;
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>

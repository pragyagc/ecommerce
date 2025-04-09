<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Users Order Dashboard</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Id</th>
                    <th>Customer Name</th>
                    <th>Customer Address</th>
                    <th>Payment Method</th>
                    <th>Ordered Date</th>

                </tr>
            </thead>
            <tbody id="userTable">
                <!-- Data will be inserted here dynamically -->
            </tbody>
        </table>
    </div>

    <script>
        // Fetch data from PHP backend
        fetch('ordered_data.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('userTable');
            data.forEach(user => {
                let row = `<tr>
                    <td>${user.id}</td>
                    <td>${user.product_id}</td>
                    <td>${user.customer_name}</td>
                    <td>${user.customer_address}</td>
                    <td>${user.payment_method}</td>
                    <td>${user.order_date}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>

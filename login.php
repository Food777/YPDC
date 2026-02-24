<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
          crossorigin="anonymous">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            margin-bottom: 30px;
            color: #333;
            font-weight: 600;
            text-align: center;
        }

        table {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
            width: 450px;
        }

        td {
            padding: 10px 0;
        }

        h4 {
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            outline: none;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        input:focus {
            border-color: #64b5f6;
            box-shadow: 0 0 6px rgba(100, 181, 246, 0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            background-color: #64b5f6;
            border: none;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #42a5f5;
        }

        @media (max-width: 576px) {
            table {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <h1>Login Absensi Data Siswa</h1>

    <form action="login1.php" method="post">
        <table>
            <tr>
                <td colspan="2" class="text-center">
                    <h4>Silahkan Lohin</h4>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="name" placeholder="Username..." required autofocus></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Password..." required></td>
            </tr>
            <tr>
                <td><button type="submit">Login</button></td>
            </tr>
        </table>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" 
            crossorigin="anonymous"></script>
</body>
</html>

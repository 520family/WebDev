<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleAdmin.css">
</head>

<body>
    <?php include 'header.php';?>
    <div class="heading">
        <h3>List of Concerts</h3>
    </div>
    <div class="mainbox">
        <table>
            <tr>
                <th>ID</th>
                <th>Concert Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td>1001</td>
                <td>concert 1</td>
                <td><button id="button1"></button></td>
                <td><button id="button2"></button></td>
            </tr>
            <tr>
                <td>1002</td>
                <td>concert 2</td>
                <td><button id="button3"></button></td>
                <td><button id="button4"></button></td>
            </tr>
            <tr>
                <td>1003</td>
                <td>concert 3</td>
                <td><button id="button5"></button></td>
                <td><button id="button6"></button></td>
            </tr>
            <tr>
                <td>1004</td>
                <td>concert 4</td>
                <td><button id="button7"></button></td>
                <td><button id="button8"></button></td>
            </tr>
        </table>
        <button id="button">Add new concert</button>
    </div>
</body>

</html>
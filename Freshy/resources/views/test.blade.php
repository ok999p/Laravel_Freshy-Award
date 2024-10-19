<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Seat Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <table class="">
        <tbody>
            <tr>
                <!-- Loop for 23 seats in the row -->
                <td class="border border-gray-400 p-2">
                    <div class="text-center">
                        <img src="https://via.placeholder.com/50" alt="Seat" class="mx-auto">
                        <p class="text-sm mt-1">Seat 1</p>
                    </div>
                </td>
                <!-- Repeat the <td> for 23 columns, updating seat numbers -->
                <!-- Example for next seats -->
                <td class="border border-gray-400 p-2">
                    <div class="text-center">
                        <img src="https://via.placeholder.com/50" alt="Seat" class="mx-auto">
                        <p class="text-sm mt-1">Seat 2</p>
                    </div>
                </td>
                <!-- Continue for all 23 seats -->
            </tr>
            <!-- end of Row 1 -->
        </tbody>
    </table>
</body>
</html>

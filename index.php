<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Lari  </title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .running-schedule {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #4caf50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #4caf50;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button.running {
            background-color: #4caf50;
            color: #fff;
        }
        button.stop {
            background-color: #e74c3c;
            color: #fff;
        }
        button:hover {
            background-color: #45a049;
        }
        .timer-container {
            display: flex;
            align-items: center;
        }
        .timer {
            flex-grow: 1;
            text-align: left;
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <div class="running-schedule">
        <h2>Jadwal Lari Minggu Ini</h2>
        <table>
            <tr>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
            <?php
            function hitungDurasi($deskripsi) {
                if ($deskripsi == "Lari Ringan") {
                    return 10;
                } elseif ($deskripsi == "Lari Intervel") {
                    return 15;
                } else {
                    return 20;
                }
            }

            $jadwalLari = array(
                array("Senin", "07:00", "Lari Ringan"),
                array("Rabu", "07:00", "Lari Intervel"),
                array("Jumat", "07:00", "Lari Panjang")
            );

            foreach ($jadwalLari as $sesi) {
                echo "<tr>";
                echo "<td>{$sesi[0]}</td>";
                echo "<td>{$sesi[1]}</td>";
                echo "<td>{$sesi[2]}</td>";
                echo "<td><button onclick=\"pilihSesi('{$sesi[0]}', '{$sesi[1]}', '{$sesi[2]}')\">Pilih</button></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="3" style="text-align: right;">Waktu Berlari:</td>
                <td>
                    <div class="timer-container">
                        <div class="timer" id="timer"></div>
                        <button class="stop" onclick="berhenti()">Berhenti</button>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <script>
        var timer;
        var countdown;
        var isInterval = false;

        function hitungDurasi(deskripsi) {
            if (deskripsi == "Lari Ringan") {
                return 10;
            } else if (deskripsi == "Lari Intervel") {
                return 15;
            } else {
                return 20;
            }
        }

        function pilihSesi(hari, waktu, deskripsi) {
            alert("Anda memilih sesi pada " + hari + ", " + waktu + " dengan deskripsi: " + deskripsi);

            var durasi = hitungDurasi(deskripsi);

            var button = document.querySelector(".running-schedule button");
            button.classList.add("running");

            var timerElement = document.getElementById("timer");
            timerElement.innerHTML = durasi + " menit";

            isInterval = true;

            countdown = durasi * 60;
            timer = setInterval(function() {
                countdown--;
                timerElement.innerHTML = Math.floor(countdown / 60) + " menit " + (countdown % 60) + " detik";
                if (countdown <= 0) {
                    clearInterval(timer);
                    timerElement.innerHTML = "Waktu Habis!";
                    button.classList.remove("running");
                    isInterval = false;
                }
            }, 1000);
        }

        function berhenti() {
            if (isInterval) {
                clearInterval(timer);
                var button = document.querySelector(".running-schedule button.stop");
                button.classList.remove("running");
                document.getElementById("timer").innerHTML = "";
                isInterval = false;
            }
        }
    </script>
</body>
</html>

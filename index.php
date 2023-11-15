<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Toko Buku FCH</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8">Cari data buku atau penerbit masukkan ID anda!</h1>
        <div class="mb-4 flex space-x-4">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input class="flex-1 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="search_id" type="text" placeholder="ID Buku atau Penerbit">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" name="searchButton">Cari</button>
            </form>
        </div>

        <div class="mt-4">
            <table class="table-auto w-full border bg-white">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Buku</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Nama Buku</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Stok</th>
                        <th class="border px-4 py-2">Penerbit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $host = "localhost";
                    $user = "root";
                    $password = "";
                    $database = "perpustakaan";

                    $conn = mysqli_connect($host, $user, $password, $database);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }


                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchButton"])) {
                        $searchTerm = mysqli_real_escape_string($conn, $_POST["search_id"]);
                        $query = "SELECT id_buku, kategori, nama_buku, harga, stok, penerbit FROM buku WHERE id_buku LIKE '%$searchTerm%'";
                    } else {
                        $query = "SELECT id_buku, kategori, nama_buku, harga, stok, penerbit FROM buku";
                    }

                    $result = mysqli_query($conn, $query);
                    foreach ($result as $row) {
                        echo '<tr';
                        if (isset($searchTerm) && !empty($searchTerm) && stripos($row['id_buku'], $searchTerm) !== false) {
                            echo ' style="background-color: #FFEB3B;"';
                        }
                        echo '>';
                        echo '<td class="border px-4 py-2">' . $row['id_buku'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['kategori'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['nama_buku'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['harga'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['stok'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $row['penerbit'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <table class="table-auto w-full border bg-white">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Penerbit</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Alamat</th>
                        <th class="border px-4 py-2">Kota</th>
                        <th class="border px-4 py-2">Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchButton"])) {
                        $searchTerm = mysqli_real_escape_string($conn, $_POST["search_id"]);
                        $query = "SELECT * FROM penerbit WHERE id_penerbit LIKE '%$searchTerm%'";
                    } else {
                        $query = "SELECT * FROM penerbit";
                    }

                    $penerbit = mysqli_query($conn, $query);
                    foreach ($penerbit as $penerbit_book) {
                        echo '<tr';
                        if (isset($searchTerm) && !empty($searchTerm) && stripos($penerbit_book['id_penerbit'], $searchTerm) !== false) {
                            echo ' style="background-color: #FFEB3B;"';
                        }
                        echo '>';
                        echo '<td class="border px-3 py-1">' . $penerbit_book['id_penerbit'] . '</td>';
                        echo '<td class="border px-3 py-1">' . $penerbit_book['nama'] . '</td>';
                        echo '<td class="border px-3 py-1">' . $penerbit_book['alamat'] . '</td>';
                        echo '<td class="border px-3 py-1">' . $penerbit_book['kota'] . '</td>';
                        echo '<td class="border px-3 py-1">' . $penerbit_book['telepon'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
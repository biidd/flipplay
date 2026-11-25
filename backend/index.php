<?php

declare(strict_types=1);

// Memanggil file class
require_once __DIR__ . '/Models/Media.php';
require_once __DIR__ . '/Models/Video.php';
require_once __DIR__ . '/Models/DigitalReading.php';
require_once __DIR__ . '/Services/Library.php';
require_once __DIR__ . '/Users/User.php';

// Menggunakan namespace
use App\Models\Video;
use App\Models\DigitalReading;
use App\Models\Media;
use App\Services\Library;
use App\Users\User;

// Membuat objek Library dan User
$library = new Library();
$user = new User("Abid");

// Menambahkan data awal FlipPlay
$library->addMedia(
    new Video(
        1,
        "Naruto",
        "Anime tentang perjalanan seorang ninja.",
        "Anime"
    )
);

$library->addMedia(
    new Video(
        2,
        "One Piece",
        "Anime tentang petualangan mencari harta karun.",
        "Anime"
    )
);

$library->addMedia(
    new DigitalReading(
        3,
        "Solo Leveling",
        "Manga tentang perjalanan seorang hunter.",
        "Manga"
    )
);

$library->addMedia(
    new DigitalReading(
        4,
        "Laskar Pelangi",
        "Novel tentang perjuangan anak-anak di Belitung.",
        "Novel"
    )
);

// ID untuk media baru
$nextId = 5;

function showMenu(): void
{
    echo "\n";
    echo "====================================\n";
    echo "              FLIPPLAY              \n";
    echo "====================================\n";
    echo "1. Tambahkan Media\n";
    echo "2. Tampilkan Semua Media\n";
    echo "3. Cari Media Berdasarkan Judul\n";
    echo "4. Lihat Detail Media\n";
    echo "5. Tambahkan Media ke Koleksi\n";
    echo "6. Tampilkan Koleksi Pengguna\n";
    echo "0. Keluar\n";
    echo "====================================\n";
}

$running = true;

while ($running) {

    showMenu();

    $choice = readline("Pilih menu: ");

    switch ($choice) {

        // Menu 1: Tambahkan media
        case "1":
            echo "\nPILIH JENIS MEDIA\n";
            echo "1. Anime / Drama\n";
            echo "2. Manga / Novel\n";

            $typeChoice = readline("Pilih jenis: ");

            $title = readline("Masukkan judul: ");
            $description = readline("Masukkan deskripsi: ");

            if ($typeChoice === "1") {
                $media = new Video(
                    $nextId,
                    $title,
                    $description,
                    "Anime / Drama"
                );
            } elseif ($typeChoice === "2") {
                $media = new DigitalReading(
                    $nextId,
                    $title,
                    $description,
                    "Manga / Novel"
                );
            } else {
                echo "Jenis media tidak valid!\n";
                break;
            }

            $library->addMedia($media);

            echo "Media berhasil ditambahkan!\n";
            $nextId++;
            break;

        // Menu 2: Tampilkan semua media
        case "2":
            echo "\nDAFTAR MEDIA FLIPPLAY\n";

            foreach ($library->getAllMedia() as $media) {
                echo "ID: " . $media->getId() . "\n";
                echo "Judul: " . $media->getTitle() . "\n";
                echo "Kategori: " . $media->getCategory() . "\n";
                echo "--------------------------\n";
            }
            break;

        // Menu 3: Cari media
        case "3":
            $keyword = readline("Masukkan judul yang dicari: ");

            $result = $library->searchByTitle($keyword);

            if ($result !== null) {
                echo "\nMedia ditemukan!\n";
                echo $result->getDetail() . "\n";
            } else {
                echo "Media tidak ditemukan!\n";
            }
            break;

        // Menu 4: Detail media
        case "4":
            $id = (int) readline("Masukkan ID media: ");

            $result = $library->findById($id);

            if ($result !== null) {
                echo "\nDETAIL MEDIA\n";
                echo $result->getDetail() . "\n";
            } else {
                echo "Media dengan ID tersebut tidak ditemukan!\n";
            }
            break;

        // Menu 5: Tambahkan ke koleksi
        case "5":
            $id = (int) readline("Masukkan ID media: ");

            $result = $library->findById($id);

            if ($result !== null) {
                $user->addToCollection($result);

                echo $result->getTitle();
                echo " berhasil ditambahkan ke koleksi ";
                echo $user->getName() . "!\n";
            } else {
                echo "Media tidak ditemukan!\n";
            }
            break;

        // Menu 6: Tampilkan koleksi pengguna
        case "6":
            echo "\nKOLEKSI MILIK " . strtoupper($user->getName()) . "\n";

            $collection = $user->getCollection();

            if (empty($collection)) {
                echo "Koleksi masih kosong.\n";
            } else {
                foreach ($collection as $media) {
                    echo "ID: " . $media->getId() . "\n";
                    echo "Judul: " . $media->getTitle() . "\n";
                    echo "Kategori: " . $media->getCategory() . "\n";
                    echo "--------------------------\n";
                }
            }
            break;

        // Menu 0: Keluar
        case "0":
            echo "Terima kasih telah menggunakan FlipPlay!\n";
            $running = false;
            break;

        default:
            echo "Pilihan tidak valid. Silakan coba lagi.\n";
            break;
    }
}


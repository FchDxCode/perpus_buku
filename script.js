const mysql = require('mysql');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'perpustakaan',
});

const dataBuku = [
  {
    id_buku: "K1001",
    kategori: "Keilmuan",
    harga: 50000,
    stok: 60,
    penerbit: "Penerbit informatika",
    nama_buku: "Analisis & Perancangan Sistem Informasi",
  },
  {
    id_buku: "K1002",
    kategori: "Keilmuan",
    harga: 45000,
    stok: 60,
    penerbit: "Penerbit Informatika",
    nama_buku: "Artificial Intelligence",
  },
  {
    id_buku: "K2003",
    kategori: "Keilmuan",
    harga: 40000,
    stok: 25,
    penerbit: "Penerbit Informatika",
    nama_buku: "Autocad 3 Dimensi",
  },
  {
    id_buku: "B1001",
    kategori: "Bisnis Online",
    harga: 75000,
    stok: 9,
    penerbit: "Penerbit Informatika",
    nama_buku: "Keilmuan",
  },
  {
    id_buku: "K3004",
    kategori: "Keilmuan",
    harga: 85000,
    stok: 15,
    penerbit: "Penerbit Informatika",
    nama_buku: "Cloud Computing Technology",
  },
  {
    id_buku: "81002",
    kategori: "Bisnis",
    harga: 67500,
    stok: 20,
    penerbit: "Penerbit informatika",
    nama_buku: "Etika Bisnis dan Tanggung Jawab Sosial",
  },
  {
    id_buku: "N1001",
    kategori: "Novel",
    harga: 68000,
    stok: 10,
    penerbit: "Andi Offset.",
    nama_buku: "Cahaya Di Penjuru Rati",
  },
  {
    id_buku: "N1002",
    kategori: "Novel",
    harga: 48000,
    stok: 12,
    penerbit: "Danendra",
    nama_buku: "Aku Ingin Cerita",
  },
];

const dataPenerbit = [
  {
    id_penerbit: "SP01",
    nama: "Penerbit Informatika",
    alamat: "Jl. Buah Batu No .121",
    kota: "Bandung",
    telepon: "0813-2220-1946",
  },
  {
    id_penerbit: "SP02",
    nama: "Andi Offset",
    alamat: "Jl. Suryalaya IX No.3",
    kota: "Bandung",
    telepon: "0878-3903-0688",
  },
  {
    id_penerbit: "SP03",
    nama: "Danendra",
    alamat: "Jl Moch. Toha 441",
    kota: "Bandung",
    telepon: "022-5201215",
  },
];

function insertDataBuku() {
  dataBuku.forEach((buku) => {
    const query = `INSERT INTO buku (id_buku, kategori, nama_buku, harga, stok, penerbit) VALUES (?, ?, ?, ?, ?, ?)`;
    const values = [buku.id_buku, buku.kategori, buku.nama_buku, buku.harga, buku.stok, buku.penerbit];

    connection.query(query, values, (error, results, fields) => {
      if (error) throw error;
      console.log(`Data buku ${buku.nama_buku} berhasil dimasukkan!`);
    });
  });
}

function insertDataPenerbit() {
  dataPenerbit.forEach((penerbit) => {
    const query = `INSERT INTO penerbit (id_penerbit, nama, alamat, kota, telepon) VALUES (?, ?, ?, ?, ?)`;
    const values = [penerbit.id_penerbit, penerbit.nama, penerbit.alamat, penerbit.kota, penerbit.telepon];

    connection.query(query, values, (error, results, fields) => {
      if (error) throw error;
      console.log(`Data penerbit ${penerbit.nama} berhasil dimasukkan!`);
    });
  });
}

connection.connect((error) => {
  if (error) throw error;

  insertDataBuku();

  insertDataPenerbit();

  connection.end();
});
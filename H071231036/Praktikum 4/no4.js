function tebakAngka() {
    const angkaTersembunyi = Math.floor(Math.random() * 100) + 1;
    let tebakan = 0;
    let jumlahTebakan = 0;
    let selesai = false;

    while (!selesai) {
        tebakan = parseInt(prompt("Tebak sebuah angka antara 1 dan 100: "), 10);
        jumlahTebakan++;

        if (tebakan < angkaTersembunyi) {
            alert("Terlalu rendah! Coba lagi.");
        } else if (tebakan > angkaTersembunyi) {
            alert("Terlalu tinggi! Coba lagi.");
        } else if (tebakan === angkaTersembunyi) {
            alert(`Selamat! Kamu berhasil menebak angka ${angkaTersembunyi} dalam ${jumlahTebakan} tebakan.`);
            selesai = true;
        } else {
            alert("Masukkan angka yang valid!");
        }
    }
}

tebakAngka();

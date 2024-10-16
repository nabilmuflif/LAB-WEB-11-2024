const daysOfWeek = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

function findFutureDay(currentDay, daysAhead) {

    const currentIndex = daysOfWeek.indexOf(currentDay);

    if (currentIndex === -1) {
        return "Hari yang dimasukkan tidak valid";
    }

    const futureIndex = (currentIndex + daysAhead) % 7;

    return daysOfWeek[futureIndex];
}

const hariSekarang = "Kamis";
const jumlahHari = 1000;

const hariMendatang = findFutureDay(hariSekarang, jumlahHari);
console.log(`Hari ${jumlahHari} hari dari sekarang adalah: ${hariMendatang}`);

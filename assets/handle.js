const form = document.getElementById('form');
const ktp = document.getElementById('ktp');
const nama = document.getElementById('nama');
const tgllahir = document.getElementById('tgllahir');
const usia = document.getElementById('usia');
const jenkel = document.getElementById('jenkel');
const nohp = document.getElementById('nohp');
const alamat = document.getElementById('alamat');

form.addEventListener('submit', e => {
e.preventDefault();
if (checkFormValidity()) {
    form.submit();
}
});

const setError = (element, message) => {
const inputControl = element.parentElement;
const errorDisplay = inputControl.querySelector('.error');

errorDisplay.innerText = message;
inputControl.classList.add('error');
inputControl.classList.remove('success');
}

const setSuccess = element => {
const inputControl = element.parentElement;
const errorDisplay = inputControl.querySelector('.error');

errorDisplay.innerText = '';
inputControl.classList.add('success');
inputControl.classList.remove('error');
};

const checkFormValidity = () => {
let isValid = true;

const ktpValue = ktp.value.trim();
const namaValue = nama.value.trim();
const tgllahirValue = tgllahir.value.trim();
const usiaValue = usia.value.trim();
const jenkelValue = jenkel.value.trim();
const nohpValue = nohp.value.trim();
const alamatValue = alamat.value.trim();

if (ktpValue === '') {
    setError(ktp, 'Kolom KTP masih kosong');
    isValid = false;
} else {
    setSuccess(ktp);
}

if (namaValue === '') {
    setError(nama, 'Kolom nama masih kosong');
    isValid = false;
} else if (!isValidName(namalValue)) {
    setError(nama, 'Nama yang diinputkan tidak valid.');
    isValid = false;
} else {
    setSuccess(nama);
}

if (tgllahirValue === '') {
    setError(tgllahir, 'Tanggal lahir masih kosong.');
    isValid = false;
} else {
    setSuccess(tgllahir);
}

if (usiaValue === '') {
    setError(usia, 'Kolom usia masih kosong.');
    isValid = false;
} else {
    setSuccess(usia);
}

if (jenkelValue === '') {
    setError(jenkel, 'Pilih jenis kelamin anda.');
    isValid = false;
} else {
    setSuccess(jenkel);
}

if (nohpValue === '') {
    setError(nohp, 'Isikan nomor hp anda.');
    isValid = false;
} else {
    setSuccess(nohp);
}

if (alamatValue === '') {
    setError(alamat, 'Isikan almat anda. ');
    isValid = false;
} else {
    setSuccess(alamat);
}

return isValid;
};
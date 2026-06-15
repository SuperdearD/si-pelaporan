# **Dokumen Desain UI/UX: Modifikasi Panel Laravel Filament (Edisi Minimalis & Golden Ratio)**

## **1\. Visi Desain**

Mengubah antarmuka bawaan Laravel Filament menjadi sistem desain yang minimalis, ringan, dan elegan. Fokus utama adalah mengeliminasi elemen visual yang berlebihan (border tebal, bayangan gelap) dan menggantinya dengan ruang putih (*whitespace*) yang lega, proporsi *Golden Ratio* (1:1.618), palet warna biru langit utama, serta warna status yang *soft* agar selaras dan tidak bertabrakan.

## **2\. Tipografi (Tegas Namun Lugas)**

Untuk mencapai kesan "tegas namun lugas", kita meninggalkan font sistem standar dan menggunakan rupa huruf geometris yang modern. Font ini memiliki garis yang tegas, tingkat keterbacaan (legibility) yang sangat tinggi, namun tetap terlihat profesional dan bersih.

* **Font Family Utama:** **Plus Jakarta Sans** (Alternatif: *Manrope* atau *Geist*).  
* **Karakteristik Visual:** Bentuk melingkar yang proporsional, ujung garis yang tegas tanpa *serif*, dan spasi antar huruf (*tracking*) yang natural.  
* **Hierarki Font:**  
  * **Heading (Judul Halaman/Widget):** *Font-weight* Bold (700) atau Semi-bold (600), warna Text Primary. Tracking sedikit dirapatkan (tracking-tight).  
  * **Body (Tabel/Form):** *Font-weight* Medium (500) untuk label, Regular (400) untuk isi data. Warna Text Primary.  
  * **Caption/Bantuan:** *Font-weight* Regular (400), ukuran text-sm, warna Text Muted.

## **3\. Palet Warna (Soft & Harmonious)**

Implementasi warna pada Filament dilakukan melalui pendaftaran warna khusus di AdminPanelProvider.php menggunakan fitur Colors::register().

### **A. Warna Utama (Sky Blue Minimalist)**

| Peran | Kode HEX / Referensi | Penggunaan Utama |
| :---- | :---- | :---- |
| **Primary** | \#0ea5e9 (Sky 500\) | Tombol utama, aksi aktif, *ring* fokus, dan *progress bar*. |
| **Secondary** | \#e0f2fe (Sky 100\) | *Hover state* pada menu, latar belakang ikon, status aktif sekunder. |
| **Background** | \#f8fafc (Slate 50\) | Latar belakang halaman utama (luar kartu/panel). |
| **Surface** | \#ffffff (White) | Latar belakang *widget*, tabel, dan formulir. |
| **Text Primary** | \#0f172a (Slate 900\) | Judul, teks utama, dan label data. |
| **Text Muted** | \#64748b (Slate 500\) | Sub-judul, *placeholder*, dan teks bantuan. |
| **Border** | \#f1f5f9 (Slate 100\) | Garis pemisah antar elemen yang sangat tipis dan halus. |

### **B. Warna Status (Soft / Pastel)**

Agar tidak menutupi kelembutan warna *Sky Blue*, warna indikator (Sukses, Peringatan, Bahaya) diturunkan saturasinya dan menggunakan varian *soft* (pastel) untuk *background* *badge*, namun tetap tegas untuk warna teksnya.

| Status | Latar Belakang (Soft) | Teks & Ikon (Tegas) | Filament Color Map |
| :---- | :---- | :---- | :---- |
| **Success (Hijau)** | \#d1fae5 (Emerald 100\) | \#059669 (Emerald 600\) | Gunakan *Emerald* daripada *Green* agar lebih segar. |
| **Warning (Kuning)** | \#fef3c7 (Amber 100\) | \#d97706 (Amber 600\) | Gunakan *Amber* daripada *Yellow* agar kontras teks mudah dibaca. |
| **Danger (Merah)** | \#ffe4e6 (Rose 100\) | \#e11d48 (Rose 600\) | Gunakan *Rose* (sedikit ke arah pink/lembut) ketimbang murni *Red* agar harmonis dengan *Sky Blue*. |

## **4\. Sistem Tata Letak (Golden Ratio 1:1.618)**

Keseimbangan visual yang natural dicapai dengan menerapkan *Golden Ratio*. Angka ini (pendekatan rasio 5:8 atau 3:5) harus diimplementasikan pada proporsi grid Filament.

* **Grid Formulir (Form Layouts):**  
  * Gunakan pembagian Grid::make(5).  
  * **Area Input Utama:** Dialokasikan columnSpan(3) (sekitar 60%). Berisi form input panjang seperti Nama, Deskripsi, Editor Teks.  
  * **Area Meta/Samping:** Dialokasikan columnSpan(2) (sekitar 40%). Berisi pengaturan waktu, status dropdown, atau unggah gambar.  
* **Lebar Sidebar (Navigation):**  
  * Lebar sidebar disesuaikan menjadi sekitar 280px hingga 320px (bergantung resolusi), sementara area konten mengambil sisa ruang yang jauh lebih luas untuk menjaga rasio 1 : 1.6 pada monitor desktop standar (1080p).  
* **Ruang Kosong (Whitespace):**  
  * Terapkan pendekatan *Breathable UI*. Tambahkan margin dan padding yang lebih besar. Pada konfigurasi Filament, hindari *layout* bertipe compact. Gunakan ukuran default atau beri ekstra padding p-6 hingga p-8 antar *section*.

## **5\. Modifikasi Komponen Khusus Filament**

Penyesuaian spesifik pada *component* UI Filament untuk menguatkan gaya minimalis.

* **Cards & Panels:** \* Hilangkan *drop shadow* tebal bawaan (shadow-md atau shadow-lg).  
  * **Aturan:** Gunakan shadow-none dan tambahkan border border-slate-100 dengan *rounded corners* rounded-2xl. Latar belakang harus putih mutlak \#ffffff.  
* **Tabel:** \* Hilangkan border vertikal (*column dividers*).  
  * Gunakan garis horizontal sangat tipis (border-b border-slate-100).  
  * Ganti latar belakang baris yang bergaris-garis (*striped*) dengan warna putih solid yang berubah menjadi bg-sky-50 secara halus (transisi 150ms) saat di-*hover*.  
* **Tombol (Buttons):** \* Hapus efek gradien dan *shadow* pada tombol.  
  * Tombol utama (*Primary*): Background bg-sky-500, text text-white, rounded-xl.  
  * Tombol sekunder (*Secondary*): Background bg-white, text text-slate-700, border border-slate-200.  
* **Form Inputs & Selects:** \* Latar belakang input \#f8fafc (sedikit abu-abu terang) yang berubah menjadi putih mutlak \#ffffff dengan ring ring-2 ring-sky-200 saat dalam *state focus*.  
  * Hapus border gelap; ganti dengan border-transparent saat normal.  
* **Badges (Pill Status):**  
  * Gunakan bentuk kapsul penuh (rounded-full).  
  * Terapkan skema warna "Soft" di atas (Contoh: Latar Rose 100, Teks Rose 600 untuk status Gagal/Dihapus).

## **6\. Parameter Keberhasilan (Success Criteria)**

Acuan teknis (QA/Testing) bagi *developer* atau agen pelaksana untuk memastikan desain sesuai spesifikasi.

1. **Validasi Tipografi:** Teks di seluruh panel menggunakan font *Plus Jakarta Sans*. Judul terlihat lebih tegas dibandingkan font sistem bawaan.  
2. **Validasi Warna Status:** Tidak ada warna merah, kuning, atau hijau yang mencolok/neon. Semua *badge* status menggunakan warna pastel pada *background* (warna dengan index 100 pada Tailwind) dan teks yang tetap dapat dibaca (index 600).  
3. **Validasi Layout:** Halaman *Resource Create/Edit* membagi layar menjadi rasio 3:2 atau proporsi yang secara visual mirip dengan porsi layar 60% konten dan 40% *sidebar* pengaturan form (Golden Ratio).  
4. **Validasi Komponen *Flat*:** Seluruh antarmuka Filament (kartu statistik, form, tabel) bebas dari *box-shadow* yang berat/gelap. Estetika yang terbentuk adalah *flat design* dengan batas elemen yang hanya ditegaskan oleh *border* berwarna sangat tipis (\#f1f5f9).  
5. **Harmoni Visual:** Saat halaman dilihat utuh, warna dominan yang terasa adalah Putih, Biru Langit (*Sky*), dengan aksen status yang lembut. Teks berwarna Slate-900 memastikan informasi (data tabel) tetap menjadi hirarki paling mencolok.
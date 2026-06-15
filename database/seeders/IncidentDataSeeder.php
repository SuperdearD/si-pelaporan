<?php

namespace Database\Seeders;

use App\Models\Accident;
use App\Models\DevelopmentProgress;
use App\Models\DevelopmentReport;
use App\Models\FollowUpProgress;
use App\Models\Incident;
use App\Models\IncidentCause;
use App\Models\IncidentDevelopment;
use App\Models\IncidentFollowUp;
use App\Models\User;
use Illuminate\Database\Seeder;

class IncidentDataSeeder extends Seeder
{
    /**
     * Seed data insiden, kecelakaan, penyebab, tindak lanjut, dan pengembangan
     * dengan skenario realistis di lingkungan pertambangan.
     */
    public function run(): void
    {
        // Ambil user untuk relasi
        $users = User::all();
        $picUser = $users->firstWhere('email', 'pic@sispensi.com');
        $picUser2 = $users->firstWhere('email', 'pic2@sispensi.com');
        $userPelapor1 = $users->firstWhere('email', 'user@sispensi.com');
        $userPelapor2 = $users->firstWhere('email', 'user2@sispensi.com');
        $userPelapor3 = $users->firstWhere('email', 'user3@sispensi.com');
        $direktur = $users->firstWhere('email', 'direktur@sispensi.com');

        // =====================================================
        // INSIDEN 1: Unit HD Tergelincir di Hauling Road
        // Status: Sudah diapprove, follow up closed
        // =====================================================
        $incident1 = Incident::create([
            'date'            => '2026-05-10',
            'time'            => '14:30:00',
            'department'      => 'Mining Operation',
            'position'        => 'Operator HD 785',
            'age'             => 35,
            'work_experience' => '8 Tahun 3 Bulan',
            'responsibility'  => 'Mengoperasikan unit HD 785 untuk hauling overburden dari Pit Barat menuju disposal area.',
            'is_approved'     => true,
            'approved_by'     => $direktur?->id,
        ]);
        $incident1->users()->attach([$userPelapor1->id]);

        Accident::create([
            'incident_id'          => $incident1->id,
            'accident_place'       => 'Hauling Road KM 12, area tikungan sebelum jembatan timbang',
            'accident_condition'   => 'Hujan deras selama 2 jam, jalan licin berlumpur, jarak pandang terbatas (<50m)',
            'accident_description' => 'Saat unit HD 785 melewati tikungan KM 12 dalam kondisi hujan deras, operator kehilangan traksi pada roda belakang kiri karena lumpur tebal. Unit tergelincir ke sisi kiri jalan dan berhenti di bahu jalan. Tidak ada korban jiwa, namun body truck mengalami kerusakan minor pada sisi kiri bawah.',
            'safety_incidents'     => 'Unit Tergelincir (Skidding)',
        ]);

        IncidentCause::create([
            'incident_id'    => $incident1->id,
            'unsafe_action'  => 'Kecepatan unit tidak dikurangi saat memasuki area tikungan dalam kondisi hujan',
            'unsafe_condition' => 'Permukaan hauling road berlumpur dan tidak ada grading darurat saat hujan',
            'person_factor'  => 'Operator mengalami kelelahan (fatigue) setelah 6 jam operasi tanpa istirahat',
            'job_factor'     => 'Kurangnya pengawasan langsung dari foreman di area hauling road',
            'env_factor'     => 'Curah hujan ekstrem yang menyebabkan genangan air dan lumpur tebal di permukaan jalan',
        ]);

        $followUp1 = IncidentFollowUp::create([
            'incident_id'          => $incident1->id,
            'corrective_action'    => 'Perbaikan dan grading hauling road KM 10 – KM 14 dengan penambahan material sirtu',
            'target_pengendalian'  => 7,
            'bentuk_pengendalian'  => 'Engineering Control',
            'penanggung_jawab'     => 'Dept. Head Mining Operation',
            'status'               => 'closed',
            'status_approval'      => 'Disetujui',
            'catatan_revisi'       => null,
            'progress'             => 100,
        ]);

        FollowUpProgress::create([
            'incident_follow_up_id' => $followUp1->id,
            'message_id'            => 'PRG-26-001',
            'pic'                   => 'Agus Prasetyo (Foreman)',
            'keterangan'            => 'Grading jalan sudah dilakukan dari KM 10 sampai KM 12. Material sirtu sudah ditebar.',
            'persentase_progress'   => 50,
            'file'                  => null,
        ]);

        FollowUpProgress::create([
            'incident_follow_up_id' => $followUp1->id,
            'message_id'            => 'PRG-26-002',
            'pic'                   => 'Agus Prasetyo (Foreman)',
            'keterangan'            => 'Grading KM 12 – KM 14 selesai. Bund wall di tikungan diperkuat dan ditinggikan.',
            'persentase_progress'   => 100,
            'file'                  => null,
        ]);

        $followUp1b = IncidentFollowUp::create([
            'incident_id'          => $incident1->id,
            'corrective_action'    => 'Sosialisasi SOP berkendara saat hujan kepada seluruh operator HD',
            'target_pengendalian'  => 3,
            'bentuk_pengendalian'  => 'Administrative Control',
            'penanggung_jawab'     => 'Supervisor HSE',
            'status'               => 'closed',
            'status_approval'      => 'Disetujui',
            'catatan_revisi'       => null,
            'progress'             => 100,
        ]);

        $dev1 = IncidentDevelopment::create([
            'incident_id'          => $incident1->id,
            'bentuk_pengembangan'  => 'Instalasi sistem sensor kecepatan otomatis pada seluruh unit HD di area hauling',
            'hasil_pengembangan'   => 'Alarm otomatis berbunyi jika unit melebihi batas kecepatan 30 km/jam saat kondisi hujan',
            'persentase'           => 100,
            'status'               => 'completed',
            'tanggal'              => '2026-06-01',
            'user_id'              => $picUser?->id,
        ]);

        DevelopmentProgress::create([
            'incident_development_id' => $dev1->id,
            'message_id'              => 'DEV-MSG-001',
            'pic'                     => 'Tim Engineering',
            'tanggal'                 => '2026-05-20',
            'hasil_progress'          => 'Survey kebutuhan sensor dan pemesanan alat dari vendor sudah dilakukan.',
            'persentase'              => 30,
            'file'                    => null,
        ]);

        DevelopmentProgress::create([
            'incident_development_id' => $dev1->id,
            'message_id'              => 'DEV-MSG-002',
            'pic'                     => 'Tim Engineering',
            'tanggal'                 => '2026-05-28',
            'hasil_progress'          => 'Sensor terpasang pada 10 unit HD pertama. Testing berjalan lancar.',
            'persentase'              => 75,
            'file'                    => null,
        ]);

        DevelopmentReport::create([
            'incident_development_id' => $dev1->id,
            'message_id'              => 'REP-FINAL-001',
            'hasil'                   => 'Sensor kecepatan otomatis berhasil terpasang pada 20 unit HD dan berfungsi dengan baik. Alarm berbunyi saat kecepatan melebihi 30 km/jam.',
            'kesimpulan'              => 'Sistem sensor efektif dalam membatasi kecepatan unit HD di area hauling. Sejak pemasangan, tidak ada insiden terkait kecepatan berlebih.',
            'rekomendasi'             => 'Direkomendasikan untuk memasang sensor serupa pada unit medium (Excavator, Dozer) dan mempertimbangkan integrasi dengan sistem FMS.',
        ]);


        // =====================================================
        // INSIDEN 2: Kebocoran Bahan Bakar di Fuel Station
        // Status: Belum diapprove, follow up on_progress
        // =====================================================
        $incident2 = Incident::create([
            'date'            => '2026-05-25',
            'time'            => '08:15:00',
            'department'      => 'Plant & Maintenance',
            'position'        => 'Mekanik Senior',
            'age'             => 42,
            'work_experience' => '15 Tahun',
            'responsibility'  => 'Melakukan pengisian bahan bakar (refueling) unit-unit berat di fuel station utama.',
            'is_approved'     => false,
            'approved_by'     => null,
        ]);
        $incident2->users()->attach([$userPelapor2->id]);

        Accident::create([
            'incident_id'          => $incident2->id,
            'accident_place'       => 'Fuel Station Utama, area pompa nomor 3',
            'accident_condition'   => 'Cuaca cerah, area kering, suhu 33°C',
            'accident_description' => 'Saat proses pengisian solar ke unit Excavator Komatsu PC2000, selang distribusi nomor 3 mengalami kebocoran pada sambungan coupling. Solar tumpah ke area drainase fuel station sekitar 200 liter sebelum petugas berhasil menutup valve manual. Tidak ada korban jiwa atau kebakaran.',
            'safety_incidents'     => 'Tumpahan Bahan Bakar (Fuel Spill)',
        ]);

        IncidentCause::create([
            'incident_id'    => $incident2->id,
            'unsafe_action'  => 'Petugas tidak melakukan inspeksi visual pada selang dan coupling sebelum pengisian',
            'unsafe_condition' => 'Coupling selang nomor 3 sudah aus dan belum diganti sesuai jadwal maintenance',
            'person_factor'  => 'Petugas sudah berpengalaman sehingga timbul rasa aman berlebih (complacency)',
            'job_factor'     => 'Jadwal penggantian komponen selang tidak dipantau secara rutin oleh supervisor',
            'env_factor'     => 'Suhu tinggi mempercepat keausan material karet pada coupling',
        ]);

        $followUp2 = IncidentFollowUp::create([
            'incident_id'          => $incident2->id,
            'corrective_action'    => 'Penggantian seluruh selang dan coupling di fuel station. Pembersihan area tumpahan sesuai SOP lingkungan.',
            'target_pengendalian'  => 5,
            'bentuk_pengendalian'  => 'Engineering Control',
            'penanggung_jawab'     => 'Dept. Head Plant',
            'status'               => 'on_progress',
            'status_approval'      => null,
            'catatan_revisi'       => null,
            'progress'             => 60,
        ]);

        FollowUpProgress::create([
            'incident_follow_up_id' => $followUp2->id,
            'message_id'            => 'PRG-26-003',
            'pic'                   => 'Rizky Maulana (Mekanik)',
            'keterangan'            => 'Selang nomor 3 sudah diganti. Pembersihan tumpahan solar sedang berlangsung menggunakan absorbent.',
            'persentase_progress'   => 60,
            'file'                  => null,
        ]);

        $followUp2b = IncidentFollowUp::create([
            'incident_id'          => $incident2->id,
            'corrective_action'    => 'Buat checklist inspeksi harian untuk seluruh komponen fuel station',
            'target_pengendalian'  => 3,
            'bentuk_pengendalian'  => 'Administrative Control',
            'penanggung_jawab'     => 'Supervisor Plant',
            'status'               => 'open',
            'status_approval'      => null,
            'catatan_revisi'       => null,
            'progress'             => 0,
        ]);


        // =====================================================
        // INSIDEN 3: Near Miss - Excavator Hampir Menabrak Light Vehicle
        // Status: Sudah diapprove, follow up on_progress
        // =====================================================
        $incident3 = Incident::create([
            'date'            => '2026-06-02',
            'time'            => '10:45:00',
            'department'      => 'Mining Operation',
            'position'        => 'Operator Excavator PC2000',
            'age'             => 29,
            'work_experience' => '4 Tahun 6 Bulan',
            'responsibility'  => 'Melakukan loading overburden di Pit Timur untuk diangkut unit HD ke disposal area.',
            'is_approved'     => true,
            'approved_by'     => $direktur?->id,
        ]);
        $incident3->users()->attach([$userPelapor3->id, $userPelapor1->id]);

        Accident::create([
            'incident_id'          => $incident3->id,
            'accident_place'       => 'Pit Timur, front loading area dekat bench 4',
            'accident_condition'   => 'Cuaca berawan, debu cukup tebal di area pit, visibilitas sedang',
            'accident_description' => 'Saat Excavator PC2000 melakukan swing untuk loading ke HD, sebuah light vehicle (Toyota Land Cruiser) melintas di radius swing tanpa komunikasi radio terlebih dahulu. Operator excavator berhasil menghentikan swing tepat waktu. Jarak terdekat antara bucket dan LV hanya sekitar 3 meter. Tidak ada kontak fisik maupun korban.',
            'safety_incidents'     => 'Near Miss - Kontak Unit Berat dengan Light Vehicle',
        ]);

        IncidentCause::create([
            'incident_id'    => $incident3->id,
            'unsafe_action'  => 'Pengemudi LV memasuki radius operasi excavator tanpa komunikasi radio dan tanpa izin dari operator',
            'unsafe_condition' => 'Tidak ada barricade atau rambu pembatas radius swing excavator di front loading',
            'person_factor'  => 'Pengemudi LV terburu-buru karena ada meeting manajemen dan mengambil jalur pintas',
            'job_factor'     => 'Pengawas lapangan tidak memastikan semua LV berkomunikasi radio sebelum memasuki area pit',
            'env_factor'     => 'Debu tebal dari aktivitas loading mengurangi visibilitas di sekitar area kerja',
        ]);

        $followUp3 = IncidentFollowUp::create([
            'incident_id'          => $incident3->id,
            'corrective_action'    => 'Pemasangan barricade dan rambu peringatan radius swing di seluruh front loading aktif',
            'target_pengendalian'  => 10,
            'bentuk_pengendalian'  => 'Engineering Control',
            'penanggung_jawab'     => 'Supervisor Mining Operation',
            'status'               => 'on_progress',
            'status_approval'      => 'Disetujui',
            'catatan_revisi'       => null,
            'progress'             => 40,
        ]);

        FollowUpProgress::create([
            'incident_follow_up_id' => $followUp3->id,
            'message_id'            => 'PRG-26-004',
            'pic'                   => 'Doni Firmansyah (Pengawas)',
            'keterangan'            => 'Barricade sudah terpasang di 2 dari 5 front loading aktif. Menunggu material tambahan.',
            'persentase_progress'   => 40,
            'file'                  => null,
        ]);

        $followUp3b = IncidentFollowUp::create([
            'incident_id'          => $incident3->id,
            'corrective_action'    => 'Briefing wajib setiap shift tentang aturan komunikasi radio di area pit',
            'target_pengendalian'  => 2,
            'bentuk_pengendalian'  => 'Administrative Control',
            'penanggung_jawab'     => 'Foreman Shift',
            'status'               => 'closed',
            'status_approval'      => 'Disetujui',
            'catatan_revisi'       => null,
            'progress'             => 100,
        ]);

        $dev3 = IncidentDevelopment::create([
            'incident_id'          => $incident3->id,
            'bentuk_pengembangan'  => 'Implementasi sistem proximity detection (CAS) pada seluruh unit berat dan LV',
            'hasil_pengembangan'   => 'Alarm otomatis berbunyi jika LV berada dalam jarak 10 meter dari unit berat yang sedang beroperasi',
            'persentase'           => 25,
            'status'               => 'active',
            'tanggal'              => '2026-07-15',
            'user_id'              => $picUser2?->id,
        ]);

        DevelopmentProgress::create([
            'incident_development_id' => $dev3->id,
            'message_id'              => 'DEV-MSG-003',
            'pic'                     => 'Rizky Maulana (PIC Engineering)',
            'tanggal'                 => '2026-06-05',
            'hasil_progress'          => 'RFQ sudah dikirim ke 3 vendor CAS. Evaluasi proposal sedang berjalan.',
            'persentase'              => 25,
            'file'                    => null,
        ]);


        // =====================================================
        // INSIDEN 4: Pekerja Terjatuh dari Tangga Workshop
        // Status: Belum diapprove, baru dibuat
        // =====================================================
        $incident4 = Incident::create([
            'date'            => '2026-06-08',
            'time'            => '16:20:00',
            'department'      => 'HSE (Health, Safety & Environment)',
            'position'        => 'Helper Mekanik',
            'age'             => 24,
            'work_experience' => '1 Tahun 8 Bulan',
            'responsibility'  => 'Membantu proses perbaikan atap workshop dan penggantian lampu penerangan.',
            'is_approved'     => false,
            'approved_by'     => null,
        ]);
        $incident4->users()->attach([$userPelapor1->id]);

        Accident::create([
            'incident_id'          => $incident4->id,
            'accident_place'       => 'Workshop utama, area atap sisi timur',
            'accident_condition'   => 'Lantai workshop basah karena hujan sebelumnya, tangga aluminium standar',
            'accident_description' => 'Helper mekanik sedang naik tangga aluminium portable untuk mengganti lampu penerangan di atap workshop. Saat berada di anak tangga ke-5 (±3 meter), kaki tangga tergelincir karena lantai basah. Pekerja terjatuh dan mendarat pada matras kardus di bawahnya. Pekerja mengalami memar pada lengan kiri dan nyeri punggung ringan. Dibawa ke klinik site untuk perawatan.',
            'safety_incidents'     => 'Jatuh dari Ketinggian (Fall from Height)',
        ]);

        IncidentCause::create([
            'incident_id'    => $incident4->id,
            'unsafe_action'  => 'Pekerja tidak menggunakan body harness dan tidak ada rekan kerja yang menahan kaki tangga',
            'unsafe_condition' => 'Lantai workshop basah dan licin, tangga tanpa anti-slip rubber foot pad',
            'person_factor'  => 'Pekerja masih junior dan belum mengikuti pelatihan K3 bekerja di ketinggian',
            'job_factor'     => 'Tidak ada JSA (Job Safety Analysis) yang dibuat sebelum pekerjaan dimulai',
            'env_factor'     => 'Lantai basah akibat air hujan yang masuk melalui atap yang sedang diperbaiki',
        ]);

        $followUp4 = IncidentFollowUp::create([
            'incident_id'          => $incident4->id,
            'corrective_action'    => 'Pengadaan scaffolding portable dan body harness lengkap untuk pekerjaan di ketinggian workshop',
            'target_pengendalian'  => 14,
            'bentuk_pengendalian'  => 'Engineering Control',
            'penanggung_jawab'     => 'Superintendent HSE',
            'status'               => 'open',
            'status_approval'      => null,
            'catatan_revisi'       => null,
            'progress'             => 0,
        ]);


        // =====================================================
        // INSIDEN 5: Kerusakan Conveyor Belt di Crushing Plant
        // Status: Sudah diapprove, follow up dalam revisi
        // =====================================================
        $incident5 = Incident::create([
            'date'            => '2026-04-15',
            'time'            => '22:00:00',
            'department'      => 'Processing Plant',
            'position'        => 'Operator Crusher',
            'age'             => 38,
            'work_experience' => '12 Tahun',
            'responsibility'  => 'Mengoperasikan dan memonitor crushing plant serta conveyor belt dari control room.',
            'is_approved'     => true,
            'approved_by'     => $direktur?->id,
        ]);
        $incident5->users()->attach([$userPelapor2->id, $userPelapor3->id]);

        Accident::create([
            'incident_id'          => $incident5->id,
            'accident_place'       => 'Crushing Plant, Conveyor Belt CB-03 antara secondary crusher dan stockpile',
            'accident_condition'   => 'Operasi malam hari, penerangan area cukup, suhu 25°C',
            'accident_description' => 'Conveyor belt CB-03 mengalami sobek (ripping) sepanjang ±15 meter akibat material batuan tajam yang masuk dari secondary crusher. Operator mendeteksi melalui alarm belt misalignment di control room dan langsung melakukan emergency stop. Produksi terhenti selama 18 jam untuk perbaikan. Tidak ada korban jiwa.',
            'safety_incidents'     => 'Kerusakan Peralatan Kritis (Equipment Failure)',
        ]);

        IncidentCause::create([
            'incident_id'    => $incident5->id,
            'unsafe_action'  => 'Screen pada secondary crusher tidak diperiksa secara rutin sehingga material oversized lolos',
            'unsafe_condition' => 'Screen grizzly pada secondary crusher sudah melewati batas umur pakai dan berlubang',
            'person_factor'  => 'Operator shift malam kurang waspada karena jam kerja panjang',
            'job_factor'     => 'Program preventive maintenance untuk screen crusher tidak terjadwal dengan baik',
            'env_factor'     => 'Operasi malam dengan penerangan terbatas menyulitkan inspeksi visual rutin',
        ]);

        $followUp5 = IncidentFollowUp::create([
            'incident_id'          => $incident5->id,
            'corrective_action'    => 'Penggantian conveyor belt CB-03 dan penambahan metal detector sebelum belt',
            'target_pengendalian'  => 21,
            'bentuk_pengendalian'  => 'Engineering Control',
            'penanggung_jawab'     => 'Dept. Head Processing',
            'status'               => 'on_progress',
            'status_approval'      => 'Revisi',
            'catatan_revisi'       => 'Tambahkan juga jadwal penggantian screen grizzly ke dalam program PM. Belt saja tidak cukup jika akar masalahnya ada di screen crusher.',
            'progress'             => 70,
        ]);

        FollowUpProgress::create([
            'incident_follow_up_id' => $followUp5->id,
            'message_id'            => 'PRG-26-005',
            'pic'                   => 'Tim Plant Maintenance',
            'keterangan'            => 'Belt baru sudah terpasang. Metal detector dalam proses instalasi. Menunggu kalibrasi.',
            'persentase_progress'   => 70,
            'file'                  => null,
        ]);

        $dev5 = IncidentDevelopment::create([
            'incident_id'          => $incident5->id,
            'bentuk_pengembangan'  => 'Implementasi sistem monitoring belt secara real-time via SCADA dengan alert ke smartphone supervisor',
            'hasil_pengembangan'   => 'Supervisor bisa memonitor kondisi belt secara real-time dan menerima notifikasi instan jika ada anomali',
            'persentase'           => 50,
            'status'               => 'active',
            'tanggal'              => '2026-07-01',
            'user_id'              => $picUser?->id,
        ]);

        DevelopmentProgress::create([
            'incident_development_id' => $dev5->id,
            'message_id'              => 'DEV-MSG-004',
            'pic'                     => 'Tim IT & Engineering',
            'tanggal'                 => '2026-05-01',
            'hasil_progress'          => 'Sensor vibration dan temperature sudah terpasang di 3 conveyor. Integrasi SCADA 60% selesai.',
            'persentase'              => 50,
            'file'                    => null,
        ]);

        $this->command->info('✅ Data insiden, kecelakaan, tindak lanjut, dan pengembangan berhasil di-seed!');
        $this->command->info("   → 5 Insiden, 5 Kecelakaan, 5 Penyebab");
        $this->command->info("   → 7 Tindak Lanjut, 5 Progress Tindak Lanjut");
        $this->command->info("   → 3 Pengembangan, 4 Progress Pengembangan, 1 Laporan Final");
    }
}

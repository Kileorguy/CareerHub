# CareerHub
Anggota:
1. Andrew - 2602084640
2. Dionisius Hendi Krisnanto - 2602124316
3. Hendra Hartanto - 2602111793
4. Michael Alvin Setiono - 2602103601

Kami dari kelompok 2 memilih topik Sustainable Development Goals (SDG) ke-8 mengenai Decent Work and Economic Growth, yang bertujuan untuk meningkatkan pertumbuhan ekonomi, produktivitas, serta inovasi teknologi. Goal ini kami coba raih melalui Careerhub yaitu platform berbasis web yang menghubungkan pencari kerja dengan perusahaan serta memfasilitasi dalam pencarian pekerjaan melalui rekomendasi pekerjaan berbasis Artificial Intelligence (AI). Berikut adalah detail dari project kami:

## Database (struktur dari database Careerhub)
![ERD](https://raw.githubusercontent.com/Kileorguy/CareerHub/main/ERD%20-%20Careerhub.png)

## Public (bisa diakses oleh siapa saja (no authorization))
1. Login: page yang berperan untuk authentication dan authorization pada Careerhub. Di page ini user perlu untuk memasukkan email dan password untuk login ke account mereka sebelum bisa mengakses page-page lainnya.
2. Register: page bagi user untuk mendaftarkan account mereka. Pada page ini user bisa memilih jenis account yang ingin mereka buat, apakah sebagai employee (pencari kerja) atau sebagai employer (perusahaan). Data yang perlu diisi juga berbeda berdasarkan role yang dipilih.

## Employee (hanya bisa diakses oleh user dengan role employee/pencari kerja)


## Company (hanya bisa diakses oleh user dengan role company/perusahaan)
1. Company Profile: page ini berisikan tampilan informasi perusahaan yang seperti profile image, nama, deskripsi, serta lokasi dari perusahaan. Pada page ini company juga bisa melakukan update profile sesuai yang diinginkan.
2. Dashboard
   - Manage Job: fitur ini berguna bagi perusahaan ketika ingin menambahkan, mengubah, maupun menghapus lowongan pekerjaan yang tersedia.
   - Manage Job Applicants: fitur ini akan menampilkan list pencari pekerja yang mendaftar pada lowongan kerja yang ditawarkan oleh perusahaan.
3. Applicant Detail: page ini menampilkan informasi mengenai pencari pekerja untuk membantu company dalam menentukan untuk reject atau accept pendaftaran.


## AI (model yang digunakan untuk memberikan rekomendasi pekerjaan berdasarkan informasi pekerja)

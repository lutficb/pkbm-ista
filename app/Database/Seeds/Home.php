<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Home extends Seeder
{
    public function run()
    {
        $data = [
            'headline1' => 'Belajar Hari Ini,',
            'headline2' => 'Memimpin Di Masa Depan',
            'headline3' => 'Kami adalah PKBM terbesar di Tulungagung',
            'sambutan' => "Assalamu'alaikum Warahmatullahi Wabarakatuh 
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo ipsum beatae voluptatum sapiente, totam aliquam possimus nobis delectus dolorem enim laborum maxime asperiores accusamus doloribus qui architecto, blanditiis assumenda est. Beatae, perferendis? Repellendus, odio. Assumenda numquam similique fugit accusantium maxime neque, sed, quo quasi sit vel reiciendis soluta quisquam architecto deleniti possimus esse officiis, dolorem eligendi optio? Enim sint non modi laboriosam. Quibusdam hic expedita iusto doloribus, ea accusantium maiores! Tenetur corrupti eveniet nihil exercitationem saepe ratione earum? Alias dolores quibusdam, molestias magni aspernatur velit, impedit quaerat aliquid dicta, culpa harum nihil! Quis excepturi illo deserunt voluptatibus incidunt. Cumque, repellat?Wassalamu'alaikum Warahmatullahi Wabarakatuh",
            'jml_paket_b' => '350',
            'jml_paket_c' => '350',
            'tutor' => '30',
            'why_us' => 'Kami adalah salah satu PKBM dengan jumlah warga belajar terbanyak di Tulungagung. Fasilitas serta sarana dan prasarana yang juga cukup lengkap seperti lapangan olahraga, laboratorium komputer, UKS dan lainnya. Selain itu kami juga mnejadi satu-satunya PKBM di Tulungaung yang menerapkan sistem asrama, sehingga diharapkan kegiatan belajar lebih maksimal dan fasilatas dapat dimanfaatkan secara optimal oleh warga belajar. Namun dengan semua kelebihan terebut di atas, biaya yang perlu dikeluarkan sangatlah terjangkau.',
            'judul_keunggulan1' => 'Sistem Asrama',
            'keunggulan1' => 'Dengan sistem asrama, konsistensi jam belajar semakin terjamin bagi warga belajar Paket B maupun Paket C.',
            'judul_keunggulan2' => 'Biaya Terjangkau',
            'keunggulan2' => 'Dengan segala keunggulan akadmeik, fasilitas serta sarana dan prasarana yang didapatkan oleh setiap warga belajar, biaya relatif murah yang anda keluarkan sungguh sangat tidak sepadan.',
            'judul_keunggulan3' => 'Lingkungan Nyaman',
            'keunggulan3' => 'Lokasi di pedesaan yang masih segar udarannya, jauh dari kebisingan kota namun tetap mudah dijangkau dengan kendaraan umum atau pribadi.',
            'alamat' => 'Jln. Jayeng Kusuma Gg. 1 Donorejo, Desa Tapan, Kec. Kedungwaru, Kab. Tulungagung, Jawa Timur - 66229',
            'phone' => '081214626278',
            'email' => 'pkbmista@gmail.com'
        ];

        $this->db->table('home')->insert($data);
    }
}

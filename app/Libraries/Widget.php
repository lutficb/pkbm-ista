<?php

namespace App\Libraries;

class Widget
{

    public function footer()
    {
        $db = db_connect();
        $data = $db->table('home')->get()->getRow();

        return view('widget/footer', ['home' => $data]);
    }

    public function recentPost()
    {
        $db = db_connect();
        $data = $db->table('blog_post')
            ->select('blog_post.thumbnail AS thumbnail, kategori_blog.nama_kategori AS kategori, blog_post.created_at AS created_at, blog_post.judul_post AS judul, blog_post.konten_post AS isi, blog_post.id AS id, blog_post.slug AS slug')
            ->join('kategori_blog', 'kategori_blog.slug = blog_post.kode_kategori')
            ->where('blog_post.deleted_at')
            ->where('blog_post.status', 'publish')
            ->limit(6)
            ->orderBy('blog_post.created_at', 'DESC')
            ->get()->getResult();

        return view('widget/recent', ['post' => $data]);
    }
}

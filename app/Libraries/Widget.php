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
}

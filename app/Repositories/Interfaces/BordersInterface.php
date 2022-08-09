<?php

namespace App\Repositories\Interfaces;


interface BordersInterface{
    public function indexBorder();
    public function indexBorderUser($id_user);
    public function serchBorder($s);
    public function serchBorderUserNull($id_user);
    public function serchBorderUser($id_user,$s);
}
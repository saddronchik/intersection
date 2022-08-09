<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface AvtosInterface
{

    public function indexAvtos();
    public function indexAvtosJoinRecordsUsers($id_user);
    public function serchAvtos($s);
    public function serchAvtosJoinRecordsUsers($s,$id_user);
    public function getBorderAvtos($id);

}
<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface CitisensInterface{

    public function getAll();
    public function getCizensJoinRecordsUsers();
    public function getSearchCitisens(Request $request);
    public function getSearchUsersNullInCitisens(Request $request);
    public function getSearchUsersInCitisens(Request $request);
    public function getUsers();
    public function getShowMessages(int $id);
    public function getBorderCitisens(int $id);
}
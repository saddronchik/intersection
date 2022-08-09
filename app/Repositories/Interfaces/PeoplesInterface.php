<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface PeoplesInterface{

    public function getPeoplesJoinRecordsUsers();

    public function getSearchPeoples(Request $request);
    public function getSearchUsersNullInPeoples(Request $request);
    public function getSearchUsersInPeoples(Request $request);
}
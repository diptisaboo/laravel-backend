<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use Config;

class Film extends Model
{
    protected $table = 'films';
    protected $fillable = ['user_id', 'name', 'description', 'realease_date', 'rating', 'ticket_price', 'country', 'genre', 'photo', 'status',];

    /**
     * Insert and Update Film
     */
    public function insertUpdate($data)
    {
        if (isset($data['id']) && $data['id'] != '' && $data['id'] > 0) {
            return Film::where('id', $data['id'])->update($data);
        } else {
            return Film::create($data);
        }
    }

    /**
     * get all Film
     */
    public function getAllFilm() {
        $return = Film::where('status',Config::get('constant.ACTIVE_FLAG'))->get();
        return $return;
    }

    /**
     * get Film data By Id
     */
    public function getFilmById($id) {
        $return = Film::where('id',$id)->where('status',Config::get('constant.ACTIVE_FLAG'))->first();
        return $return;
    }

    /**
     * Delete Film
     */
    public function deleteFilm($id) {
        $return = Film::where('id',$id)->update(['status' => Config::get('constant.DELETED_FLAG')]);
        return $return;
    }
}

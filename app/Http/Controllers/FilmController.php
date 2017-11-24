<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FilmRequest;
use App\Http\Controllers\Controller;
use App\Film;
use Auth;
use Input;
use Config;
use Redirect;
use Image;

class FilmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->objFilm = new Film();
        $this->filmOriginalImageUploadPath = Config::get('constant.FILM_ORIGINAL_IMAGE_UPLOAD_PATH');
        $this->filmThumbImageUploadPath = Config::get('constant.FILM_THUMB_IMAGE_UPLOAD_PATH');
        $this->filmThumbImageHeight = Config::get('constant.FILM_THUMB_IMAGE_HEIGHT');
        $this->filmThumbImageWidth = Config::get('constant.FILM_THUMB_IMAGE_WIDTH');
    }

    public function index()
    {
        $data = $this->objFilm->getAllFilm();
        return view('ListFilm', compact('data'));
    }

    public function add()
    {
        return view('EditFilm');
    }

    public function save(FilmRequest $request)
    {
        $postData = Input::get();
        unset($postData['_token']);
        foreach ($postData as $key => $value) {
            if ($value == NULL) {
                $value = NULL;
            }
            $data[$key] = $value;
        }
        $file = Input::file('photo');
            if (!empty($file)) 
            {
                $fileName = time().'.'.$file->getClientOriginalExtension();

                if (!file_exists(public_path($this->filmOriginalImageUploadPath))) 
                {
                    mkdir(public_path($this->filmOriginalImageUploadPath), 0777, true);
                }
                if (!file_exists(public_path($this->filmThumbImageUploadPath))) 
                {
                    mkdir(public_path($this->filmThumbImageUploadPath), 0777, true);
                }

                $pathOriginal = public_path($this->filmOriginalImageUploadPath. $fileName);
                $pathThumb = public_path($this->filmThumbImageUploadPath . $fileName);
                Image::make($file->getRealPath())->save($pathOriginal);
                Image::make($file->getRealPath())->resize($this->filmThumbImageWidth,$this->filmThumbImageHeight)->save($pathThumb);
                unset($data['oldphoto']);
                $data['photo'] = $fileName;
            }
            else{
                unset($data['oldphoto']);
                $data['photo'] = Input::get('oldphoto');
            }
        $data['user_id'] = '1';
        $response = $this->objFilm->insertUpdate($data);
        if ($response) {
            return Redirect::to("films")->with('success', trans('labels.filmsuccessmsg'));
        } else {
            return Redirect::to("films")->with('error', trans('labels.filmerrormsg'));
        }
    }

    public function edit($id)
    {
        $data = $this->objFilm->find($id);
        if($data) {
            return view('EditFilm', compact('data'));
        } else {
            return Redirect::to("films")->with('error', trans('labels.recordnotexist'));
        }
    }

    public function delete($id)
    {
        $response = $this->objFilm->deleteFilm($id);
        if ($response) {
            return Redirect::to("films")->with('success', trans('labels.filmdeletesuccessmsg'));
        }
    }

}

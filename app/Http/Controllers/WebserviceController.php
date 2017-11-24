<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Film;
use Auth;
use Input;
use Config;
use Redirect;
use Image;
use JWTAuth;

class WebserviceController extends Controller
{
    public function __construct()
    {
        $this->objUser = new User();
        $this->objFilm = new Film();
        $this->filmOriginalImageUploadPath = Config::get('constant.FILM_ORIGINAL_IMAGE_UPLOAD_PATH');
        $this->filmThumbImageUploadPath = Config::get('constant.FILM_THUMB_IMAGE_UPLOAD_PATH');
        $this->filmThumbImageHeight = Config::get('constant.FILM_THUMB_IMAGE_HEIGHT');
        $this->filmThumbImageWidth = Config::get('constant.FILM_THUMB_IMAGE_WIDTH');
    }

    public function userSignup()
    {
        $responseData = ['status' => 0, 'message' => trans('apimessages.default_error_msg'), 'data' => []];
        $statusCode = 400;
        $requestData = Input::all();

        try {
            if (filter_var($requestData['email'], FILTER_VALIDATE_EMAIL)) {
                $exists = $this->objUser->checkEmailExist($requestData['email']);
                $statusCode = 200;
                if(!$exists) {
                    $userData = [
                        'role_id' => '2',
                        'name' => $requestData['name'],
                        'email' => $requestData['email'],
                        'password' => bcrypt($requestData['password'])
                    ];
                    $user = $this->objUser->registerUserFromApi($userData);

                    $responseData['data'] = $user;
                    $responseData['status'] = 1;
                    $responseData['message'] = trans('apimessages.signup_success');
                } else {
                    $statusCode = 409;
                    $responseData['message'] = trans('apimessages.userwithsameemailaddress');
                }
            } else {
                $responseData['message'] = trans('apimessages.invalid_user_email');
            }
        } catch (Exception $e) {
            $responseData['message'] = $e->getMessage();
        }

        return response()->json($responseData, $statusCode);
    }

    public function userLogin()
    {
        $responseData = ['status' => 0, 'message' => trans('apimessages.default_error_msg'), 'data' => []];
        $statusCode = 400;
        $requestData = Input::all();
        if(isset($requestData['email']) && isset($requestData['password']))
        {
            try 
            {
                $email = Input::get('email');
                $password = Input::get('password');
                $response = JWTAuth::attempt(['email' => $email, 'password' => $password]);
                if($response){
                    $token['token'] = $response;
                    $responseData = ['status' => 1, 'message' => trans('apimessages.default_success_msg')];
                    $responseData['data'] = $token;
                    $statusCode = 200;
                }
                else{
                    $statusCode = 200;
                    $responseData = ['status' => 0, 'message' => trans('apimessages.default_error_msg')];
                }
                
            } catch (\Illuminate\Database\QueryException $e) {
                $responseData['message'] = $e->getMessage();
            }
        }
        else{
            $statusCode = 200;
            $responseData = ['status' => 0, 'message' => trans('apimessages.parameter_missing')];
        }
        return response()->json($responseData, $statusCode);
    }

    public function logout()
    {
        $responseData = ['status' => 0, 'message' => trans('apimessages.default_error_msg'), 'data' => []];
        $statusCode = 400;
        $responseData = Input::all();
       if(isset($responseData['token']))
        {
            if(JWTAuth::invalidate($responseData['token']))
            {
                $responseData = ['status' => 1, 'message' => trans('apimessages.logout_success_msg')];
            }
            else{
                $responseData = ['status' => 0, 'message' => trans('apimessages.default_error_msg'), 'data' => []];
            }
        }
        else{
            $responseData = ['status' => 0, 'message' => trans('apimessages.missing_token_msg'), 'data' => []];
        }
        return response()->json($responseData, 200);
    }

    public function createFilm()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $responseData = ['status' => 0, 'message' => trans('apimessages.default_error_msg'), 'data' => []];
        $statusCode = 400;
        $requestData = Input::all();
        if(isset($requestData['name']) && isset($requestData['description']) && isset($requestData['realease_date']) && isset($requestData['rating']) && isset($requestData['ticket_price']) && isset($requestData['country']) && isset($requestData['genre']) && isset($requestData['photo']))
        {
            try 
            {
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
                    $data['photo'] = $fileName;
                }

                $data['name'] = $requestData['name'];
                $data['description'] = $requestData['description'];
                $data['realease_date'] = $requestData['realease_date'];
                $data['rating'] = $requestData['rating'];
                $data['ticket_price'] = $requestData['ticket_price'];
                $data['country'] = $requestData['country'];
                $data['genre'] = $requestData['genre'];
                $data['user_id'] = $this->user->id;

                $response = $this->objFilm->insertUpdate($data);
                if($response){
                    $responseData = ['status' => 1, 'message' => trans('apimessages.default_success_msg')];
                    $statusCode = 200;
                }
                else{
                    $statusCode = 200;
                    $responseData = ['status' => 0, 'message' => trans('apimessages.default_error_msg')];
                }
                
            } catch (\Illuminate\Database\QueryException $e) {
                $responseData['message'] = $e->getMessage();
            }
        }
        else{
            $statusCode = 200;
            $responseData = ['status' => 0, 'message' => trans('apimessages.parameter_missing')];
        }
        return response()->json($responseData, $statusCode);
    }

}

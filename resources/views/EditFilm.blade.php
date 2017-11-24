@extends('Master')

@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('labels.films')}}
    </h1>
</section>
<?php
    // echo "<pre>"; print_r($data); exit;
?>
<!-- Main content -->
<section class="content">
    <div class="row">

        <!-- right column -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo (isset($data) && !empty($data)) ? ' Edit ' : 'Add' ?> {{trans('labels.film')}}</h3>
                </div><!-- /.box-header -->
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>{{trans('labels.whoops')}}</strong> {{trans('labels.someproblems')}}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form id="addDistrict" class="form-horizontal" method="post" action="{{ url('/savefilm') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="<?php echo (isset($data) && !empty($data)) ? $data->id : '0' ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <?php
                            if (old('name'))
                                $name = old('name');
                            elseif (isset($data))
                                $name = $data->name;
                            else
                                $name = '';
                            ?>
                            <label for="name" class="col-sm-2 control-label">{{trans('labels.lblname')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="name" name="name" value="{{$name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if (old('description'))
                                $description = old('description');
                            elseif (isset($data))
                                $description = $data->description;
                            else
                                $description = '';
                            ?>
                            <label for="description" class="col-sm-2 control-label">{{trans('labels.lbldescription')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="description" name="description">{{$description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if (old('realease_date'))
                                $realease_date = old('realease_date');
                            elseif (isset($data))
                                $realease_date = date('Y-m-d',strtotime($data->realease_date));
                            else
                                $realease_date = '';
                            ?>
                            <label for="realease_date" class="col-sm-2 control-label">{{trans('labels.lblrealeasedate')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="realease_date" name="realease_date" value="{{$realease_date}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if (old('rating'))
                                $rating = old('rating');
                            elseif (isset($data))
                                $rating = $data->rating;
                            else
                                $rating = '';
                            ?>
                            <label for="rating" class="col-sm-2 control-label">{{trans('labels.lblrating')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rating" name="rating" value="{{$rating}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if (old('ticket_price'))
                                $ticket_price = old('ticket_price');
                            elseif (isset($data))
                                $ticket_price = $data->ticket_price;
                            else
                                $ticket_price = '';
                            ?>
                            <label for="ticket_price" class="col-sm-2 control-label">{{trans('labels.lblticketprice')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="ticket_price" name="ticket_price" value="{{$ticket_price}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if (old('country'))
                                $country = old('country');
                            elseif (isset($data))
                                $country = $data->country;
                            else
                                $country = '';
                            ?>
                            <label for="country" class="col-sm-2 control-label">{{trans('labels.lblcountry')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="country" name="country" value="{{$country}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if (old('genre'))
                                $genre = old('genre');
                            elseif (isset($data))
                                $genre = $data->genre;
                            else
                                $genre = '';
                            ?>
                            <label for="genre" class="col-sm-2 control-label">{{trans('labels.lblgenre')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="genre" name="genre" value="{{$genre}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if (old('photo'))
                                $photo = old('photo');
                            elseif (isset($data))
                                $photo = $data->photo;
                            else
                                $photo = '';
                            ?>
                            <label for="photo" class="col-sm-2 control-label">{{trans('labels.lblphoto')}}<span class="star_red">*</span></label>
                            <div class="col-sm-6">
                                <input type="hidden" name="oldphoto" id="oldphoto" value="{{$photo}}"/>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                                <?php if ($photo) { ?>
                                    <img src="{{  asset(Config::get('constant.FILM_THUMB_IMAGE_UPLOAD_PATH').'/'.$photo) }}" width="50" height="50"/>
                                <?php } ?>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-danger save-btn">{{trans('labels.savebtn')}}</button>
                            <a class="btn btn-default" href="{{ url('films') }}">{{trans('labels.cancelbtn')}}</a>
                        </div>
                    </div><!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section><!-- /.content -->
@stop
@section('script')
<script type="text/javascript">
    $("#realease_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });
    var validateRules = {
        name: {
            required:true,
        },
        description: {
            required:true,
        },
        realease_date: {
            required:true,
        },
        rating: {
            required:true,
        },
        ticket_price: {
            required:true,
        },
        country: {
            required:true,
        },
        genre: {
            required:true,
        },
        photo: {
            required:true,
        },
    };
     
    $("#addDistrict").validate({
        ignore: "",
        rules: validateRules,
        messages: {
            name: {
                required:'<?php echo trans('labels.filmnamerequired')?>'
            },
            description: {
                required:'<?php echo trans('labels.filmdescriptionrequired')?>'
            },
            realease_date: {
                required:'<?php echo trans('labels.filmrealeasedaterequired')?>'
            },
            rating: {
                required:'<?php echo trans('labels.filmratingrequired')?>'
            },
            ticket_price: {
                required:'<?php echo trans('labels.filmticketpricerequired')?>'
            },
            country: {
                required:'<?php echo trans('labels.filmcountryrequired')?>'
            },
            genre: {
                required:'<?php echo trans('labels.filmgenrerequired')?>'
            },
            photo: {
                required:'<?php echo trans('labels.filmphotorequired')?>'
            },
        }
    });    
</script>
@stop
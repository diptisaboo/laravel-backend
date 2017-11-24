@extends('Master')

@section('content')

<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{trans('labels.films')}}
        <div class="pull-right">
                <a href="{{ url('addfilm') }}" class="btn btn-block btn-warning pull-right">Add {{trans('labels.film')}}</a>
        </div>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">

        <!-- right column -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-danger">
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
                <div class="box-body">
                    <table id="film" class='table table-striped table-responsive'>
                        <thead>
                            <tr>
                                <th>{{trans('labels.lblname')}}</th>
                                <th>{{trans('labels.lblphoto')}}</th>
                                <th>{{trans('labels.lbldescription')}}</th>
                                <th>{{trans('labels.lblrealeasedate')}}</th>
                                <th>{{trans('labels.lblrating')}}</th>
                                <th>{{trans('labels.lblticketprice')}}</th>
                                <th>{{trans('labels.lblcountry')}}</th>
                                <th>{{trans('labels.lblgenre')}}</th>
                                <th>{{trans('labels.lblaction')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key=>$value)
                            <tr>
                                <td>{{$value->name}}</td>
                                <td>
                                    @if(isset($value->photo) && $value->photo != '')
                                        <a href='#' data-toggle='modal' data-target='#{{$value->id.substr($value->photo, 0, -5)}}'><img src="{{  asset(Config::get('constant.FILM_THUMB_IMAGE_UPLOAD_PATH').'/'.$value->photo) }}" width="50" height="50"/></a>
                                        <div class='modal fade image_modal' id='{{$value->id.substr($value->photo, 0, -5)}}' role='dialog' style='vertical-align: center;'>
                                            <div class='modal-dialog modal-lg'>
                                                <div class='modal-content' style="background-color:transparent;">
                                                    <div class='modal-body'>
                                                    <center><button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <img src="{{  asset(Config::get('constant.FILM_ORIGINAL_IMAGE_UPLOAD_PATH').'/'.$value->photo) }}" style=' max-height:680px; border-radius:5px;'><center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <center>-</center>
                                    @endif
                                </td>
                                <td>{{$value->description}}</td>
                                <td>{{date('d-M-Y',strtotime($value->realease_date))}}</td>
                                <td>{{$value->rating}}</td>
                                <td>{{$value->ticket_price}}</td>
                                <td>{{$value->country}}</td>
                                <td>{{$value->genre}}</td>
                                <td><a href="{{url('editfilm')}}/{{$value->id}}">
                                    <span class='glyphicon glyphicon-edit'></span></a> <a onClick="return confirm('Are you sure to delete the data?')" href="{{url('deletefilm')}}/{{$value->id}}">
                                    <span class='glyphicon glyphicon-remove'></span></a></td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#film').DataTable();
    });
</script>
@stop
@extends('layouts.admin')
@section('title', 'Admin Product | Admin Ecom530')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product Lists</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>S.N.</th>
                            <th>Product Name</th>
                            <th>Reviewed By</th>
                            <th>Review</th>
                            <th>Rate</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $key =>$value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->product['title'] }}</td>
                                    <td>{{ $value->user['name'] }}</td>
                                    <td>{{ $value->review }}</td>
                                    <td>{{ $value->rate }}</td>
                                    <td>
                                        <form class="form-validate" method="post" enctype="multipart/form-data" action="{{route('review.status', $value->id)}}">
                                            <?php $prod_avail = isset($data) ? true :  false;?>
                                            {{csrf_field()}}
                                            @method('put')
                                            <select class="status" name="status" onchange="this.form.submit()" class="form-control" required>
                                                <option value="" selected disabled="">
                                                    Choose Status...
                                                </option>
                                                <option value="active" {{$prod_avail && ( 'active'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Active
                                                </option>
                                                <option value="inactive" {{$prod_avail && ( 'inactive'== $value->status) ? "selected = 'selected'" : ""}}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </form> 
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection

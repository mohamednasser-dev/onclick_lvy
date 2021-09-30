@extends('layouts.admin.app')

@section('title','Add new coupon')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        @if(UserCan('add_coupon','admin'))
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> {{trans('messages.add')}} {{trans('messages.new')}} {{trans('messages.coupon')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.coupon.store')}}" method="post">
                    @csrf
                   <div class="row">
                       <div class="col-4">
                           <div class="form-group">
                               <label class="input-label" for="exampleFormControlInput1">{{trans('messages.title')}}</label>
                               <input type="text" name="title" class="form-control" placeholder="New coupon" required>
                           </div>
                       </div>
                       <div class="col-4">
                           <div class="form-group">
                               <label class="input-label" for="exampleFormControlInput1">{{trans('messages.coupon')}} {{trans('messages.type')}}</label>
                               <select name="coupon_type" class="form-control" onchange="coupon_type_change(this.value)">
                                   <option value="default">{{trans('messages.default')}}</option>
                                   <option value="first_order">{{trans('messages.first')}} {{trans('messages.order')}}</option>
                               </select>
                           </div>
                       </div>
                       <div class="col-4" id="limit-for-user">
                           <div class="form-group">
                               <label class="input-label" for="exampleFormControlInput1">{{trans('messages.limit')}} {{trans('messages.for')}} {{trans('messages.same')}} {{trans('messages.user')}}</label>
                               <input type="number" name="limit" class="form-control" placeholder="EX: 10">
                           </div>
                       </div>
                   </div>

                    <div class="row">
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.code')}}</label>
                                <input type="text" name="code" class="form-control"
                                       placeholder="{{\Illuminate\Support\Str::random(8)}}" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.start')}} {{trans('messages.date')}}</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.expire')}} {{trans('messages.date')}}</label>
                                <input type="date" name="expire_date" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.min')}} {{trans('messages.purchase')}}</label>
                                <input type="number" step="0.01" name="min_purchase" value="0" min="0" max="100000" class="form-control"
                                       placeholder="100">
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.max')}} {{trans('messages.discount')}}</label>
                                <input type="number" step="0.01" min="0" value="0" max="1000000" name="max_discount" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.discount')}}</label>
                                <input type="number" step="0.01" min="1" max="10000" name="discount" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{trans('messages.discount')}} {{trans('messages.type')}}</label>
                                <select name="discount_type" class="form-control">
                                    <option value="amount">{{trans('messages.amount')}}</option>
                                    <option value="percent">{{trans('messages.percent')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('messages.submit')}}</button>
                </form>
            </div>
            @endif

            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <hr>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-title"></h5>
                    </div>
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th>{{trans('messages.#')}}</th>
                                <th>{{trans('messages.title')}}</th>
                                <th>{{trans('messages.code')}}</th>
                                <th>{{trans('messages.min')}} {{trans('messages.purchase')}}</th>
                                <th>{{trans('messages.max')}} {{trans('messages.discount')}}</th>
                                <th>{{trans('messages.discount')}}</th>
                                <th>{{trans('messages.discount')}} {{trans('messages.type')}}</th>
                                <th>{{trans('messages.start')}} {{trans('messages.date')}}</th>
                                <th>{{trans('messages.expire')}} {{trans('messages.date')}}</th>
                                <th>{{trans('messages.status')}}</th>
                                <th>{{trans('messages.action')}}</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <input type="text" id="column1_search" class="form-control form-control-sm"
                                           placeholder="{{trans('messages.search')}}">
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    {{--<select id="column3_search" class="js-select2-custom"
                                            data-hs-select2-options='{
                                              "minimumResultsForSearch": "Infinity",
                                              "customClass": "custom-select custom-select-sm text-capitalize"
                                            }'>
                                        <option value="">Any</option>
                                        <option value="Active">Active</option>
                                        <option value="Disabled">Disabled</option>
                                    </select>--}}
                                </th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($coupons as $key=>$coupon)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                    <span class="d-block font-size-sm text-body">
                                        {{$coupon['title']}}
                                    </span>
                                    </td>
                                    <td>{{$coupon['code']}}</td>
                                    <td>{{$coupon['min_purchase']." ".\App\CentralLogics\Helpers::currency_symbol()}}</td>
                                    <td>{{$coupon['max_discount']." ".\App\CentralLogics\Helpers::currency_symbol()}}</td>
                                    <td>{{$coupon['discount']}}</td>
                                    <td>{{$coupon['discount_type']}}</td>
                                    <td>{{$coupon['start_date']}}</td>
                                    <td>{{$coupon['expire_date']}}</td>
                                    <td>
                                        @if(UserCan('edit_coupon','admin'))
                                        @if($coupon['status']==1)
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"
                                                 onclick="location.href='{{route('admin.coupon.status',[$coupon['id'],0])}}'">
                                                <span class="legend-indicator bg-success"></span>{{trans('messages.active')}}
                                            </div>
                                        @else
                                            <div style="padding: 10px;border: 1px solid;cursor: pointer"
                                                 onclick="location.href='{{route('admin.coupon.status',[$coupon['id'],1])}}'">
                                                <span class="legend-indicator bg-danger"></span>{{trans('messages.disabled')}}
                                            </div>
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(UserCan('edit_coupon','admin'))
                                                <a class="dropdown-item"
                                                   href="{{route('admin.coupon.update',[$coupon['id']])}}">{{trans('messages.edit')}}</a>
                                                @endif
                                                    @if(UserCan('delete_coupon','admin'))
                                                    <a class="dropdown-item" href="javascript:"
                                                   onclick="form_alert('coupon-{{$coupon['id']}}','Want to delete this coupon ?')">{{trans('messages.delete')}}</a>
                                                <form action="{{route('admin.coupon.delete',[$coupon['id']])}}"
                                                      method="post" id="coupon-{{$coupon['id']}}">
                                                    @csrf @method('delete')
                                                </form>
                                                    @endif
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <table>
                            <tfoot>
                            {!! $coupons->links() !!}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(9)
                    .search(this.value)
                    .draw();
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

        function coupon_type_change(order_type) {
            if(order_type=='first_order'){
                $('#limit-for-user').hide();
            }else{
                $('#limit-for-user').show();
            }
        }
    </script>
@endpush

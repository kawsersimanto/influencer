@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create Plan')}}</title>
@endsection
@section('admin-content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Create Plan')}}</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <a href="{{ route('admin.subscription-plan.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> {{__('admin.Go Back')}}</a>

                        </div>

                        <div class="card-body">

                            <form action="{{route('admin.subscription-plan.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label for="">{{__('admin.Plan Name')}} <span class="text-danger">*</span> </label>
                                        <input type="text" name="plan_name" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Plan Price')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For free plan use(0)"> <span class="text-danger">*</span></label>
                                        <input type="text" name="plan_price" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Expiration Date')}} <span class="text-danger">*</span></label>

                                        <select name="expiration_date" id="" class="form-control">
                                            <option value="monthly">{{__('admin.Monthly')}}</option>
                                            <option value="yearly">{{__('admin.Yearly')}}</option>
                                            <option value="lifetime">{{__('admin.Lifetime')}}</option>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Maximum Service')}} <span data-toggle="tooltip" data-placement="top" class="fa fa-info-circle text--primary" title="For unlimited service use(-1)"> <span class="text-danger">*</span></label>
                                        <input type="number" name="maximum_service" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                        <input type="number" name="serial" class="form-control form_control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">{{__('admin.Status')}} <span class="text-danger">*</span></label>
                                        <select name="status" id="" class="form-control">
                                            <option value="1">{{__('admin.Active')}}</option>
                                            <option value="0">{{__('admin.Inactive')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label>Features<span class="text-danger">*</span></label>
                                        <textarea name="features" id="" cols="30" rows="10" class="summernote">{{ old('features') }}</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Not included features<span class="text-danger">*</span></label>
                                        <textarea name="non_features" id="" cols="30" rows="10" class="summernote">{{ old('non_features') }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section("content")

<script>
    (function($) {
    "use strict";
    $(document).ready(function () {
        tinymce.init({
            selector: '.summernote',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ]
        });
        $('#dataTable').DataTable();
        $('.select2').select2();
        $('.sub_cat_one').select2();
        $('.tags').tagify();
        $('.datetimepicker_mask').datetimepicker({
            format:'Y-m-d H:i',
  
        });
  
  
        $('.custom-icon-picker').iconpicker({
            templates: {
                popover: '<div class="iconpicker-popover popover"><div class="arrow"></div>' +
                    '<div class="popover-title"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer"></div>',
                buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' +
                    ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>'
            }
        })
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-Infinity'
        });
        $('.clockpicker').clockpicker();
  
    });
  
    })(jQuery);
  </script>

@endsection
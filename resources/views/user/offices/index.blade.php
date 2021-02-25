{{-- Stored in /resources/views/user/account/edit.blade.php --}}
@extends('user.layouts.master')
@section('html-title', 'Offices')
@section('page-class', 'user-offices-index')
@section('page_script')
    @component('components.elements.script', ['src' => mix('js/selectize.js')])@endcomponent
@endsection

{{--[content]--}}
@section('content-body')
    @component('components.bootstrap.container', [
        'fluid' => true
    ])
        <div class="bg-white">
            <div class="row no-gutters offices-container">
                <div class="col-md-3 br-1">
                    <h5 class="text-center pt-2">MY OFFICES</h5>
                    <a id="add-office-btn" href="{{ route('user.offices.add') }}" >
                        <i class="fa fa-plus"></i>
                    </a>
                    @include('user.partials.search', [
                        'placeholder' => __('Enter office name, address or provider'),
                        'search_id' => 'search-office',
                        'classes'   => ['bt-2 bb-2 pt-1 pb-1']
                    ])
                    <div class="p-3">
                        <input id="current-office-id" type="hidden" value="{{$offices->count() ? $offices[0]->uuid : '' }}">
                        @if($offices->count())
                            <div class="row">
                                <div class="col-md-12" id="offices-search-container">
                                    @foreach($offices as $index =>$office)
                                        <div class="search-result-holder @if($index === 0) active @endif pl-3 pr-3 pt-4 pb-2" data-id="{{$office->uuid}}">
                                            <h5>{{ $office->name }}</h5>
                                            @php
                                                $location = $office->getMetaField('location', '');
                                            @endphp
                                            @if($location)
                                                <div>{{$location['address']. ", ". $location['city']. ", ". $location['state']. " " . $location['zipcode']}}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <i>No offices found</i>
                        @endif

                    </div>
                </div>
                <div class="col-md-9" id="office-info-content">
                    @if($offices->count())
                        @include("user.offices.partial-info", ["office" => $offices[0]])
                    @else
                        <h3 class="text-center mt-5">{{__("You currently have no offices!")}} Click <a href="{{ route('user.offices.add') }}">here</a> to add one!</h3>
                    @endif
                </div>
            </div>
        </div>
    @endcomponent
    <style>
        #add-office-btn{
            position: absolute;
            top: 7px;
            right: 15px;
            width: 27px;
            height: 27px;
            color: #000;
            border: 1px solid #000;
            text-align: center;
            border-radius: 50%; 
        }

        .offices-container{
            height: calc(100vh - 145px);
        }

    </style>
    @section('scripts_end')
        <script>
            $(document).ready(function(){
                $("#search-office").keydown(function(e){
                    if(e.keyCode != 13)
                        return;
                    $.ajax({
                        type: "GET",
                        url: '{{ route("user.offices.ajax.search-mine") }}',
                        data: {
                            keyword: $(this).val()
                        },
                        success: function(reps){
                            let offices = reps.data.offices;
                            $("#offices-search-container").empty();
                            let currentOfficeId = $("#current-office-id").val();
                            let itemHtml = "";
                            if(offices.length){
                                for(let office of offices){
                                    itemHtml += '<div class="search-result-holder'+ (currentOfficeId==office.uuid ? " active " : "") +' pl-3 pr-3 pt-4 pb-2" data-id="'+office.uuid+'">'
                                        + '<h5>'+ office.name +'</h5>'
                                        + (office.meta_fields && office.meta_fields.location ? ('<div>' + office.meta_fields.location.address + ', ' + office.meta_fields.location.city + ", " + office.meta_fields.location.state + ' ' + office.meta_fields.location.zipcode + '</div>') : '')
                                        + '</div>'
                                    ;
                                    
                                }
                            }else{
                                itemHtml = '<div class=" pl-3 pr-3 pt-4 pb-2"> <i>No offices found</i> </div>';
                            }
                            $("#offices-search-container").append(itemHtml);
                        }
                    });
                });

                $('#offices-search-container').on('click', '.search-result-holder', function(){
                    var id = $(this).data('id');
                    $('.search-result-holder').removeClass('active');
                    $(this).addClass('active');
                    $("#current-office-id").val(id);
                    $.ajax({
                        type: "GET",
                        url: '{{ route("user.offices.ajax.partial-info") }}',
                        data: {
                            id: id
                        },
                        success: function(reps){
                            let content = reps.data.content;
                            $("#office-info-content").html(content);
                        }
                    });
                })
            })
        </script>
    @endsection    
@endsection
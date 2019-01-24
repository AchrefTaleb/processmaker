@extends('layouts.layout')

@section('title')
    {{__('Screens')}}
@endsection

@section('sidebar')
    @include('layouts.sidebar', ['sidebar'=> Menu::get('sidebar_processes')])
@endsection

@section('content')
    @include('shared.breadcrumbs', ['routes' => [
        __('Processes') => route('processes.dashboard'),
        __('Screens') => null,
    ]])
    <div class="container page-content" id="screenIndex">
        <div class="row">
            <div class="col">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="fas fa-search"></i>
                      </span>
                    </div>
                    <input v-model="filter" class="form-control" placeholder="{{__('Search')}}...">
                </div>
            </div>
            <div class="col-8" align="right">
                @can('create-screens')
                    <button type="button" href="#" class="btn btn-secondary" data-toggle="modal"
                            data-target="#createScreen">
                        <i class="fas fa-plus"></i> {{__('Screen')}}
                    </button>
                @endcan
            </div>
        </div>

        <screen-listing ref="screenListing" :filter="filter" :permission="{{ \Auth::user()->hasPermissionsFor('screens') }}" v-on:reload="reload"></screen-listing>
    </div>

    @can('create-screens')
        <div class="modal fade" id="createScreen" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1>{{__('Create New Screen')}}</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('title', 'Name') !!}
                            {!! Form::text('title', null, ['id' => 'title','class'=> 'form-control', 'v-model' => 'formData.title',
                            'v-bind:class' => '{"form-control":true, "is-invalid":errors.title}']) !!}
                            <small id="emailHelp" class="form-text text-muted">Screen title must be distinct</small>
                            <div class="invalid-feedback" v-for="title in errors.title">@{{title}}</div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', 'Type') !!}
                            {!! Form::select('type', ['' => __('Select Type'), 'DISPLAY' => 'Display', 'FORM' => 'Form', 'EMAIL' => 'Email'], '', ['id' => 'type','class'=> 'form-control', 'v-model' => 'formData.type',
                            'v-bind:class' => '{"form-control":true, "is-invalid":errors.type}']) !!}
                            <div class="invalid-feedback" v-for="type in errors.type">@{{type}}</div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['id' => 'description', 'rows' => 4, 'class'=> 'form-control',
                            'v-model' => 'formData.description', 'v-bind:class' => '{"form-control":true, "is-invalid":errors.description}']) !!}
                            <div class="invalid-feedback" v-for="description in errors.description">@{{description}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="button" @click="onSubmit" class="btn btn-success ml-2">{{__('Save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('js')
    <script src="{{mix('js/processes/screens/index.js')}}"></script>
    
    @can('create-screens')
        <script>
            new Vue({
                el: '#createScreen',
                data() {
                    return {
                        formData: {},
                        errors: {
                            'title': null,
                            'type': null,
                            'description': null,
                        }
                    }
                },
                mounted() {
                    this.resetFormData();
                    this.resetErrors();
                },
                methods: {
                    resetFormData() {
                        this.formData = Object.assign({}, {
                            title: null,
                            type: '',
                            description: null,
                        });
                    },
                    resetErrors() {
                        this.errors = Object.assign({}, {
                            title: null,
                            type: null,
                            description: null,
                        });
                    },
                    onSubmit() {
                        this.resetErrors();
                        ProcessMaker.apiClient.post('screens', this.formData)
                            .then(response => {
                                ProcessMaker.alert('{{__('Created Screen Successfully')}}', 'success');
                                window.location = '/processes/screen-builder/' + response.data.id + '/edit';
                            })
                            .catch(error => {
                                if (error.response.status && error.response.status === 422) {
                                    this.errors = error.response.data.errors;
                                }
                            });
                    }
                }
            });
        </script>
    @endcan
@endsection

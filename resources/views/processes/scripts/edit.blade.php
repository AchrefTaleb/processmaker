@extends('layouts.layout')

@section('title')
    {{__('Edit Scripts')}}
@endsection

@section('sidebar')
    @include('layouts.sidebar', ['sidebar'=> Menu::get('sidebar_processes')])
@endsection

@section('content')
    @include('shared.breadcrumbs', ['routes' => [
        'Processes' => route('processes.index'),
        'Scripts' => route('scripts.index'),
        $script->title => null,
        'Edit' => null,
    ]])
    <div class="container" id="editScript">
        <h1>{{__('Edit Script')}}</h1>
        <div class="row">
            <div class="col-8">
                <div class="card card-body">
                    {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Name') !!}
                        {!! Form::text('title', null, ['id' => 'title','class'=> 'form-control', 'v-model' => 'formData.title',
                        'v-bind:class' => '{"form-control":true, "is-invalid":errors.title}']) !!}
                        <small class="form-text text-muted">Form title must be distinct</small>
                        <div class="invalid-feedback" v-if="errors.title">@{{errors.title[0]}}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('language', 'Language') !!}
                        {!! Form::select('language', ['php' => 'PHP', 'lua' => 'LUA'], 'null', ['id' => 'language','class'=> 'form-control', 'v-model' => 'formData.language',
                        'v-bind:class' => '{"form-control":true, "is-invalid":errors.language}']) !!}
                        <div class="invalid-feedback" v-for="language in errors.language">@{{language}}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', null, ['id' => 'description', 'rows' => 4, 'class'=> 'form-control',
                        'v-model' => 'formData.description', 'v-bind:class' => '{"form-control":true, "is-invalid":errors.description}']) !!}
                        <div class="invalid-feedback" v-if="errors.description">@{{errors.description[0]}}</div>
                    </div>
                    <br>
                    <div class="text-right">
                        {!! Form::button('Cancel', ['class'=>'btn btn-outline-success', '@click' => 'onClose']) !!}
                        {!! Form::button('Update', ['class'=>'btn btn-success ml-2', '@click' => 'onUpdate']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new Vue({
            el: '#editScript',
            data() {
                return {
                    formData: @json($script),
                    errors: {
                        'title': null,
                        'language': null,
                        'description': null,
                        'status': null
                    }
                }
            },
            methods: {
                resetErrors() {
                    this.errors = Object.assign({}, {
                        title: null,
                        language: null,
                        description: null,
                        status: null
                    });
                },
                onClose() {
                    window.location.href = '/processes/scripts';
                },
                onUpdate() {
                    this.resetErrors();
                    ProcessMaker.apiClient.put('scripts/' + this.formData.id, {
                        title: this.formData.title,
                        language: this.formData.language,
                        description: this.formData.description,
                    })
                        .then(response => {
                            ProcessMaker.alert('Updated Script Successfully', 'success');
                            this.onClose();
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
@endsection

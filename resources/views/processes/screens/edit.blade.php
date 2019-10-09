@extends('layouts.layout')

@section('title')
    {{__('Configure Screen')}}
@endsection

@section('sidebar')
    @include('layouts.sidebar', ['sidebar'=> Menu::get('sidebar_processes')])
@endsection

@section('breadcrumbs')
    @include('shared.breadcrumbs', ['routes' => [
        __('Designer') => route('processes.index'),
        __('Screens') => route('screens.index'),
        $screen->title => null,
    ]])
@endsection
@section('content')
    <div class="container" id="editGroup">
        <div class="row">
            <div class="col">
                <div class="card card-body">
                    <div class="form-group">
                        {!! Form::label('title', __('Name')) !!}
                        {!! Form::text('title', null, ['id' => 'title','class'=> 'form-control', 'v-model' => 'formData.title',
                        'v-bind:class' => '{"form-control":true, "is-invalid":errors.title}']) !!}
                        <small class="form-text text-muted" v-if="! errors.title">{{__('The screen name must be distinct.') }}</small>
                        <div class="invalid-feedback" v-if="errors.title">@{{errors.title[0]}}</div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', __('Description')) !!}
                        {!! Form::textarea('description', null, ['id' => 'description', 'rows' => 4, 'class'=> 'form-control',
                        'v-model' => 'formData.description', 'v-bind:class' => '{"form-control":true, "is-invalid":errors.description}']) !!}
                        <div class="invalid-feedback" v-if="errors.description">@{{errors.description[0]}}</div>
                    </div>
                    <category-select :label="$t('Category')" api-get="screen_categories" api-list="screen_categories" v-model="formData.categories" :errors="errors.screen_category_id">
                    </category-select>
                    <br>
                    <div class="text-right">
                        {!! Form::button(__('Cancel'), ['class'=>'btn btn-outline-secondary', '@click' => 'onClose']) !!}
                        {!! Form::button(__('Save'), ['class'=>'btn btn-secondary ml-2', '@click' => 'onUpdate']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{mix('js/processes/screens/edit.js')}}"></script>
    <script>
        new Vue({
            el: '#editGroup',
            data() {
                return {
                    formData: @json($screen),
                    errors: {
                        'title': null,
                        'type': null,
                        'description': null,
                        'status': null
                    }
                }
            },
            methods: {
                resetErrors() {
                    this.errors = Object.assign({}, {
                        title: null,
                        type: null,
                        description: null,
                        status: null
                    });
                },
                onClose() {
                    window.location.href = '/designer/screens';
                },
                onUpdate() {
                    this.resetErrors();
                    const data = Object.assign({}, this.formData);
                    delete data.category;
                    delete data.categories;
                    data.screen_category_id = [];
                    this.formData.categories.forEach(category => data.screen_category_id.push(category.id));
                    data.screen_category_id = data.screen_category_id.join(',');
                    ProcessMaker.apiClient.put('screens/' + this.formData.id, data)
                        .then(response => {
                            ProcessMaker.alert('{{__('The screen was saved.')}}', 'success');
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
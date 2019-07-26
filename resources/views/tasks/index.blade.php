@extends('layouts.layout')

@section('title')
    {{__($title)}}
@endsection

@section('sidebar')
    @include('layouts.sidebar', ['sidebar' => Menu::get('sidebar_task')])
@endsection

@section('content')
    @include('shared.breadcrumbs', ['routes' => [
        __('Tasks') => route('tasks.index'),
        __($title) => null,
    ]])
    <div class="px-3 page-content" id="tasks">
        <div class="row">
            <div class="col" align="right">
                <b-alert class="align-middle" show variant="danger" v-cloak v-if="inOverdueMessage.length>0"
                         style="text-align: center; margin-top:20px;">
                    @{{ inOverdueMessage }}
                </b-alert>
            </div>
        </div>
        <div id="search-bar" class="search mt-2 bg-light p-2" vcloak>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <div id="search-dropdowns" v-if="! advanced" class="row">
                        <div class="col-4">
                            <multiselect v-model="request"
                                         @search-change="getRequests"
                                         @input="buildPmql"
                                         :show-labels="false"
                                         :loading="isLoading.request"
                                         open-direction="bottom"
                                         label="name"
                                         :options="requestOptions"
                                         :track-by="'id'"
                                         :multiple="true"
                                         :placeholder="$t('Request')">
                                <template slot="noResult">
                                    {{ __('No elements found. Consider changing the search query.') }}
                                </template>
                                <template slot="noOptions">
                                    {{ __('No Data Available') }}
                                </template>
                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single" v-if="values.length > 1 && !isOpen">@{{ values.length }} {{ __('requests') }}</span>
                                </template>
                            </multiselect>
                        </div>
                        <div class="col-4">
                            <multiselect v-model="name"
                                         @search-change="getNames"
                                         @input="buildPmql"
                                         :show-labels="false"
                                         :loading="isLoading.name"
                                         open-direction="bottom"
                                         label="name"
                                         :options="nameOptions"
                                         :track-by="'name'"
                                         :multiple="true"
                                         :placeholder="_.startCase(_.camelCase($t('Task')))">
                                <template slot="noResult">
                                    {{ __('No elements found. Consider changing the search query.') }}
                                </template>
                                <template slot="noOptions">
                                    {{ __('No Data Available') }}
                                </template>
                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single" v-if="values.length > 1 && !isOpen">@{{ values.length }} {{ __('names') }}</span>
                                </template>
                            </multiselect>
                        </div>
                        <div class="col-4">
                            <multiselect v-model="status"
                                         :show-labels="false"
                                         @input="buildPmql"
                                         :loading="isLoading.status"
                                         open-direction="bottom"
                                         label="name"
                                         :options="statusOptions"
                                         track-by="value"
                                         :multiple="true"
                                         :placeholder="$t('Status')">
                                <template slot="noResult">
                                    {{ __('No elements found. Consider changing the search query.') }}
                                </template>
                                <template slot="noOptions">
                                    {{ __('No Data Available') }}
                                </template>
                                <template slot="selection" slot-scope="{ values, search, isOpen }">
                                    <span class="multiselect__single" v-if="values.length > 1 && !isOpen">@{{ values.length }} {{ __('statuses') }}</span>
                                </template>
                            </multiselect>
                        </div>
                    </div>
                    <div id="search-manual" v-if="advanced">
                        <input ref="search_input" type="text" class="form-control" placeholder="PMQL" v-model="pmql">
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <div id="search-actions">
                        <div v-if="! advanced">
                            <b-btn variant="primary" @click="runSearch()" v-b-tooltip.hover :title="$t('Search')"><i
                                        class="fas fa-search"></i></b-btn>
                            <b-btn variant="secondary" @click="toggleAdvanced" v-b-tooltip.hover
                                   :title="$t('Advanced Search')"><i class="fas fa-ellipsis-h"></i></b-btn>
                        </div>
                        <div v-if="advanced">
                            <b-btn variant="primary" @click="runSearch(true)" v-b-tooltip.hover :title="$t('Search')"><i
                                        class="fas fa-search"></i></b-btn>
                            <b-btn variant="success" @click="toggleAdvanced" v-b-tooltip.hover
                                   :title="$t('Basic Search')"><i class="fas fa-ellipsis-h"></i></b-btn>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-6">
                    <tasks-list ref="taskList" :filter="filter" @in-overdue="setInOverdueMessage"></tasks-list>
                </div>
                <div class="col-6 p-0">
                    <div class="card my-4 ml-1 h-100">
                        <div class="card-header">Task Preview</div>
                        <div class="card-body">
                            Click on a task to the left to preview it here.
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('js')
    <script src="{{mix('js/tasks/index.js')}}"></script>
@endsection

@section('css')
    <style>
        #search-bar {
            height: 59px;
            max-height: 59px;
        }

        #search-manual input {
            border: 1px solid #e8e8e8;
            border-radius: 5px;
            color: gray;
            height: 41px;
        }

        #search-dropdowns {
            padding: 0 11px;
        }

        #search-dropdowns .col-4 {
            padding: 0 4px;
        }

        #search-actions button {
            display: inline-block;
            float: left;
            height: 41px;
            margin-left: 8px;
        }

        .multiselect__placeholder {
            padding-top: 1px;
        }

        .multiselect__single {
            padding-bottom: 2px;
            padding-top: 2px;
        }

        .search {
            border: 1px solid rgba(0, 0, 0, 0.125);
            margin-left: -1px;
            margin-right: -1px;
        }

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }

        .card-border {
            border-radius: 4px !important;
        }

        .card-size-header {
            width: 90px;
        }

        .option__image {
            width: 27px;
            height: 27px;
            border-radius: 50%;
        }

        .initials {
            display: inline-block;
            text-align: center;
            font-size: 12px;
            max-width: 25px;
            max-height: 25px;
            min-width: 25px;
            min-height: 25px;
            border-radius: 50%;
        }
    </style>
@endsection

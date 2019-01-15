@extends('layouts.layout')

@section('title')
  {{__('Scripts Editor')}}
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
<div id="script-container">
    <script-editor :script="{{$script}}"></script-editor>
</div>
@endsection

@section('css')
<style>
div.main {
  position: relative;
}
#script-container {
  position: absolute;
  width: 100%;
  max-width: 100%;
  height: 100%;
  max-height: 100%;
  overflow: hidden;
}

ol.breadcrumb {
  margin-bottom: 0;
  border-bottom: 0;
}
</style>
@endsection

@section('js')
    <script src="{{mix('js/processes/scripts/edit.js')}}"></script>
@endsection
